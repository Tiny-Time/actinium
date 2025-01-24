<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Reaction;
use App\Models\Template;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\EventCustomUrl;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Filament\Notifications\Notification;

class EventController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:30',
            'description' => 'nullable|string',
            'date_time' => 'required|date',
            'timezone' => 'required|string',
            'template_id' => 'required|integer',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $event = new Event();
        $event->title = $request->title;
        $event->description = $request->description;
        $event->date_time = $request->date_time;
        $event->timezone = $request->timezone;
        $event->event_id = Str::random(16);
        $event->user_id = $request->user_id ?? auth()->user()->id;
        $event->template_id = $request->template_id;
        $event->public = 1;
        $event->status = 1;
        $event->save();

        Notification::make()
            ->title('Event Created!')
            ->body('Your event has been created successfully.')
            ->success()
            ->persistent()
            ->send();

        return response()->json(['message' => 'Form submitted successfully', 'event_id' => $event->event_id], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $event_id)
    {
        $event = Cache::remember("event_$event_id", 60, function () use ($event_id) {
            return Event::with([
                'guestbooks' => function ($query) {
                    $query->select(
                        'id',
                        'name',
                        'email',
                        'message',
                        'event_id'
                    );
                }
            ])->where('event_id', $event_id)->where('status', true)->first();
        });

        $customUrl = Cache::remember("custom_url_$event_id", 60, function () use ($event_id) {
            return EventCustomUrl::with('event')->where('custom_url', $event_id)->first();
        });

        $event ??= $customUrl->event ?? null;

        if ($event && (!$customUrl || $customUrl->event->status)) {
            $template = Cache::remember("template_{$event->template_id}", 60, function () use ($event) {
                return Template::find($event->template_id);
            });

            return view((string) $template->path, [
                'event' => $event,
                'userIP' => $this->userIP(),
            ]);
        }

        return redirect('404');
    }

    /**
     * Retrieves the IP address of the user.
     *
     * @return string The IP address of the user.
     */
    public function userIP(): string
    {
        $data = Http::get('http://api.ipify.org/?format=json')->json();

        if ($data && isset($data['ip'])) {
            return $data['ip'];
        } else {
            $ip = '';
            if (isset($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } elseif (isset($_SERVER['HTTP_X_FORWARDED'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED'];
            } elseif (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_FORWARDED_FOR'];
            } elseif (isset($_SERVER['HTTP_FORWARDED'])) {
                $ip = $_SERVER['HTTP_FORWARDED'];
            } elseif (isset($_SERVER['REMOTE_ADDR'])) {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
            return $ip;
        }
    }

    public function react(Request $request)
    {
        $this->validate($request, [
            'user_ip' => 'required|string',
            'reaction' => 'required|string',
            'postID' => 'required|integer',
            'notification' => 'nullable|string',
        ]);

        $reaction = $request->reaction;
        $userIP = $request->user_ip;
        $postID = $request->postID;
        $notification = $request->notification;

        Reaction::updateOrCreate([
            'guestbook_id' => $postID,
            'user_ip' => $userIP,
        ], [
            'user_ip' => $userIP,
            'emoji' => $reaction,
            'guestbook_id' => $postID,
        ]);

        $reactionList = Reaction::where('guestbook_id', $postID)->get();
        $reactions = $reactionList->count();

        // Group reactions by emoji and count them
        $groupedReactions = $reactionList->groupBy('emoji')->map(function ($group) {
            return $group->count();
        });

        return response()->json([
            'message' => $notification,
            'reaction' => $reaction,
            'reactions' => $reactions,
            'postID' => $postID,
            'reactionList' => $groupedReactions,
        ], 200);
    }
}

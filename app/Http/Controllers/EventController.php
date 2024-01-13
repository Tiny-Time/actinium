<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:30',
            'description' => 'nullable|string',
            'date_time' => 'required|date',
            'template_id' => 'required|integer',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $event = new Event();
        $event->title = $request->title;
        $event->description = $request->description;
        $event->date_time = $request->date_time;
        $event->event_id = Str::random(16);
        $event->user_id = $request->user_id;
        $event->template_id = $request->template_id;
        $event->public = 1;
        $event->status = 1;
        $event->save();

        return response()->json(['message' => 'Form submitted successfully', 'event_id' => $event->event_id], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $event_id)
    {
        $event = Event::where('event_id', $event_id)->where('status', 1)->first();

        if ($event) {
            $template_id = $event->template_id;

            if ($template_id == 1) {
                return view('themes.anniversary.enchanted-midnight-forest.index', compact('event'));
            } elseif ($template_id == 2) {
                return view('themes.anniversary.scarlet-serenity.index', compact('event'));
            } elseif ($template_id == 3) {
                return view('themes.birthday.dark-blue-sequins.index', compact('event'));
            }
        }

        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

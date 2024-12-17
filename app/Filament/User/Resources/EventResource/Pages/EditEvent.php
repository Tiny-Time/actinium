<?php

namespace App\Filament\User\Resources\EventResource\Pages;

use Throwable;
use App\Models\Event;
use Filament\Actions;
use App\Models\Template;
use Filament\Forms\Form;
use Filament\Actions\Action;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Filament\Support\Exceptions\Halt;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Enums\IconPosition;
use function Filament\Support\is_app_url;
use Filament\Support\Facades\FilamentView;
use App\Filament\User\Resources\EventResource;

class EditEvent extends EditRecord
{
    use WithPagination;

    protected static string $resource = EventResource::class;

    protected static string $view = 'filament.user.resources.event-resource.pages.edit-event';

    public $currentStep = 1;

    public $template_id, $preview_url, $showPublishNotification;

    #[Url(as: 'q')]
    public $query = '';

    public $event;

    public $perPage = 12;

    protected $listeners = ['loadMore'];

    public function loadMore()
    {
        $this->perPage += 12;
    }

    public function mount(int|string $record): void
    {
        parent::mount($record);

        $this->event = $this->getRecord();

        $this->showPublishNotification = false;

        $this->preview_url = route('event.preview', ['event_id' => $this->event->event_id]);
    }

    public function search()
    {
        $this->resetPage();
    }

    public function updated($name, $value): void
    {
        if($name === 'query') {
            $this->resetPage();
        }
    }

    public function form(Form $form): Form
    {
        return
            $form->schema(EventResource::formFields())
                ->statePath('data');
    }

    public function getFormActions(): array
    {
        return [
            Action::make('next')
                ->icon('heroicon-o-chevron-right')
                ->iconPosition(IconPosition::After)
                ->submit('nextStep')
        ];
    }

    public function nextStep()
    {
        // Validate form
        $this->form->getState();

        // Token charge
        $token_charge = $this->tokenCharge();

        // Check if user has enough tokens
        if (auth()->user()->mainBalance() < $token_charge) {
            $this->addError('insufficient_token', 'You do not have enough tokens to create this event.');
            return;
        }

        $this->currentStep = 2;
    }

    public function prev()
    {
        $this->currentStep = 1;
    }

    public function draft()
    {
        $this->save(true, false);
        $this->showPublishNotification = true;
    }

    public function publish()
    {
        $event = Event::find($this->event->id);
        $event->status = true;
        $event->save();

        $this->showPublishNotification = false;
    }

    public function save(bool $shouldRedirect = true, bool $status = true): void
    {
        $this->validate([
            'template_id' => 'required|numeric'
        ]);

        // Filament

        $this->authorizeAccess();

        try {
            $this->beginDatabaseTransaction();

            $this->callHook('beforeValidate');

            $data = $this->form->getState();

            $this->callHook('afterValidate');

            $data['template_id'] = $this->template_id;

            // Update status.
            $data['status'] = $status;
            // Token charge.
            $token_charge = 0;

            // Update token if template is changed.
            $template = Template::find($this->template_id);

            // Check if the user has paid for the template before.
            $hasPaid = DB::table('event_template')
                ->where('event_id', $this->record->id)
                ->where('template_id', $this->template_id)
                ->where('paid', true)
                ->exists();

            if (!$hasPaid) {
                $token_charge = $template->tokens;
            }

            $token_charge = $this->tokenCharge() + $token_charge;

            // Check if user has enough tokens
            if (auth()->user()->mainBalance() < $token_charge) {
                $this->addError('insufficient_token', 'You do not have enough tokens to create this event.');
                return;
            }

            // Deduct tokens
            (new EventResource)->deductTokens($token_charge, 'edited');

            $data = $this->mutateFormDataBeforeSave($data);

            $this->callHook('beforeSave');

            $this->handleRecordUpdate($this->getRecord(), $data);

            $this->callHook('afterSave');

            if (!$hasPaid) {
                // Update pivot table.
                DB::table('event_template')->insert([
                    'event_id' => $this->record->id,
                    'template_id' => $this->template_id,
                    'paid' => true
                ]);
            }

            $this->commitDatabaseTransaction();
        } catch (Halt $exception) {
            $exception->shouldRollbackDatabaseTransaction() ?
                $this->rollBackDatabaseTransaction() :
                $this->commitDatabaseTransaction();

            return;
        } catch (Throwable $exception) {
            $this->rollBackDatabaseTransaction();

            throw $exception;
        }

        $this->rememberData();

        $this->getSavedNotification()?->send();

        if ($shouldRedirect && ($redirectUrl = $this->getRedirectUrl())) {
            $this->redirect($redirectUrl, navigate: FilamentView::hasSpaMode() && is_app_url($redirectUrl));
        }

        // Filament Ends
        $app_url = config('app.url');
        $this->preview_url = str_replace('//event', '/event', "$app_url/event/") . $this->data['event_id'];

        $this->currentStep = 3;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\Action::make('preview')
                ->url($this->preview_url, true)
                ->hidden(!$this->record->status),
        ];
    }

    public function getViewData(): array
    {
        $specificId = $this->record->template_id;
        $word = explode(' ', $this->query);

        // Check if the query is a single word
        switch (count($word)) {
            case 1:
                $word = $word[0];
                return [
                    'templates' => Template::where('name', 'like', "%{$this->query}%")
                        ->orWhere('tags', 'like', "%{$this->query}%")
                        ->orWhere('tokens', 'like', "%{$this->query}%")
                        ->orderByRaw("id = $specificId DESC")->paginate(perPage: $this->perPage)
                ];
            default:
                return [
                    'templates' => Template::where(function ($q) use ($word) {
                        foreach ($word as $w) {
                            $q->where('name', 'like', "%{$w}%")
                                ->orWhere('tags', 'like', "%{$w}%")
                                ->orWhere('tokens', 'like', "%{$w}%");
                        }
                    })->orderByRaw("id = $specificId DESC")->paginate(perPage: $this->perPage)
                ];
        }
    }

    public function tokenCharge(): int
    {
        $token_charge = 0;

        $original_data = $this->record;
        $data = $this->data;

        // Check if any of the fields are being set for the first time
        if (
            (!$original_data['address'] && $data['address']) ||
            (!$original_data['zip_code'] && $data['zip_code']) ||
            (!$original_data['country'] && $data['country']) ||
            (!$original_data['state'] && $data['state']) ||
            (!$original_data['contact_name'] && $data['contact_name']) ||
            (!$original_data['contact_email_address'] && $data['contact_email_address']) ||
            (!$original_data['contact_phone_number'] && $data['contact_phone_number']) ||
            (!$original_data['check_in_time'] && $data['check_in_time']) ||
            (!$original_data['event_end_time'] && $data['event_end_time']) ||
            ($original_data['guestbook'] == false && $data['guestbook'] == true) ||
            ($original_data['rsvp'] == false && $data['rsvp'] == true) ||
            (!$original_data['post_event_massage'] && $data['post_event_massage']) ||
            ($original_data['is_paid'] == false && $data['is_paid'] == true)
        ) {
            if (
                !$original_data['address']
                && !$original_data['zip_code']
                && !$original_data['country']
                && !$original_data['state']
                && !$original_data['contact_name']
                && !$original_data['contact_email_address']
                && !$original_data['contact_phone_number']
                && !$original_data['check_in_time']
                && !$original_data['event_end_time']
                && !$original_data['guestbook']
                && !$original_data['rsvp']
                && !$original_data['post_event_massage']
                && !$original_data['is_paid']
            ) {
                $token_charge = 2;
            }

            if (!$original_data['guestbook'] && $data['guestbook']) {
                $token_charge++;
            }

            if (!$original_data['rsvp'] && $data['rsvp']) {
                $token_charge++;
            }

            if (!$original_data['post_event_massage'] && $data['post_event_massage']) {
                $token_charge++;
            }

            if (!$original_data['is_paid'] && $data['is_paid']) {
                $token_charge += 3;
            }
        }

        return $token_charge;
    }
}

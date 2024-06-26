<?php

namespace App\Filament\User\Resources\EventResource\Pages;

use Throwable;
use Filament\Actions;
use App\Models\Template;
use Filament\Forms\Form;
use Filament\Actions\Action;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
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

    public $template_id, $preview_url;

    #[Url(as: 'q')]
    public $query = '';

    public function search()
    {
        $this->resetPage();
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
        $this->validate();
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

    public function save(bool $shouldRedirect = true): void
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

            $token_charge = 0;

            // Update token if template is changed and previous template token is greater than current template token
            if ($this->record->template_id != $this->template_id) {
                $template = Template::find($this->template_id);
                $token_charge = $template->tokens;

                $previous_template = Template::find($this->record->template_id);
                $previous_token_charge = $previous_template->tokens;

                if ($previous_token_charge > $token_charge) {
                    $token_charge = $previous_token_charge - $token_charge;
                }
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

        $this->preview_url = route('event.preview', $this->data['event_id']);

        $this->currentStep = 3;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getViewData(): array
    {
        $specificId = $this->record->template_id;
        return [
            'templates' => Template::where('name', 'like', "%{$this->query}%")
                ->orderByRaw("id = $specificId DESC")->paginate(12)
        ];
    }

    public function tokenCharge(): int
    {
        $token_charge = 0;

        $original_data = $this->record;
        $data = $this->data;

        // Check if any of the fields are being set for the first time
        if (
            (!$original_data['address'] && $data['address']) ||
            (!$original_data['country'] && $data['country']) ||
            (!$original_data['state'] && $data['state']) ||
            (!$original_data['contact_name'] && $data['contact_name']) ||
            (!$original_data['contact_email_address'] && $data['contact_email_address']) ||
            (!$original_data['contact_phone_number'] && $data['contact_phone_number']) ||
            (!$original_data['check_in_time'] && $data['check_in_time']) ||
            (!$original_data['event_end_time'] && $data['event_end_time']) ||
            ($original_data['guestbook'] == false && $data['guestbook'] == true) ||
            ($original_data['rsvp'] == false && $data['rsvp'] == true) ||
            (!$original_data['post_event_massage'] && $data['post_event_massage'])
        ) {
            if (
                !$original_data['address']
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
            ) {
                $token_charge = 2;
            }

            if ($original_data['guestbook'] == false && $data['guestbook'] == true) {
                $token_charge = $token_charge + 1;
            }

            if ($original_data['rsvp'] == false && $data['rsvp'] == true) {
                $token_charge = $token_charge + 1;
            }

            if (!$original_data['post_event_massage'] && $data['post_event_massage']) {
                $token_charge = $token_charge + 1;
            }
        }

        return $token_charge;
    }
}

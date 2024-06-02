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

    #[Url( as: 'q')]
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
}

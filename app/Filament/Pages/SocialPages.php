<?php

namespace App\Filament\Pages;

use App\Models\SocialPage;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Support\Exceptions\Halt;

class SocialPages extends Page implements HasForms
{
    use InteractsWithForms;
    protected static ?string $navigationIcon = 'heroicon-o-at-symbol';

    protected static ?string $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 11;

    public ?array $links = [];

    protected static string $view = 'filament.pages.social-pages';

    public function mount(): void
    {
        $pages = SocialPage::get();

        if (!$pages->isEmpty()) {
            foreach ($pages as $page) {
                $this->links[$page->name] = $page->link;
            }
            $this->form->fill($this->links);
        }
    }

    public function form(Form $form): Form
    {
        return
            $form->schema([
                TextInput::make('facebook_url')
                    ->placeholder('Enter the Facebook page URL.')
                    ->url()
                    ->suffixIcon('icon-facebook'),
                TextInput::make('linkedin_url')
                    ->placeholder('Enter the LinkedIn page URL.')
                    ->url()
                    ->suffixIcon('icon-linkedin'),
                TextInput::make('twitter_url')
                    ->placeholder('Enter the Twitter page URL.')
                    ->url()
                    ->suffixIcon('icon-twitter'),
                TextInput::make('instagram_url')
                    ->placeholder('Enter the Instagram page URL.')
                    ->url()
                    ->suffixIcon('icon-instagram'),
            ])->statePath('links');
    }

    public function getFormActions(): array
    {
        return [
            Action::make('save')
                ->submit('save')
        ];
    }

    public function save(): void
    {
        try {
            $links = $this->form->getState();

            foreach ($links as $key => $link) {
                SocialPage::updateOrInsert(
                    ['name' => $key],
                    ['name' => $key, 'link' => $link ? $link : '#']
                );
            }

            Notification::make()
                ->title('Saved successfully.')
                ->success()
                ->send();
        } catch (Halt $e) {
            return;
        }
    }
}

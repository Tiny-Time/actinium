<?php

namespace App\Filament\Pages;

use Filament\Forms\Form;
use Filament\Pages\Page;
use App\Models\SocialPage;
use Filament\Actions\Action;
use Filament\Support\Exceptions\Halt;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Concerns\InteractsWithForms;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;

class SocialPages extends Page implements HasForms
{
    use InteractsWithForms;
    use HasPageShield;

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
                    ->label('Facebook URL')
                    ->suffixIcon('icon-facebook'),
                TextInput::make('linkedin_url')
                    ->placeholder('Enter the LinkedIn page URL.')
                    ->label('LinkedIn URL')
                    ->suffixIcon('icon-linkedin'),
                TextInput::make('twitter_url')
                    ->placeholder('Enter the X page URL.')
                    ->label('X URL')
                    ->suffixIcon('icon-twitter'),
                TextInput::make('instagram_url')
                    ->placeholder('Enter the Instagram page URL.')
                    ->label('Instagram URL')
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

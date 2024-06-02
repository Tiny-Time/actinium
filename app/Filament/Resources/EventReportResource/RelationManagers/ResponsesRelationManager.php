<?php

namespace App\Filament\Resources\EventReportResource\RelationManagers;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\RelationManagers\RelationManager;

class ResponsesRelationManager extends RelationManager
{
    protected static string $relationship = 'responses';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('response')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('event_id')
            ->columns([
                Tables\Columns\TextColumn::make('response'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->after(function () {
                        $owner = $this->getOwnerRecord();
                        $recipient = User::find($owner->user_id);

                        $url = url("/dashboard/event-reports/$owner->id");

                        Notification::make()
                            ->title('You have a new response on your report')
                            ->success()
                            ->actions([
                                Action::make('view')
                                    ->button()
                                    ->url($url),
                            ])
                            ->sendToDatabase($recipient);
                    })
                    ->createAnother(false)
                    ->modalWidth('md'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('')
                    ->tooltip('Edit Response')
                    ->modalWidth('md'),
                Tables\Actions\DeleteAction::make()
                    ->label('')
                    ->tooltip('Delete Response')
                    ->modalWidth('md'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->modifyQueryUsing(function (Builder $query) {
                return $query->latest();
            });
    }
}

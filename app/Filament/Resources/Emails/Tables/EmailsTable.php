<?php

namespace App\Filament\Resources\Emails\Tables;

use App\Filament\Helpers\Resources\PaginationValues;
use App\Mail\ResendMail;
use App\Models\Email;
use Filament\Actions\Action;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Mail;

class EmailsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->recordActions([
                Action::make('preview')
                    ->label(__('Preview'))
                    ->icon('heroicon-m-eye')
                    ->extraAttributes(['style' => 'h-41'])
                    ->modalFooterActions(
                        fn ($action): array => [
                            $action->getModalCancelAction(),
                        ]
                    )
                    ->fillForm(function (Email $email) {
                        $body = $email->html_body;

                        return [
                            'html_body' => $body,
                        ];
                    })
                    ->schema([
                        Forms\Components\ViewField::make('html_body')
                            ->hiddenLabel()
                            ->view('filament.resources.html_view'),
                    ]),
                Action::make('resend')
                    ->label(__('Send again'))
                    ->icon('heroicon-o-envelope')
                    ->action(function (Email $email): void {
                        try {
                            Mail::to($email->to)
                                ->cc($email->cc)
                                ->bcc($email->bcc)
                                ->send(new ResendMail($email));
                            Notification::make()
                                ->title(__('Mail has been successfully sent'))
                                ->success()
                                ->duration(5000)
                                ->send();
                        } catch (\Exception) {
                            Notification::make()
                                ->title(__('Something went wrong'))
                                ->danger()
                                ->duration(5000)
                                ->send();
                        }
                    }),
            ])
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('Date and time sent'))
                    ->dateTime()
                    ->icon('heroicon-m-calendar')
                    ->sortable(),
                Tables\Columns\TextColumn::make('from')
                    ->label(__('From'))
                    ->icon('heroicon-m-envelope')
                    ->searchable(),
                Tables\Columns\TextColumn::make('to')
                    ->label(__('To'))
                    ->icon('heroicon-m-envelope')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subject')
                    ->label(__('Subject'))
                    ->icon('heroicon-m-chat-bubble-bottom-center')
                    ->limit(50),

            ])
            ->groupedBulkActions([
                DeleteBulkAction::make()
                    ->requiresConfirmation(),
            ])
            ->paginated(PaginationValues::getPaginationValues());
    }
}

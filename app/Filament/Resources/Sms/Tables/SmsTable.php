<?php

namespace App\Filament\Resources\Sms\Tables;

use App\Jobs\SendSmsJob;
use App\Filament\Helpers\Resources\PaginationValues;
use App\Models\Sms;
use Filament\Actions\Action;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Schemas;

class SmsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->recordActions([
                Action::make('view')
                    ->label(__('Preview'))
                    ->icon('heroicon-m-eye')
                    ->extraAttributes(['style' => 'h-41'])
                    ->modalFooterActions(
                        fn ($action): array => [
                            $action->getModalCancelAction(),
                        ]
                    )
                    ->fillForm(fn (Sms $sms) => [
                        'from' => $sms->from,
                        'to' => $sms->to,
                        'message' => $sms->message,
                    ])
                    ->schema([
                        Schemas\Components\Group::make()
                            ->schema([
                                Schemas\Components\Section::make()
                                    ->schema([

                                        Forms\Components\TextInput::make('from')
                                            ->readOnly()
                                            ->translateLabel(),

                                        Forms\Components\TextInput::make('to')
                                            ->readOnly()
                                            ->translateLabel(),

                                        Forms\Components\Textarea::make('message')
                                            ->readOnly()
                                            ->columnSpanFull()
                                            ->translateLabel(),
                                    ])->columns(2),
                            ])->columnSpan(1),
                    ]),

                Action::make('resend')
                    ->label(__('Send again'))
                    ->icon('heroicon-m-chat-bubble-bottom-center')
                    ->action(function (Sms $sms): void {
                        try {
                            SendSmsJob::dispatch($sms->to, $sms->message);
                            Notification::make()
                                ->title(__('Sms has been successfully sent'))
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
                    ->icon('heroicon-m-phone-arrow-up-right'),
                Tables\Columns\TextColumn::make('to')
                    ->label(__('To'))
                    ->icon('heroicon-m-phone-arrow-down-left')
                    ->searchable(),
                Tables\Columns\TextColumn::make('message')
                    ->label(__('Message'))
                    ->icon('heroicon-m-chat-bubble-bottom-center')
                    ->limit(50)
                    ->searchable(),
            ])
            ->groupedBulkActions([
                DeleteBulkAction::make()
                    ->requiresConfirmation(),
            ])
            ->paginated(PaginationValues::getPaginationValues());
    }
}

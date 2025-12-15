<?php

namespace App\Filament\Resources\Emails\Schemas;

use Filament\Forms;
use Filament\Schemas;
use Filament\Schemas\Schema;

class EmailForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Schemas\Components\Fieldset::make('Envelope')
                    ->label('')
                    ->schema([
                        Forms\Components\TextInput::make('created_at')
                            ->label(__('Created at')),
                        Forms\Components\TextInput::make('from')
                            ->label(__('From')),
                        Forms\Components\TextInput::make('to')
                            ->label(__('To')),
                        Forms\Components\TextInput::make('cc')
                            ->label(__('CC')),
                        Forms\Components\TextInput::make('subject')
                            ->label(__('Subject'))
                            ->columnSpan(2),
                    ])->columns(3),
                Schemas\Components\Tabs::make('Content')->tabs([
                    Schemas\Components\Tabs\Tab::make('HTML')
                        ->schema([
                            Forms\Components\ViewField::make('html_body')
                                ->view('filament.resources.html_view'),
                        ]),
                    Schemas\Components\Tabs\Tab::make('Text')
                        ->schema([
                            Forms\Components\Textarea::make('text_body'),
                        ]),
                    Schemas\Components\Tabs\Tab::make('Raw')
                        ->schema([
                            Forms\Components\Textarea::make('raw_body'),
                        ]),
                    Schemas\Components\Tabs\Tab::make('Debug info')
                        ->schema([
                            Forms\Components\Textarea::make('sent_debug_info'),
                        ]),
                ])->columnSpan(2),
            ]);
    }
}

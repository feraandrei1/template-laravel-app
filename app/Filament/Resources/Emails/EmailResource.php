<?php

namespace App\Filament\Resources\Emails;

use App\Filament\Resources\Emails\Pages\ListEmails;
use App\Filament\Resources\Emails\Pages\ViewEmail;
use App\Filament\Resources\Emails\Schemas\EmailForm;
use App\Filament\Resources\Emails\Tables\EmailsTable;
use App\Models\Email;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class EmailResource extends Resource
{
    protected static ?string $model = Email::class;

    protected static ?string $slug = 'mails';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedEnvelope;

    protected static ?int $navigationSort = 6;

    public static function form(Schema $schema): Schema
    {
        return EmailForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EmailsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEmails::route('/'),
            'view' => ViewEmail::route('/{record}'),
        ];
    }

    public static function getModelLabel(): string
    {
        return __('Mail');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Mails');
    }

    public static function getNavigationGroup(): string
    {
        return __('Communication');
    }
}

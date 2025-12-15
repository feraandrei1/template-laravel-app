<?php

namespace App\Filament\Resources\Sms;

use App\Filament\Resources\Sms\Pages\ListSms;
use App\Filament\Resources\Sms\Tables\SmsTable;
use App\Models\Sms;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SmsResource extends Resource
{
    protected static ?string $model = Sms::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChatBubbleLeftEllipsis;

    protected static ?int $navigationSort = 7;

    public static function table(Table $table): Table
    {
        return SmsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSms::route('/'),
        ];
    }

    public static function getModelLabel(): string
    {
        return __('SMS');
    }

    public static function getPluralModelLabel(): string
    {
        return __('SMS');
    }

    public static function getNavigationGroup(): string
    {
        return __('Communication');
    }
}

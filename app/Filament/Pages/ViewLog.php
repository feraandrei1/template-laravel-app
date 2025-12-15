<?php

namespace App\Filament\Pages;

use Filament\Forms;
use Filament\Schemas\Schema;

use Saade\FilamentLaravelLog\Pages\ViewLog as BaseViewLog;

class ViewLog extends BaseViewLog
{
    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Forms\Components\Select::make('logFile')
                    ->label(null)
                    ->placeholder(fn (): string => __('log::filament-laravel-log.page.form.placeholder'))
                    ->live()
                    ->options(
                        function () {
                            return $this->getFileNames($this->getFinder())
                                ->sortByDesc(function ($file) {
                                    return filemtime($file);
                                })
                                ->take(config('filament-laravel-log.limit'));
                        }
                    )
                    ->searchable()
                    ->getSearchResultsUsing(
                        fn (string $query) => $this->getFileNames($this->getFinder()->name("*{$query}*"))
                    )
                    ->afterStateUpdated(fn () => $this->refresh()),
            ]);
    }
}

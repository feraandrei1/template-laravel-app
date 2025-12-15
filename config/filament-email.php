<?php

use App\Filament\Resources\EmailResource;

return [

    'resource' => [
        'class' => EmailResource::class,
        'group' => 'filament-panels::pages/navigation.social_group',
        'sort' => 13,
        'default_sort_column' => 'created_at',
        'default_sort_direction' => 'desc',
    ],

    'keep_email_for_days' => 999999,
];

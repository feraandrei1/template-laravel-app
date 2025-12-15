<?php

namespace App\Providers;

use App\Listeners\FilamentEmailLogger;
use Illuminate\Mail\Events\MessageSent;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class EmailMessageServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Event::listen(
            MessageSent::class,
            [FilamentEmailLogger::class, 'handle']
        );
    }
}

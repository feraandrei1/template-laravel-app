<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Mail;

class EmailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mail::raw('This is a test email.', function ($message) {
            $message->to(config('mail.contact.address'))
                ->subject('Test Contact Email');
        });
    }
}

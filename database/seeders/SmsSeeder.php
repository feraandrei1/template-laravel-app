<?php

namespace Database\Seeders;

use App\Jobs\SendSmsJob;
use App\Models\Sms;
use Illuminate\Database\Seeder;

class SmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Example of creating an SMS record in the database
        $appName = config('app.name');
        $receiver = '+-your-phone-number';
        $text = 'This is a test SMS message.';

        $collection = [
            'status' => 'sent',
            'message_id' => '1234567890',
            'cost' => '0.05',
            'currency' => 'USD',
        ];

        Sms::create([
            'from' => $appName,
            'to' => $receiver,
            'message' => $text,
            'response' => $collection,
        ]);

        // Optionally, dispatch a job to send an SMS
        // SendSmsJob::dispatch('+-your-phone-number', 'This is a test SMS message.');
    }
}

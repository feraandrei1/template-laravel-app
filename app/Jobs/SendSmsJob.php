<?php

namespace App\Jobs;

use App\Models\Sms;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SendSmsJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public string $receiver, public string $text)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $appName = config('app.name');
        $apiKey = config('services.vonage.api_key');
        $apiSecret = config('services.vonage.api_secret');

        $basic = new \Vonage\Client\Credentials\Basic($apiKey, $apiSecret);
        $client = new \Vonage\Client($basic);

        $receiver = Str::replace('+', '', $this->receiver);

        try {

            $collection = $client->sms()->send(
                new \Vonage\SMS\Message\SMS($this->receiver, $appName, $this->text)
            );

            $sentSMS = $collection->current();

            if ($sentSMS->getStatus() == 0) {

                $sms = Sms::create([
                    'from' => $appName,
                    'to' => $receiver,
                    'message' => $this->text,
                    'response' => $collection,
                ]);

                Log::channel('sms-api')->info('The SMS with the id '.$sms->id.' was sent successfully with response: '.json_encode($collection));
            }
        } catch (\Throwable $th) {
            Log::channel('sms-api')->info('The SMS failed: '.$th);
        }
    }
}

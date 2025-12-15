<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Support\Carbon;

/**
 * Sms
 *
 * @property string $from
 * @property string $to
 * @property string $message
 * @property Carbon|null $created_at
 */
class Sms extends Model
{
    use HasFactory;
    use Prunable;

    protected $table = 'filament_sms_log';

    protected $guarded = [];

    protected $fillable = [
        'from',
        'to',
        'message',
        'response',
    ];

    protected $casts = [
        'response' => 'json',
    ];

    // Showing just the SMS from the last 90 days
    public function prunable()
    {
        return static::where('created_at', '<=', now()->subDays(90));
    }
}

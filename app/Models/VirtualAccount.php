<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VirtualAccount extends Model
{
    protected $fillable = [
        'va_number',
        'user_id',
        'transaction_id',
        'type',
        'amount',
        'status',
        'expired_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'expired_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    public static function generateVANumber(): string
    {
        do {
            $vaNumber = 'VA' . now()->format('YmdHis') . rand(1000, 9999);
        } while (self::where('va_number', $vaNumber)->exists());

        return $vaNumber;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    protected $fillable = [
        'subscription_id',
        'user_id',
        'stripe_invoice_id',
        'invoice_no',
        'amount',
        'currency',
        'payment_status',
        'hosted_invoice_url',
        'pdf_url',
        'issued_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'issued_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function isPaid(): bool
    {
        return $this->payment_status === 'paid';
    }

    public function isPending(): bool
    {
        return $this->payment_status === 'pending';
    }

    public static function generateInvoiceNumber(): string
    {
        $prefix = 'INV';
        $date = now()->format('Ymd');
        $lastInvoice = self::whereDate('created_at', now()->toDateString())->count();
        $sequence = str_pad($lastInvoice + 1, 4, '0', STR_PAD_LEFT);
        return "{$prefix}{$date}{$sequence}";
    }
}

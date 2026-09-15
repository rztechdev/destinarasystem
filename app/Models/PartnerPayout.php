<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerPayout extends Model
{
    use HasFactory;

    protected $fillable = [
        'partner_id',
        'booking_id',
        'payout_reference',
        'gross_amount',
        'commission',
        'net_amount',
        'status',
        'transferred_at',
        'receipt_doc_path',
    ];

    protected $casts = [
        'gross_amount' => 'decimal:2',
        'commission' => 'decimal:2',
        'net_amount' => 'decimal:2',
        'transferred_at' => 'datetime',
    ];

    public function partner()
    {
        return $this->belongsTo(User::class, 'partner_id');
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}

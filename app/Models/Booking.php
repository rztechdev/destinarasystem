<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_code',
        'institution_id',
        'user_id',
        'destination_id',
        'inquiry_type',
        'planned_date_start',
        'planned_date_end',
        'participant_count',
        'guide_count',
        'purpose_notes',
        'needs_permit_letter',
        'support_doc_path',
        'subtotal_amount',
        'insurance_amount',
        'platform_fee',
        'total_amount',
        'status',
        'internal_notes',
    ];

    protected $casts = [
        'planned_date_start' => 'date',
        'planned_date_end' => 'date',
        'participant_count' => 'integer',
        'guide_count' => 'integer',
        'needs_permit_letter' => 'boolean',
        'subtotal_amount' => 'decimal:2',
        'insurance_amount' => 'decimal:2',
        'platform_fee' => 'decimal:2',
        'total_amount' => 'decimal:2',
    ];

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    // Accessor aliases for seamless compatibility
    public function getTotalPaxAttribute()
    {
        return $this->participant_count ?? 30;
    }

    public function getVisitDateAttribute()
    {
        return $this->planned_date_start;
    }

    public function setVisitDateAttribute($value)
    {
        $this->attributes['planned_date_start'] = $value;
        $this->attributes['planned_date_end'] = $value;
    }

    public function getTotalPriceAttribute()
    {
        return $this->total_amount ?? 0;
    }
}


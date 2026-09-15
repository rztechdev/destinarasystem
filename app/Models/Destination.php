<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'partner_id',
        'name',
        'slug',
        'category',
        'province',
        'city',
        'price_per_pax',
        'description',
        'educational_highlights',
        'facilities',
        'suitable_for',
        'has_permit_document',
        'cover_image',
        'gallery_images',
        'status',
    ];

    protected $casts = [
        'facilities' => 'array',
        'suitable_for' => 'array',
        'gallery_images' => 'array',
        'has_permit_document' => 'boolean',
        'price_per_pax' => 'integer',
    ];

    public function partner()
    {
        return $this->belongsTo(User::class, 'partner_id');
    }

    public function contacts()
    {
        return $this->hasMany(DestinationContact::class);
    }

    public function slots()
    {
        return $this->hasMany(AvailabilitySlot::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestinationContact extends Model
{
    use HasFactory;

    protected $fillable = [
        'destination_id',
        'contact_name',
        'role',
        'phone',
        'email',
    ];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}

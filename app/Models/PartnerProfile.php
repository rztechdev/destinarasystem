<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'organization_name',
        'organization_type',
        'legal_document_number',
        'bank_name',
        'bank_account_number',
        'bank_account_holder',
        'verification_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

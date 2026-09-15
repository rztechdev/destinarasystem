<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'status',
    ];

    /**
     * Relasi ke data institusi (untuk user role buyer)
     */
    public function institution()
    {
        return $this->hasOne(Institution::class);
    }

    /**
     * Relasi ke pesanan/booking
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Relasi ke profil lembaga mitra pengelola tapak
     */
    public function partnerProfile()
    {
        return $this->hasOne(PartnerProfile::class);
    }

    /**
     * Relasi ke pencairan dana mitra (payouts)
     */
    public function partnerPayouts()
    {
        return $this->hasMany(PartnerPayout::class, 'partner_id');
    }

    /**
     * Relasi ke destinasi yang dikelola mitra
     */
    public function destinations()
    {
        return $this->hasMany(Destination::class, 'partner_id');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}

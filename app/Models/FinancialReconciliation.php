<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialReconciliation extends Model
{
    use HasFactory;

    protected $fillable = [
        'period_month',
        'gross_inflow',
        'platform_commission',
        'partner_payouts_total',
        'escrow_holding',
        'status',
        'reconciled_by',
        'notes',
    ];

    protected $casts = [
        'gross_inflow' => 'decimal:2',
        'platform_commission' => 'decimal:2',
        'partner_payouts_total' => 'decimal:2',
        'escrow_holding' => 'decimal:2',
    ];

    public function auditor()
    {
        return $this->belongsTo(User::class, 'reconciled_by');
    }
}

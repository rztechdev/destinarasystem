<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('system_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('group')->default('system'); // payment, commission, system, notification
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('financial_reconciliations', function (Blueprint $table) {
            $table->id();
            $table->string('period_month'); // e.g. 2026-09
            $table->decimal('gross_inflow', 14, 2)->default(0);
            $table->decimal('platform_commission', 14, 2)->default(0);
            $table->decimal('partner_payouts_total', 14, 2)->default(0);
            $table->decimal('escrow_holding', 14, 2)->default(0);
            $table->string('status')->default('reconciled'); // reconciled, discrepancy, pending
            $table->foreignId('reconciled_by')->nullable()->constrained('users')->nullOnDelete();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('financial_reconciliations');
        Schema::dropIfExists('system_settings');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. partner_profiles
        Schema::create('partner_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('organization_name');
            $table->string('organization_type')->default('yayasan_adat'); // pokdarwis, bumdes, yayasan_adat, koperasi, swasta
            $table->string('legal_document_number')->nullable();
            $table->string('bank_name')->default('BPD Bali');
            $table->string('bank_account_number')->nullable();
            $table->string('bank_account_holder')->nullable();
            $table->string('verification_status')->default('verified'); // verified, pending, unverified
            $table->timestamps();
        });

        // 2. partner_payouts (Sesuai PRD v1.0 Section 7.9)
        Schema::create('partner_payouts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('partner_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('booking_id')->nullable()->constrained('bookings')->nullOnDelete();
            $table->string('payout_reference')->unique();
            $table->decimal('gross_amount', 14, 2);
            $table->decimal('commission', 14, 2);
            $table->decimal('net_amount', 14, 2);
            $table->string('status')->default('pending'); // pending, transferred
            $table->timestamp('transferred_at')->nullable();
            $table->string('receipt_doc_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partner_payouts');
        Schema::dropIfExists('partner_profiles');
    }
};

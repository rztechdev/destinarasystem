<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notification_logs', function (Blueprint $table) {
            $table->id();
            $table->string('recipient_type'); // buyer, partner, admin
            $table->string('recipient_name');
            $table->string('channel'); // whatsapp, email
            $table->string('target'); // phone or email
            $table->string('event_type'); // booking_created, payment_reminder, epass_issued, payout_processed, curation_approved
            $table->string('title');
            $table->text('preview_text');
            $table->string('status')->default('sent'); // sent, queued, failed
            $table->integer('retry_count')->default(0);
            $table->timestamp('sent_at')->nullable();
            $table->timestamps();
        });

        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('action'); // verify_institution, verify_partner, publish_destination, reject_destination, force_confirm, reschedule_booking, reissue_doc
            $table->string('entity_type')->nullable(); // Destination, Institution, Booking, PartnerProfile, etc.
            $table->unsignedBigInteger('entity_id')->nullable();
            $table->text('description');
            $table->string('ip_address')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
        Schema::dropIfExists('notification_logs');
    }
};

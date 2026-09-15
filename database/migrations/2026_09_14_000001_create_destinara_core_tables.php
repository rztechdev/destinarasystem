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
        // 1. institutions
        Schema::create('institutions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('institution_name');
            $table->string('institution_type')->default('sekolah'); // sekolah, kampus, riset, lainnya
            $table->string('npsn')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('pic_name')->nullable();
            $table->string('pic_position')->nullable();
            $table->string('pic_phone')->nullable();
            $table->string('pic_email')->nullable();
            $table->string('official_letterhead')->nullable();
            $table->string('verification_status')->default('verified'); // unverified, verified
            $table->timestamps();
        });

        // 2. destinations
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('partner_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('category')->default('desa_wisata'); // desa_wisata, taman_nasional, situs_budaya, konservasi_alam, lainnya
            $table->string('province');
            $table->string('city');
            $table->unsignedBigInteger('price_per_pax')->default(45000);
            $table->text('description');
            $table->text('educational_highlights')->nullable();
            $table->json('facilities')->nullable();
            $table->json('suitable_for')->nullable();
            $table->boolean('has_permit_document')->default(true);
            $table->string('cover_image');
            $table->json('gallery_images')->nullable();
            $table->string('status')->default('published'); // draft, pending_review, published, archived
            $table->timestamps();
        });

        // 3. destination_contacts
        Schema::create('destination_contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('destination_id')->constrained()->cascadeOnDelete();
            $table->string('contact_name');
            $table->string('role');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->timestamps();
        });

        // 4. availability_slots
        Schema::create('availability_slots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('destination_id')->constrained()->cascadeOnDelete();
            $table->date('date');
            $table->integer('capacity')->default(100);
            $table->integer('booked_count')->default(0);
            $table->string('status')->default('open'); // open, full, closed
            $table->timestamps();
        });

        // 5. bookings
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_code')->unique();
            $table->foreignId('institution_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('destination_id')->constrained()->cascadeOnDelete();
            $table->string('inquiry_type')->default('study_tour'); // study_tour, penelitian
            $table->date('planned_date_start');
            $table->date('planned_date_end');
            $table->integer('participant_count')->default(30);
            $table->integer('guide_count')->default(2);
            $table->text('purpose_notes')->nullable();
            $table->boolean('needs_permit_letter')->default(false);
            $table->string('support_doc_path')->nullable();
            $table->decimal('subtotal_amount', 14, 2)->default(0);
            $table->decimal('insurance_amount', 14, 2)->default(0);
            $table->decimal('platform_fee', 14, 2)->default(0);
            $table->decimal('total_amount', 14, 2)->default(0);
            $table->string('status')->default('menunggu_pembayaran'); // menunggu_pembayaran, dibayar, dikonfirmasi, selesai, batal
            $table->text('internal_notes')->nullable();
            $table->timestamps();
        });

        // 6. payments
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->cascadeOnDelete();
            $table->string('gateway_ref')->nullable();
            $table->string('payment_method')->nullable(); // bca_va, mandiri_va, bni_va, qris, dana_bos
            $table->decimal('amount', 14, 2);
            $table->timestamp('paid_at')->nullable();
            $table->string('payment_proof_path')->nullable();
            $table->string('status')->default('pending'); // pending, settled, expired, failed
            $table->timestamps();
        });

        // 7. documents
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->cascadeOnDelete();
            $table->string('type'); // invoice, surat_konfirmasi, draf_surat_izin
            $table->string('title');
            $table->string('file_path')->nullable();
            $table->timestamp('generated_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('bookings');
        Schema::dropIfExists('availability_slots');
        Schema::dropIfExists('destination_contacts');
        Schema::dropIfExists('destinations');
        Schema::dropIfExists('institutions');
    }
};

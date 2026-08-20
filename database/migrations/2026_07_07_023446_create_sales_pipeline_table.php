<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales_pipeline', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('gen_random_uuid()'));

            // ── Identifikasi ──────────────────────────────────────────────────
            $table->string('sales_no', 20)->unique();

            // ── Relasi ────────────────────────────────────────────────────────
            $table->foreignUuid('customer_id')->constrained('customers')->cascadeOnDelete();
            $table->foreignUuid('am_user_id')->constrained('users');

            // ── Data Pipeline ─────────────────────────────────────────────────
            $table->string('am_label')->nullable();
            // Label "Person / Company" yang tampil di UI, misal: "Max / MMG"
            // Diisi otomatis dari user.name + company saat create

            $table->string('opportunity')->nullable();
            // Nilai dari dropdown default ATAU custom_options
            // Contoh: "BOD Driven 30%" / "Partner Referral 50%"

            $table->string('project_name');
            $table->decimal('revenue', 18, 2)->nullable();

            $table->string('stage')->default('PROSPECT 10%');
            // Nilai dari dropdown default ATAU custom_options

            $table->integer('stage_pct')->default(10);
            // Auto-extract dari stage string, misal "PROSPECT 10%" → 10
            // Disimpan terpisah untuk query aggregation (SUM by stage group)

            $table->string('quotation_no')->nullable();
            $table->date('target_closed')->nullable();
            $table->date('last_update')->nullable();
            $table->text('remark_next_action')->nullable();

            // ── Audit ─────────────────────────────────────────────────────────
            $table->boolean('is_deleted')->default(false);
            $table->timestamps();

            // Index
            $table->index('stage');
            $table->index('stage_pct');
            $table->index('am_user_id');
            $table->index('customer_id');
            $table->index('is_deleted');
            $table->index('target_closed');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_pipeline');
    }
};

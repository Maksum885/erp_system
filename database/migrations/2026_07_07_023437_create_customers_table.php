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
        Schema::create('customers', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('gen_random_uuid()'));

            // ── Identitas ─────────────────────────────────────────────────────
            $table->string('company_name')->unique();
            $table->enum('grade', [
                'Gold',
                'Silver',
                'Bronze'
            ]);
            $table->foreignUuid('am_user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->text('address')->nullable();
            $table->enum('status', [
                'Prospect',
                'On Progress',
                'Registered'
            ]);
            $table->text('remarks')->nullable();

            // ── Potensi Bisnis ────────────────────────────────────────────────
            $table->boolean('potential_IT')->default(false);
            $table->boolean('potential_OT')->default(false);
            $table->boolean('potential_fabrication')->default(false);
            $table->boolean('potential_civil')->default(false);

            // ── Kontak User ───────────────────────────────────────────────────
            $table->string('user_purchasing')->nullable();
            $table->string('user_IT')->nullable();
            $table->string('user_facility')->nullable();
            $table->string('user_others')->nullable();

            // ── Potensi Bisnis (angka) ────────────────────────────────────────
            $table->string('payment_term')->nullable();
            $table->integer('potential_project_month')->nullable();
            $table->decimal('potential_omzet_SGD', 15, 2)->nullable();

            // ── Audit ─────────────────────────────────────────────────────────
            $table->boolean('is_deleted')->default(false);
            $table->foreignUuid('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            // Index untuk pencarian dan filter
            $table->index('grade');
            $table->index('status');
            $table->index('am_user_id');
            $table->index('is_deleted');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};

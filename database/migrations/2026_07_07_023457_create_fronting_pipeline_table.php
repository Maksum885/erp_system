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
        Schema::create('fronting_pipeline', function (Blueprint $table) {
            $table->uuid('id')->primary()->defaultRaw('gen_random_uuid()');
            $table->string('sales_no', 20)->unique();
            $table->foreignUuid('am_user_id')->constrained('users');
            $table->string('opportunity')->nullable();
            $table->foreignUuid('customer_id')->constrained('customers')->cascadeOnDelete();
            $table->string('project_name');
            $table->decimal('quote_value', 18, 2)->nullable();
            $table->enum('stage_progress', [
                'CLOSED-WON',
                'CLOSED-LOSS',
            ]);
            $table->integer('stage_pct')->default(30);
            $table->string('quotation_no')->nullable();
            $table->date('target_closed')->nullable();
            $table->timestamps();
            $table->date('last_update')->nullable();
            $table->text('remark_next_action')->nullable();
            $table->boolean('is_deleted')->default(false);
            $table->string('invoice')->nullable();
            $table->decimal('invoice_value', 18, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fronting_pipeline');
    }
};

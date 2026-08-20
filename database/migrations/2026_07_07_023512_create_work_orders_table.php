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
        Schema::create('work_orders', function (Blueprint $table) {
            $table->uuid('id')->primary()->defaultRaw('gen_random_uuid()');
            $table->string('so_no', 20)->unique();
            $table->foreignUuid('am_user_id')->constrained('users');
            $table->string('wo_no', 20)->unique();
            $table->foreignUuid('customer_id')->constrained('customers');
            $table->string('project_name');
            $table->decimal('revenue', 18, 2);
            $table->enum('stage', ['PROCUREMENT', 'IMPLEMENTATION', 'REPORTING', 'INVOICE_SENT', 'INVOICE_PAID']);
            $table->integer('stage_pct')->default(60);
            $table->string('customer_po_no')->nullable();
            $table->date('po_date')->nullable();
            $table->date('deadline')->nullable();
            $table->date('last_update')->nullable();
            $table->text('remark')->nullable();
            $table->date('invoice_submission_date')->nullable();
            $table->boolean('is_deleted')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_orders');
    }
};

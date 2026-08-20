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
        Schema::create('rs_format', function (Blueprint $table) {
            $table->uuid('id')->primary()->defaultRaw('gen_random_uuid()');
            $table->foreignUuid('work_order_id')->constrained('work_orders');
            $table->foreignUuid('customer_id')->constrained('customers');
            $table->foreignUuid('am_user_id')->constrained('users');
            $table->date('transaction_date');
            $table->string('po_contract_no')->nullable();
            $table->decimal('invoice_value_dpp', 18, 2)->default(0);
            $table->enum('tax_type_1', ['PPN', 'PPh22', 'PPh23', 'none'])->default('none');
            $table->decimal('tax_rate_1', 5, 2)->default(0);
            $table->decimal('ppn_value', 18, 2)->default(0);
            $table->enum('tax_type_2', ['PPh22', 'PPh23', 'none'])->default('none');
            $table->decimal('tax_rate_2', 5, 2)->default(0);
            $table->decimal('bea_masuk_rate', 5, 2)->default(0);
            $table->decimal('bea_masuk_value', 18, 2)->default(0);
            $table->decimal('total_tax', 18, 2)->default(0);
            $table->decimal('material_cost', 18, 2)->default(0);
            $table->decimal('labor_cost', 18, 2)->default(0);
            $table->decimal('mitigation', 18, 2)->default(0);
            $table->decimal('total_cost', 18, 2)->default(0);
            $table->decimal('commission_cashback', 18, 2)->default(0);
            $table->decimal('other_costs', 18, 2)->default(0);
            $table->decimal('profit', 18, 2)->default(0);
            $table->decimal('profit_margin', 18, 2)->default(0);
            $table->decimal('cash_inflow', 18, 2)->default(0);
            $table->enum('status', ['Open', 'Partial', 'Paid', 'Cancelled'])->default('Open');
            $table->string('bod_ref')->nullable();
            $table->boolean('is_deleted')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rs_format');
    }
};

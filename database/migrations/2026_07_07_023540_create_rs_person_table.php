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
        Schema::create('rs_person', function (Blueprint $table) {
            $table->uuid('id')->primary()->defaultRaw('gen_random_uuid()');
            $table->foreignUuid('am_user_id')->constrained('users');
            $table->string('period_label', 20);
            $table->date('period_start');
            $table->date('period_end');
            $table->enum('category', ['Sales', 'Project'])->default('Sales');
            $table->decimal('commission_total', 18, 2)->default(0);
            $table->decimal('expected_income_after_tax', 18, 2)->default(0);
            $table->decimal('income_received_actual', 18, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rs_person');
    }
};

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
        Schema::create('partnership_renewals', function (Blueprint $table) {
            $table->uuid('id')->primary()->defaultRaw('gen_random_uuid()');
            $table->foreignUuid('partnership_id')->constrained('partnerships')->cascadeOnDelete();
            $table->date('renewal_date');
            $table->date('new_expire_date');
            $table->string('grade_before')->nullable();
            $table->string('grade_after')->nullable();
            $table->text('notes')->nullable();
            $table->foreignUuid('actioned_by')->constrained('users');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partnership_renewals');
    }
};

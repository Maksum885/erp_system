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
        Schema::create('partnerships', function (Blueprint $table) {
            $table->uuid('id')->primary()->defaultRaw('gen_random_uuid()');
            $table->foreignUuid('brand_id')->constrained('brands');
            $table->foreignUuid('company_id')->constrained('companies');
            $table->foreignUuid('managed_by')->constrained('users');
            $table->string('grade')->nullable();           // Authorized Partner, dll
            $table->string('admin_email')->nullable();
            $table->string('link_partnership')->nullable();
            $table->enum('status', ['Registered', 'On Progress', 'Expired']);
            $table->date('register_date')->nullable();
            $table->date('expire_date')->nullable();
            $table->text('remarks')->nullable();
            $table->text('next_plan')->nullable();
            $table->boolean('is_deleted')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partnerships');
    }
};

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
        Schema::create('partnership_documents', function (Blueprint $table) {
            $table->uuid('id')->primary()->defaultRaw('gen_random_uuid()');
            $table->foreignUuid('partnership_id')->constrained('partnerships')->cascadeOnDelete();
            $table->enum('doc_type', ['Certificate', 'NDA', 'Auth Letter', 'Other']);
            $table->string('file_url');
            $table->date('issue_date')->nullable();
            $table->date('expire_date')->nullable();
            $table->text('notes')->nullable();
            $table->timestamp('uploaded_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partnership_documents');
    }
};

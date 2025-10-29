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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
            $table->foreignId('block_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('client_name');
            $table->string('client_email')->nullable();
            $table->string('client_phone')->nullable();
            $table->integer('score')->default(5); // 1-5 stars
            $table->text('review_text');
            $table->boolean('active')->default(true);
            $table->integer('sort')->default(0);
            $table->json('meta')->nullable(); // For additional data
            $table->timestamps();
            
            $table->index(['tenant_id', 'active']);
            $table->index(['tenant_id', 'sort']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
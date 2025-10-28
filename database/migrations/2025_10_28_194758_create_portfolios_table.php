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
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
            $table->foreignId('block_id')->nullable();
            $table->string('name')->nullable()->index();
            $table->string('image')->nullable();
            $table->text('caption')->nullable();
            $table->boolean('active')->default(true);
            $table->integer('sort')->default(0);
            $table->json('meta')->nullable();
            $table->timestamps();
            
            $table->index(['tenant_id', 'active', 'sort']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};

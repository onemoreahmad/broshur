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
        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
            $table->foreignId('block_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('job_title');
            $table->text('bio')->nullable();
            $table->string('image')->nullable();
            $table->boolean('active')->default(true);
            $table->integer('sort')->default(0);
            $table->json('meta')->nullable(); // For additional data
            $table->timestamps();
            
            $table->index(['tenant_id', 'active']);
            $table->index(['tenant_id', 'sort']);
        });
    }
 
};

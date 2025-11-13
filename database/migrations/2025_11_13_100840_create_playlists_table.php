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
        Schema::create('playlists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
            $table->foreignId('block_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('logo')->nullable();
            $table->string('cover')->nullable();
            $table->text('description')->nullable();
            $table->boolean('active')->default(true);
            $table->json('meta')->nullable();
            $table->integer('sort')->default(0);
            $table->timestamps();
            
            $table->index(['tenant_id', 'active']);
            $table->index(['tenant_id', 'sort']);
        });


        Schema::create('playlist_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('playlist_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('cover')->nullable();
            $table->string('path')->nullable();
            $table->string('file')->nullable();
            $table->string('link')->nullable();
            $table->string('type')->nullable();
            $table->json('meta')->nullable();
            $table->integer('sort')->default(0);
            $table->timestamps();
            
            $table->index(['playlist_id', 'sort']);
        });
    }
 
};

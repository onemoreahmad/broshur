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
        Schema::create('service_addons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->integer('price')->nullable();
            $table->boolean('active')->default(true);
            $table->integer('sort')->default(0);
            $table->timestamps();
            
            $table->index(['service_id', 'active']);
            $table->index(['service_id', 'sort']);
        });
    }
};

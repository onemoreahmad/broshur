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
        Schema::create('links', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('block_id')->nullable();
            $table->string('name')->nullable();
            $table->string('slug')->nullable()->index();
            $table->string('link')->nullable();
            $table->string('type', 100)->nullable()->default('link');
            $table->json('meta')->nullable();
            $table->boolean('active')->default(true);
            $table->unsignedSmallInteger('sort')->default(1000)->index();
            $table->softDeletes();
            $table->timestamps();
        });
    }
 
};

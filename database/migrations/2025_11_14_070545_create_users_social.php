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
       
        Schema::create('users_social', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');
            $table->string('provider');
            $table->string('provider_id');
            $table->text('provider_token')->nullable();
            $table->string('provider_refresh_token')->nullable();
            $table->json('meta')->nullable();
            $table->timestamps();  
            $table->index(['user_id', 'provider']);
        });
    }
};

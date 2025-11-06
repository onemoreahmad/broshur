<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subscribers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Tenant::class)->constrained()->cascadeOnDelete();
            $table->string('name')->nullable();
            $table->string('email');
            $table->json('meta')->nullable();
            $table->timestamps();

            $table->unique(['tenant_id', 'email']);
        });
    }
 
};


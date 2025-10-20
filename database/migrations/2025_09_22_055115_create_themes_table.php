<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 
    public function up(): void
    {
        Schema::create('themes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->default(1)->nullable();
            $table->unsignedBigInteger('tenant_id')->default(1)->nullable();
            $table->string('slug')->nullable()->index();
            $table->string('type', 80)->default('site-theme');
            $table->string('app', 100)->default('linkinbio')->nullable();
            $table->string('subtype', 80)->nullable();
            $table->string('name')->nullable();
            $table->json('meta')->nullable();
            $table->boolean('is_system')->default(false);
            $table->boolean('active')->default(true);
            $table->boolean('is_published')->default(true); // published on catalog for clients, for example
            $table->boolean('is_purchasable')->default(0);
            $table->integer('price')->default(0);
            $table->string('recurring', 40)->default('once'); //if theme = once, entry-type=monthly, or addon to current plan
            $table->unsignedTinyInteger('is_picked')->default(0);
            $table->unsignedTinyInteger('is_private')->default(0);
            $table->unsignedTinyInteger('order')->default(100);
            $table->unique(['slug','app']);
            $table->softDeletes();
            $table->timestamps();
        });


        Schema::create('theme_options', function (Blueprint $table) {
            $table->id();
            $table->nullableMorphs('model');
            $table->unsignedBigInteger('tenant_id');
            $table->unsignedBigInteger('theme_id');
            $table->boolean('active')->default(true);
            $table->json('config')->nullable();
            $table->unsignedTinyInteger('order')->default(100);
            $table->timestamps();
        });
    }
 
};

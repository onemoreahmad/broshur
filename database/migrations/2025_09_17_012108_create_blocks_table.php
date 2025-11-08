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
        Schema::create('blocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id')->nullable()->index('blocks_tenant_idx');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('theme_id')->nullable();
            $table->unsignedBigInteger('entry_id')->nullable()->index('blocks_entry_idx');
            $table->string('name', 100)->index();
            $table->json('config')->nullable();
            $table->string('template', 150)->nullable();
            $table->string('position', 100)->default('page')->nullable();
            $table->unsignedSmallInteger('order')->default(0);
            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->index(['name', 'tenant_id'], 'blocks_name_tenant_idx');
            $table->index(['tenant_id', 'active', 'order'], 'blocks_tenant_active_order_idx');
        });
    }
 
};

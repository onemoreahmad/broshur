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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id')->nullable()->index('tickets_tenant_idx');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('subject');
            $table->text('message');
            $table->string('status')->default('open'); // open, closed, pending
            $table->integer('priority')->default(1); // 1: low, 2: medium, 3: high
            $table->json('attachments')->nullable(); // Store attachment URLs/paths
            $table->timestamp('closed_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('ticket_replies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ticket_id')->nullable()->index('ticket_replies_ticket_idx');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->text('message');
            $table->json('attachments')->nullable(); // Store attachment URLs/paths
            $table->boolean('is_admin_reply')->default(false); // Track if reply is from admin
            $table->timestamps();
            $table->softDeletes();
        });
    }

  
};

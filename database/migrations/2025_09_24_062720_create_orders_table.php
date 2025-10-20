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
 
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('number', 24)->nullable();
            $table->unsignedBigInteger('tenant_id')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('app_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('address_id')->nullable();
            $table->unsignedBigInteger('shipping_id')->nullable();
            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->unsignedBigInteger('assigned_id')->nullable();
            $table->unsignedBigInteger('affiliate_id')->nullable(); // or code used  ..
            $table->string('affiliate_code')->nullable();
            $table->string('title')->nullable();
            $table->string('shipping_type', 100)->default('pickup');
            $table->string('payment_status', 40)->default('unpaid');
            $table->string('fulfillment_status', 40)->default('unfulfilled');
            $table->json('data')->nullable();
            $table->integer('shipping_cost')->default(0);
            $table->integer('subtotal')->default(0);
            $table->integer('total')->default(0);
            $table->integer('discount')->default(0);
            $table->integer('tax')->default(0);
            $table->char('currency', 3)->default('SAR');
            $table->boolean('pinned')->default(false);
            $table->boolean('is_draft')->default(true);
            $table->string('type', 100)->default('order');
            $table->string('app', 100)->default('order');

            $table->string('imported_from_source')->nullable(); // from old system, excel, other platform ..etc + update created at when import order with date ..
            $table->datetime('imported_at')->nullable();
            $table->datetime('deliver_at')->nullable()->index();
            $table->datetime('delivered_at')->nullable();
            $table->json('meta')->nullable(); // to save any extra info about the order ? the sender, device, url etc .. ?
            $table->datetime('read_at')->nullable();
            $table->string('source', 50)->default('dashboard'); // dashboard, storefront,booking, mobile-android, phone, pos ..etc
            $table->timestamps();
            $table->softDeletes();
            // $table->unique(['number', 'tenant_id']);
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->unsignedBigInteger('calendar_id')->nullable();
            $table->nullableMorphs('model'); // product, service, item, etc ..
            $table->integer('amount')->default(0);
            $table->integer('discount')->default(0);
            $table->char('currency', 3)->default('SAR');
            $table->integer('total_pre_tax')->default(0);
            $table->integer('total_after_tax')->default(0);
 
            $table->integer('tax_amount')->default(0);
            $table->string('tax', 100)->default(0);
            $table->string('type', 100)->default('item');
            $table->json('data')->nullable();
            $table->datetime('start_date')->nullable();
            $table->datetime('end_date')->nullable();
            $table->string('timezone', 30)->default('UTC');
            $table->string('status', 100)->default('pending');
            $table->integer('quantity')->default(0);
            $table->timestamps();
        });
 
    }
 
};

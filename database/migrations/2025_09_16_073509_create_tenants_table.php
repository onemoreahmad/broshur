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
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('theme_id')->default(1); // 1 = default theme app
            $table->unsignedBigInteger('linkinbio_theme_id')->default(1); // 1 = default theme app
            $table->unsignedBigInteger('pages_theme_id')->default(1); // 1 = default theme app
            $table->unsignedBigInteger('blog_theme_id')->default(1); // 1 = default theme app
            $table->unsignedBigInteger('menu_theme_id')->default(1); // 1 = default theme app
            $table->string('handle')->unique()->index();
            $table->string('name');
            $table->string('domain')->unique()->index()->nullable();
            $table->unsignedTinyInteger('domain_status')->default(0);
            $table->json('meta')->nullable();
            $table->string('traffic_website_id')->nullable();
            $table->boolean('active')->default(true);
            $table->boolean('has_own_db')->default(false);
            $table->string('db_host', 20)->default('127.0.0.1')->nullable();
            $table->string('db_name', 100)->unique()->nullable();
            $table->string('db_username', 100)->nullable();
            $table->string('db_password', 100)->nullable();
            $table->string('currency', 4)->default('SAR')->nullable();
            $table->string('language', 4)->default('ar')->nullable();
            $table->string('country', 4)->default('SA')->nullable();
            $table->string('timezone', 40)->default('Asia/Riyadh')->nullable();
            $table->json('default_currencies')->nullable();
            $table->boolean('convert_currency')->nullable()->default(false);
            $table->string('sr_number', 60)->nullable();
            $table->string('tax_number', 120)->nullable();
            $table->json('address')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('logo')->nullable();
            $table->boolean('picked')->nullable()->default(false);
            $table->timestamp('verified_at')->nullable();
            $table->integer('reviews')->nullable()->default(0);
            $table->bigInteger('visits')->nullable()->default(0);
            $table->bigInteger('sales')->nullable()->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('tenantables', function (Blueprint $table) {
            $table->bigInteger('tenant_id')->unsigned();
            $table->morphs('tenantable');
            $table->boolean('active')->default(true);
            $table->json('meta')->nullable();
            $table->timestamps();
            $table->unique(['tenant_id', 'tenantable_id', 'tenantable_type'], 'tenantables_ids_type_unique');
            $table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('tenant_addons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id');
            $table->string('plugin', 100);
            $table->string('type', 100, 'plugin'); // what is the type of the addon (payment, analytics, etc)
            $table->boolean('active')->default(true);
            $table->json('config')->nullable();
            $table->unsignedTinyInteger('order')->default(100);
            $table->timestamps();
        });

    }

     
};

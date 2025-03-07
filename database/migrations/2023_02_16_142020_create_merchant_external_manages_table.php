<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantExternalManagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_external_manages', function (Blueprint $table) {
            $table->id();
            $table->foreign('business_id')->references('id')->on('business_profiles')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('business_id')->nullable();
            $table->foreign('location_id')->references('id')->on('business_locations')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('location_id')->nullable();
            $table->string('order_online_url')->nullable();
            $table->boolean('order_online_display')->default(false);
            $table->string('carrer_url')->nullable();
            $table->boolean('carrer_display')->default(false);
            $table->string('direct_website_url')->nullable();
            $table->boolean('direct_website_display')->default(false);
            $table->boolean('view_menu_display')->default(false);
            $table->boolean('view_flyer_display')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchant_external_manages');
    }
}

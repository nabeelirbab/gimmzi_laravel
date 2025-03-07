<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantSiteSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_site_settings', function (Blueprint $table) {
            $table->id();
            $table->enum('board_title',['weekly special', 'monthly special'])->nullable();
            $table->text('board_details')->nullable();
            $table->boolean('board_status')->default(false);
            $table->boolean('merchant_website_status')->default(false);
            $table->boolean('business_hour_status')->default(false);
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
        Schema::dropIfExists('merchant_site_settings');
    }
}

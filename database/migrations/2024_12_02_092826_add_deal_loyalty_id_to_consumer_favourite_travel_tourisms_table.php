<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDealLoyaltyIdToConsumerFavouriteTravelTourismsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('consumer_favourite_travel_tourisms', function (Blueprint $table) {
            $table->foreign('deal_id')->references('id')->on('deals')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('deal_id')->nullable();
            $table->foreign('loyalty_id')->references('id')->on('merchant_loyalty_programs')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('loyalty_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('consumer_favourite_travel_tourisms', function (Blueprint $table) {
            //
        });
    }
}

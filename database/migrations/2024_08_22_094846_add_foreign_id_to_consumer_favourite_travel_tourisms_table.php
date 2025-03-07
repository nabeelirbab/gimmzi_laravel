<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignIdToConsumerFavouriteTravelTourismsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('consumer_favourite_travel_tourisms', function (Blueprint $table) {
            $table->foreignId('business_id')->nullable()->constrained('business_profiles')->onDelete('cascade');
            $table->foreignId('hotel_id')->nullable()->constrained('travel_tourisms')->onDelete('cascade');
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

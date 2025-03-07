<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProviderIdToConsumerFavouriteTravelTourismsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('consumer_favourite_travel_tourisms', function (Blueprint $table) {
            $table->foreign('provider_id')->references('id')->on('providers')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('provider_id')->nullable();
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

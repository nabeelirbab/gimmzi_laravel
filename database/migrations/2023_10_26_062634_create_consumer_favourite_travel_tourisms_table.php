<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsumerFavouriteTravelTourismsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumer_favourite_travel_tourisms', function (Blueprint $table) {
            $table->id();
            $table->foreign('consumer_id')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('consumer_id')->nullable();
            $table->foreign('travel_tourism_id')->references('id')->on('travel_tourisms')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('travel_tourism_id')->nullable();
            $table->foreign('short_rental_id')->references('id')->on('short_term_rental_listings')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('short_rental_id')->nullable();
            $table->boolean('is_favourite')->nullable();
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
        Schema::dropIfExists('consumer_favourite_travel_tourisms');
    }
}

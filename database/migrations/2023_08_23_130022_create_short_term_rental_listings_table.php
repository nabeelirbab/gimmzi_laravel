<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShortTermRentalListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('short_term_rental_listings', function (Blueprint $table) {
            $table->id();
            $table->foreign('travel_tourism_id')->references('id')->on('travel_tourisms')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('travel_tourism_id')->nullable();
            $table->foreign('type_id')->references('id')->on('listing_types')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('type_id')->nullable();
            $table->string('name')->nullable();
            $table->string('street_address')->nullable();
            $table->string('room_number')->nullable();
            $table->string('city')->nullable();
            $table->string('zip_code')->nullable();
            $table->foreign('state_id')->references('id')->on('states')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('state_id')->nullable();
            $table->string('description')->nullable();
            $table->string('no_of_bedrooms')->nullable();
            $table->string('no_of_baths')->nullable();
            $table->string('no_of_half_baths')->nullable();
            $table->string('no_of_guests')->nullable();
            $table->string('listing_images')->nullable();
            $table->string('listing_video')->nullable();
            $table->boolean('status')->default(false)->nullable();
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
        Schema::dropIfExists('short_term_rental_listings');
    }
}

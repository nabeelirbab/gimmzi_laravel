<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTravelTourismFormSubmitAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travel_tourism_form_submit_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('first_email_address')->nullable();
            $table->string('second_email_address')->nullable();
            $table->string('third_email_address')->nullable();
            $table->string('fourth_email_address')->nullable();
            $table->string('fifth_email_address')->nullable();
            $table->foreign('listing_id')->references('id')->on('short_term_rental_listings')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('listing_id')->nullable();
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('travel_tourism_form_submit_addresses');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShortTermGuestBadgesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('short_term_guest_badges', function (Blueprint $table) {
            $table->id();
            $table->foreign('short_term_id')->references('id')->on('travel_tourisms')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('short_term_id')->nullable();
            $table->foreign('listing_id')->references('id')->on('short_term_rental_listings')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('listing_id')->nullable();
            $table->foreign('guest_id')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('guest_id')->nullable();
            $table->date('checkin_date')->nullable();
            $table->date('checkout_date')->nullable();
            $table->boolean('badge_status')->default(false);
            $table->integer('points')->nullable();
            $table->string('guest_email')->nullable();
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
        Schema::dropIfExists('short_term_guest_badges');
    }
}

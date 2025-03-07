<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestInfoForListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_info_for_listings', function (Blueprint $table) {
            $table->id();
            $table->foreign('short_term_id')->references('id')->on('travel_tourisms')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('short_term_id')->nullable();
            $table->foreign('listing_id')->references('id')->on('short_term_rental_listings')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('listing_id')->nullable();
            $table->string('guest_name')->nullable();
            $table->string('guest_phone')->nullable();
            $table->string('guest_email')->nullable();
            $table->string('adult')->nullable();
            $table->string('children')->nullable();
            $table->date('arrive_date')->nullable();
            $table->date('departure_date')->nullable();
            $table->text('comment')->nullable();
            $table->boolean('is_flexible')->default(false);
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
        Schema::dropIfExists('request_info_for_listings');
    }
}

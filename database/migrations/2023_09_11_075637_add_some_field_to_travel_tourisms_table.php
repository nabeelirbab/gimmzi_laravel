<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeFieldToTravelTourismsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('travel_tourisms', function (Blueprint $table) {
            $table->boolean('show_message_board')->default(false);
            $table->boolean('show_listing_website')->default(false);
            $table->boolean('show_guest_recognition')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('travel_tourisms', function (Blueprint $table) {
            //
        });
    }
}

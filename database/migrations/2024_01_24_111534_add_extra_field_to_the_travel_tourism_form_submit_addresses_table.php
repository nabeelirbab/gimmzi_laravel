<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraFieldToTheTravelTourismFormSubmitAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('travel_tourism_form_submit_addresses', function (Blueprint $table) {
            $table->foreignId('travel_tourism_id')->after('listing_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('travel_tourism_form_submit_addresses', function (Blueprint $table) {
            //
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTermLimitToTravelTourismSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('travel_tourism_settings', function (Blueprint $table) {
            $table->string('term_limit')->nullable()->after('travel_tourism_id');
            $table->integer('low_point_balance')->nullable()->after('add_point');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('travel_tourism_settings', function (Blueprint $table) {
            //
        });
    }
}

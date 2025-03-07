<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTwoFieldToApartmentGuestBadgesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('apartment_guest_badges', function (Blueprint $table) {
            $table->string('reward_type')->nullable()->after('point');
            $table->date('reward_active_on')->nullable()->after('reward_type')->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('apartment_guest_badges', function (Blueprint $table) {
            //
        });
    }
}




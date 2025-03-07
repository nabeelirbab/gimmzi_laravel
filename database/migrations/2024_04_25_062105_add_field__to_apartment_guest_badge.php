<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldToApartmentGuestBadge extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('apartment_guest_badges', function (Blueprint $table) {
            $table->string('zip_code')->nullable();
            $table->string('date_of_birth')->nullable();



            //
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

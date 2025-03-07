<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGuestPointDateToTheShortTermGuestBadgesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('short_term_guest_badges', function (Blueprint $table) {
            $table->date('guest_badge_point_date')->after('points')->nullable();
            $table->boolean('is_friend_and_family_badge_active')->after('guest_badge_point_date')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('short_term_guest_badges', function (Blueprint $table) {
            //
        });
    }
}

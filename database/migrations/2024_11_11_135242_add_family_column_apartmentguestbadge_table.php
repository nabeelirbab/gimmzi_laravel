<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFamilyColumnApartmentguestbadgeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('apartment_guest_badges', function (Blueprint $table) {
            
            $table->text('family_reward_type')->nullable()->after('reward_active_on'); 
            $table->date('family_friend_active_date')->nullable()->after('family_reward_type');   
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLocationToConsumerLoyaltyRewardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('consumer_loyalty_rewards', function (Blueprint $table) {
            $table->foreign('location_id')->references('id')->on('business_locations')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('location_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('consumer_loyalty_rewards', function (Blueprint $table) {
            //
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDealIdToConsumerLoyaltyRewardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('consumer_loyalty_rewards', function (Blueprint $table) {
            $table->foreign('deal_id')->references('id')->on('deals')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('deal_id')->nullable();
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

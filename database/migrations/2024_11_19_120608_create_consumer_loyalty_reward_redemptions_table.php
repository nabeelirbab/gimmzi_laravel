<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsumerLoyaltyRewardRedemptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumer_loyalty_reward_redemptions', function (Blueprint $table) {
            $table->id();
            $table->foreign('consumer_reward_id')->references('id')->on('consumer_loyalty_rewards')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('consumer_reward_id')->nullable();
            $table->foreign('loyalty_reward_id')->references('id')->on('merchant_loyalty_programs')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('loyalty_reward_id')->nullable();
            $table->string('given_amount')->nullable();
            $table->string('total_earning')->nullable();
            $table->string('points')->nullable();
            $table->string('remaining_point')->nullable();
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
        Schema::dropIfExists('consumer_loyalty_reward_redemptions');
    }
}

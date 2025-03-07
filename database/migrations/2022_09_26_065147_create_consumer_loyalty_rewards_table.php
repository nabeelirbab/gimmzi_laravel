<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsumerLoyaltyRewardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumer_loyalty_rewards', function (Blueprint $table) {
            $table->id();
            $table->foreign('consumer_id')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('consumer_id')->nullable();
            $table->foreign('loyalty_reward_id')->references('id')->on('merchant_loyalty_programs')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('loyalty_reward_id')->nullable();
            $table->date('join_date')->nullable();
            $table->string('program_process')->nullable();
            $table->string('program_process_percentage')->nullable();
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('consumer_loyalty_rewards');
    }
}

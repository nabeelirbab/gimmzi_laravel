<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoyaltyRewardLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loyalty_reward_locations', function (Blueprint $table) {
            $table->id();
            $table->foreign('loyalty_program_id')->references('id')->on('merchant_loyalty_programs')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('loyalty_program_id')->nullable();
            $table->foreign('location_id')->references('id')->on('business_locations')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('location_id')->nullable();
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
        Schema::dropIfExists('loyalty_reward_locations');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTravelTourismSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travel_tourism_settings', function (Blueprint $table) {
            $table->id();
            $table->foreign('travel_tourism_id')->references('id')->on('travel_tourisms')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('travel_tourism_id')->nullable();
            $table->integer('badge_bonus_point')->nullable();
            $table->integer('add_point')->nullable();
            $table->integer('guest_of_week_point')->nullable();
            $table->integer('double_booker_point')->nullable();
            $table->integer('triple_booker_point')->nullable();
            $table->integer('local_reward_point')->nullable();
            $table->string('check_in_hour')->nullable();
            $table->string('check_in_min')->nullable();
            $table->string('check_in_time')->nullable();
            $table->string('check_out_hour')->nullable();
            $table->string('check_out_min')->nullable();
            $table->string('check_out_time')->nullable();
            $table->integer('selected_merchant_number')->nullable();
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
        Schema::dropIfExists('travel_tourism_settings');
    }
}

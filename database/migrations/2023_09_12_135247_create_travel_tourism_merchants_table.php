<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTravelTourismMerchantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travel_tourism_merchants', function (Blueprint $table) {
            $table->id();
            $table->foreign('travel_tourism_id')->references('id')->on('travel_tourisms')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('travel_tourism_id')->nullable();
            $table->foreign('business_profile_id')->references('id')->on('business_profiles')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('business_profile_id')->nullable();
            $table->boolean('is_checked')->default(true);
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
        Schema::dropIfExists('travel_tourism_merchants');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelBadgesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_badges', function (Blueprint $table) {
            $table->id();
            $table->foreign('building_id')->references('id')->on('hotel_buildings')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('building_id')->nullable();
            $table->foreign('unit_id')->references('id')->on('hotel_unites')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->date('expected_end_date')->nullable();
            $table->boolean('status')->nullable();
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
        Schema::dropIfExists('hotel_badges');
    }
}

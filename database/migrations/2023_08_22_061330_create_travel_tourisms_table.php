<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTravelTourismsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travel_tourisms', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->enum('travel_tourism_type', ['Short Rental','Hotel-Resort'])->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('zip_code')->nullable();
            $table->foreign('state_id')->references('id')->on('states')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('state_id')->nullable();
            $table->string('phone')->nullable();
            $table->string('points_to_distribute')->nullable();
            $table->string('image')->nullable();
            $table->boolean('status')->default(false)->nullable();
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
        Schema::dropIfExists('travel_tourisms');
    }
}

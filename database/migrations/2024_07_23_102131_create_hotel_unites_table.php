<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelUnitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_unites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('building_id')->nullable()->constrained('hotel_buildings')->onDelete('cascade');
            $table->string('unit_name')->nullable();
            $table->string('unitId')->nullable();
            $table->bigInteger('hotel_id')->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('hotel_unites');
    }
}

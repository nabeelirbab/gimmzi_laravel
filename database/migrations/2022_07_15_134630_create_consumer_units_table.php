<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsumerUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumer_units', function (Blueprint $table) {
            $table->id();
            $table->foreignId('provider_type_id')->nullable()->constrained('providers');
            $table->foreignId('provider_user_id')->nullable()->constrained('users');
            $table->foreignId('provider_building_id')->nullable()->constrained('provider_buildings');
            $table->foreignId('unit_id')->nullable()->constrained('building_units');
            $table->foreignId('consumer_id')->nullable()->constrained('users');
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
        Schema::dropIfExists('consumer_units');
    }
}

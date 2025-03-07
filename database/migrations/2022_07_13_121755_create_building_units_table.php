<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildingUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building_units', function (Blueprint $table) {
            $table->id();
            $table->foreignId('consumer_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('building_id')->nullable()->constrained('provider_buildings')->onDelete('cascade');
            $table->string('unit')->nullable();
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
        Schema::dropIfExists('building_units');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProviderFloorPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_floor_plans', function (Blueprint $table) {
            $table->id();
            $table->foreign('property_id')->references('id')->on('providers')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('property_id')->nullable();
            $table->string('bedroom_1')->nullable();
            $table->string('bathroom_1')->nullable();
            $table->string('total_1')->nullable();
            $table->string('bedroom_2')->nullable();
            $table->string('bathroom_2')->nullable();
            $table->string('total_2')->nullable();
            $table->string('bedroom_3')->nullable();
            $table->string('bathroom_3')->nullable();
            $table->string('total_3')->nullable();
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
        Schema::dropIfExists('provider_floor_plans');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('provider_type_id')->nullable();
            $table->foreign('provider_type_id')->references('id')->on('provider_types');
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('business_website')->nullable();
            $table->string('points_to_distribute')->nullable();
            $table->string('points_cycle_date')->nullable();
            $table->string('business_logo_path')->nullable();
            $table->string('photo_path')->nullable();
            $table->boolean('status')->default(true)->nullable(); 
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
        Schema::dropIfExists('providers');
    }
}

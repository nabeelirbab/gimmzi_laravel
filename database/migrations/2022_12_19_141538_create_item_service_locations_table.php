<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemServiceLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_service_locations', function (Blueprint $table) {
            $table->id();
            $table->foreign('merchant_id')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('merchant_id')->nullable();

            $table->foreign('location_id')->references('id')->on('business_locations')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('location_id')->nullable();

            $table->foreign('item_id')->references('id')->on('item_or_services')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('item_id')->nullable();
            
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
        Schema::dropIfExists('item_service_locations');
    }
}

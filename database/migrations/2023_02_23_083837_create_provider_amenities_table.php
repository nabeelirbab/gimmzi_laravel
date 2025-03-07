<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProviderAmenitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_amenities', function (Blueprint $table) {
            $table->id();
            $table->foreign('property_id')->references('id')->on('providers')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('property_id')->nullable();
            $table->string('amenity_text')->nullable();
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
        Schema::dropIfExists('provider_amenities');
    }
}

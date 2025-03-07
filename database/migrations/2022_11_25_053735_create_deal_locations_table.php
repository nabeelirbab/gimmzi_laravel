<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDealLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deal_locations', function (Blueprint $table) {
            $table->id();
            $table->foreign('deal_id')->references('id')->on('deals')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('deal_id')->nullable();
            $table->foreign('location_id')->references('id')->on('business_locations')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('location_id')->nullable();
            $table->enum('participating_type', ['Participating', 'Non-participating'])->default('Non-participating');
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('deal_locations');
    }
}

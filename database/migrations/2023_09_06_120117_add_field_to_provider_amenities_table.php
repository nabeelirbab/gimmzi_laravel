<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldToProviderAmenitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('provider_amenities', function (Blueprint $table) {
            $table->foreign('listing_id')->references('id')->on('short_term_rental_listings')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('listing_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('provider_amenities', function (Blueprint $table) {
            //
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldToMerchantHoursOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('merchant_hours_operations', function (Blueprint $table) {
            $table->foreign('location_id')->references('id')->on('business_locations')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('location_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('merchant_hours_operations', function (Blueprint $table) {
            //
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantHoursOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_hours_operations', function (Blueprint $table) {
            $table->id();
            $table->foreign('business_id')->references('id')->on('business_profiles')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('business_id')->nullable();
            $table->string('day')->nullable();
            $table->boolean('is_closed')->default(false);
            $table->boolean('is_open')->default(true);
            $table->boolean('is_open_24_hours')->default(false);
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
        Schema::dropIfExists('merchant_hours_operations');
    }
}

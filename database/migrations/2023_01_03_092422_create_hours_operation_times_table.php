<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHoursOperationTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hours_operation_times', function (Blueprint $table) {
            $table->id();
            $table->foreign('hour_operation_id')->references('id')->on('merchant_hours_operations')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('hour_operation_id')->nullable();
            $table->integer('open_time_hour')->nullable();
            $table->integer('open_time_minute')->nullable();
            $table->enum('open_time', ['Am', 'Pm'])->nullable();
            $table->integer('close_time_hour')->nullable();
            $table->integer('close_time_minute')->nullable();
            $table->enum('close_time', ['Am', 'Pm'])->nullable();
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
        Schema::dropIfExists('hours_operation_times');
    }
}

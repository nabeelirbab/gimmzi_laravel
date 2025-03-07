<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProviderHoursOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_hours_operations', function (Blueprint $table) {
            $table->id();
            $table->foreign('property_id')->references('id')->on('providers')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('property_id')->nullable();
            $table->boolean('is_closed')->default(0);
            $table->boolean('is_open')->default(0);
            $table->string('day')->nullable();
            $table->string('open_time_hour')->nullable();
            $table->string('open_time_minute')->nullable();
            $table->string('open_time')->nullable();
            $table->string('close_time_hour')->nullable();
            $table->string('close_time_minute')->nullable();
            $table->string('close_time')->nullable();
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
        Schema::dropIfExists('provider_hours_operations');
    }
}

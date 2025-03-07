<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisplayDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('display_days', function (Blueprint $table) {
            $table->id();
            $table->foreign('display_board_id')->references('id')->on('display_boards')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('display_board_id')->nullable(); 
            $table->string('days')->nullable();
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
        Schema::dropIfExists('display_days');
    }
}

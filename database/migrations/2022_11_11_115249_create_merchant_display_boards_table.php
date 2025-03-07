<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantDisplayBoardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_display_boards', function (Blueprint $table) {
            $table->id();
            $table->foreign('display_board_id')->references('id')->on('display_boards')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('display_board_id')->nullable(); 
            $table->text('description')->nullable();
            $table->foreign('change_by')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('change_by')->nullable(); 
            $table->foreign('business_id')->references('id')->on('business_profiles')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('business_id')->nullable(); 
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
        Schema::dropIfExists('merchant_display_boards');
    }
}

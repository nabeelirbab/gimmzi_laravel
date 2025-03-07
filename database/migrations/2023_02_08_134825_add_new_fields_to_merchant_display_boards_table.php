<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFieldsToMerchantDisplayBoardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('merchant_display_boards', function (Blueprint $table) {
            $table->foreign('location_id')->references('id')->on('business_locations')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('location_id')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('add_message_date')->default(false);
            $table->foreign('display_board_id2')->references('id')->on('display_boards')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('display_board_id2')->nullable(); 
            $table->text('description2')->nullable();
            $table->date('start_date2')->nullable();
            $table->date('end_date2')->nullable();
            $table->boolean('add_message_date2')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('merchant_display_boards', function (Blueprint $table) {
            //
        });
    }
}

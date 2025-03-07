<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMerchantidToDisplayDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('display_days', function (Blueprint $table) {
            $table->foreign('merchant_board_id')->references('id')->on('merchant_display_boards')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('merchant_board_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('display_days', function (Blueprint $table) {
            //
        });
    }
}

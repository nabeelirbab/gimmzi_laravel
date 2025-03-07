<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMerchantidToGiftItemValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gift_item_values', function (Blueprint $table) {
            $table->foreign('merchant_id')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('merchant_id')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gift_item_values', function (Blueprint $table) {
            //
        });
    }
}

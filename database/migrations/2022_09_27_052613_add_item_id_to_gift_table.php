<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddItemIdToGiftTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gift_manages', function (Blueprint $table) {
            $table->foreign('item_id')->references('id')->on('item_or_services')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('item_id')->nullable();
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
        Schema::table('gift_manages', function (Blueprint $table) {
            //
        });
    }
}

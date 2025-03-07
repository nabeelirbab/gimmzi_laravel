<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGiftItemValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gift_item_values', function (Blueprint $table) {
            $table->id();
            $table->string('price')->nullable();
            $table->foreign('item_id')->references('id')->on('item_or_services')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('item_id')->nullable(); 
            $table->foreign('gift_id')->references('id')->on('gift_manages')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('gift_id')->nullable();
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
        Schema::dropIfExists('gift_item_values');
    }
}

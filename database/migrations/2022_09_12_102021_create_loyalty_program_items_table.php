<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoyaltyProgramItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loyalty_program_items', function (Blueprint $table) {
            $table->id();
            $table->foreign('loyalty_program_id')->references('id')->on('merchant_loyalty_programs')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('loyalty_program_id')->nullable();
            $table->string('item_name')->nullable();
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
        Schema::dropIfExists('loyalty_program_items');
    }
}

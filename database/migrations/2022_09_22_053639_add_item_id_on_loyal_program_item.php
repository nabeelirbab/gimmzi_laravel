<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddItemIdOnLoyalProgramItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loyalty_program_items', function (Blueprint $table) {
            $table->foreign('item_id')->references('id')->on('item_or_services')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('item_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('loyalty_program_items', function (Blueprint $table) {
            //
        });
    }
}

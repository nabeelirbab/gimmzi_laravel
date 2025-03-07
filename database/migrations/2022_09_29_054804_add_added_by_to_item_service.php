<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAddedByToItemService extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_or_services', function (Blueprint $table) { 
            $table->foreign('added_by')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('added_by')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('item_or_services', function (Blueprint $table) {
            //
        });
    }
}

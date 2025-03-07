<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldToLoyaltyProgram extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('merchant_loyalty_programs', function (Blueprint $table) {
            $table->string('spend_amount')->nullable();
            $table->string('discount_amount')->nullable();
            $table->enum('when_order',['current', 'next'])->nullable();
            $table->string('program_name')->nullable();
            $table->boolean('status')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('merchant_loyalty_programs', function (Blueprint $table) {
            //
        });
    }
}

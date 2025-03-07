<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantLoyaltyProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_loyalty_programs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('merchant_id')->nullable()->constrained('users');
            $table->enum('purchase_goal',['free', 'deal_discount'])->nullable();
            $table->text('items')->nullable();
            $table->integer('have_to_buy')->nullable();
            $table->integer('free_item_no')->nullable();
            $table->date('start_on')->nullable();
            $table->date('end_on')->nullable();
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
        Schema::dropIfExists('merchant_loyalty_programs');
    }
}

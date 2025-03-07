<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->bigInteger('consumer_loyalty_reward_id')->nullable();
            $table->boolean('is_refunded')->default(false);
            $table->boolean('refund_full_amount')->default(false);
            $table->boolean('refund_all_quantity')->default(false );
            $table->string('refund_amount')->nullable();
            $table->string('refund_quantity')->nullable();
            $table->bigInteger('user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->string('user_name');
            $table->string('member_name');
        });
    }
}

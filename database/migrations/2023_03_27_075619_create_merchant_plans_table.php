<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_plans', function (Blueprint $table) {
            $table->id();
            $table->string('plan_name')->nullable();
            $table->string('plan_title')->nullable();
            $table->string('plan_color')->nullable();
            $table->integer('active_deal_number')->nullable();
            $table->integer('access_user_number')->nullable();
            $table->integer('location_number')->nullable();
            $table->integer('loyalty_program_number')->nullable();
            $table->integer('item_services_number')->nullable();
            $table->boolean('is_free')->default(true);
            $table->decimal('monthly_amount')->nullable();
            $table->decimal('yearly_amount')->nullable();
            $table->integer('discount')->nullable();
            $table->integer('free_trial_Days')->nullable();
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('merchant_plans');
    }
}

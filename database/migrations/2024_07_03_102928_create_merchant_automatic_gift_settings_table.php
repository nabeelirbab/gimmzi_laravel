<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantAutomaticGiftSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_automatic_gift_settings', function (Blueprint $table) {
            $table->id();
            $table->foreign('business_id')->references('id')->on('business_profiles')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('business_id')->nullable();

            $table->boolean('progress_status')->default(false)->nullable();
            $table->foreign('progress_gift_id')->references('id')->on('gift_manages')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('progress_gift_id')->nullable();
            $table->string('program_progress')->nullable();

            $table->boolean('completion_status')->default(false)->nullable();
            $table->foreign('completion_gift_id')->references('id')->on('gift_manages')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('completion_gift_id')->nullable();
            $table->string('program_number')->nullable();
            $table->string('program_within')->nullable();
            $table->string('program_timeframe')->nullable();

            $table->boolean('birthday_incentive_status')->default(false)->nullable();
            $table->foreign('birthday_gift_id')->references('id')->on('gift_manages')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('birthday_gift_id')->nullable();
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
        Schema::dropIfExists('merchant_automatic_gift_settings');
    }
}

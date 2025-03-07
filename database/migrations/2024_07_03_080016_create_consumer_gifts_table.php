<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsumerGiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumer_gifts', function (Blueprint $table) {
            $table->id();
            $table->foreign('consumer_id')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('consumer_id')->nullable();
            $table->foreign('consumer_loyalty_id')->references('id')->on('consumer_loyalty_rewards')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('consumer_loyalty_id')->nullable();
            
            $table->string('program_progress')->nullable();
            $table->foreign('gift_id')->references('id')->on('gift_manages')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('gift_id')->nullable();
            $table->string('send_on')->nullable();
            $table->string('expire_on')->nullable();
            $table->string('send_by')->nullable();
            $table->foreign('send_user_by')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('send_user_by')->nullable();
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
        Schema::dropIfExists('consumer_gifts');
    }
}

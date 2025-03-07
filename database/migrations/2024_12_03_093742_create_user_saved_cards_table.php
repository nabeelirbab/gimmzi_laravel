<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSavedCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_saved_cards', function (Blueprint $table) {
            $table->id();
            $table->foreign('user_id')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('customer_id')->nullable();
            $table->string('payment_method_id')->nullable();
            $table->string('card_name')->nullable();
            $table->string('last_4')->nullable();
            $table->string('year')->nullable();
            $table->string('month')->nullable();
            $table->integer('set_default')->default(1);
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
        Schema::dropIfExists('user_saved_cards');
    }
}

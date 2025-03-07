<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumsConsumerRecognitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('consumer_recognitions', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('badge_id')->references('id')->on('apartmentbadges')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('badge_id')->nullable();
            $table->foreign('provider_id')->references('id')->on('providers')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('provider_id')->nullable();
            $table->string('reward_type')->nullable();
            $table->string('guest_email')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->date('reward_given_date')->nullable();
            $table->string('points_given')->nullable();
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
        //
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelGuestBadgesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_guest_badges', function (Blueprint $table) {
            $table->id();
            $table->foreign('user_id')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('badges_id')->references('id')->on('hotel_badges')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('badges_id')->nullable();
            $table->boolean('is_resend')->nullable();
            $table->boolean('status')->nullable();
            $table->integer('point')->nullable();
            $table->string('reward_type')->nullable();
            $table->date('reward_active_on')->nullable()->default(null);
            $table->string('guest_email')->nullable();
            $table->string('guest_first_name')->nullable();
            $table->string('guest_last_name')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('date_of_birth')->nullable();
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
        Schema::dropIfExists('hotel_guest_badges');
    }
}

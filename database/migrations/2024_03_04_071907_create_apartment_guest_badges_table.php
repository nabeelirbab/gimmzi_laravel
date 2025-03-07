<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentGuestBadgesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartment_guest_badges', function (Blueprint $table) {
            $table->id();
            $table->foreign('user_id')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('badges_id')->references('id')->on('apartmentbadges')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('badges_id')->nullable();
            $table->boolean('is_resend')->nullable();
            $table->boolean('status')->nullable();
            $table->integer('point')->nullable();
            $table->string('guest_email')->nullable();
            $table->string('guest_first_name')->nullable();
            $table->string('guest_last_name')->nullable();
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
        Schema::dropIfExists('apartment_guest_badges');
    }
}

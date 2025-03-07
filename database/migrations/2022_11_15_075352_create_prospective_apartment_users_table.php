<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProspectiveApartmentUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prospective_apartment_users', function (Blueprint $table) {
            $table->id();
            $table->foreign('prospective_apartment_id')->references('id')->on('prospective_appartment_lists')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('prospective_apartment_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->nullable();
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
        Schema::dropIfExists('prospective_apartment_users');
    }
}

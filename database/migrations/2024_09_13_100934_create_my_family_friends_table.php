<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyFamilyFriendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_family_friends', function (Blueprint $table) {
            $table->id();
            $table->foreign('consumer_id')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('consumer_id')->nullable();
            $table->foreign('invited_by')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('invited_by')->nullable();
            $table->string('type')->nullable();
            $table->boolean('getting_point')->nullable();
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
        Schema::dropIfExists('my_family_friends');
    }
}

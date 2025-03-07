<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSendRegistrationLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('send_registration_links', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->foreign('provider_user_id')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('provider_user_id')->nullable(); 
            $table->foreign('provider_id')->references('id')->on('providers')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('provider_id')->nullable(); 
            $table->boolean('is_email')->default(false);
            $table->boolean('is_phone')->default(false);
            $table->string('access_code')->nullable();
            $table->string('link_send_on')->nullable();
            $table->foreign('unit_id')->references('id')->on('building_units')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('unit_id')->nullable(); 
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
        Schema::dropIfExists('send_registration_links');
    }
}

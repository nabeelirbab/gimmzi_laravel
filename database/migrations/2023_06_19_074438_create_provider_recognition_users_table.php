<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProviderRecognitionUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_recognition_users', function (Blueprint $table) {
            $table->id();
            $table->foreign('provider_recognition_id')->references('id')->on('provider_tenant_recognitions')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('provider_recognition_id')->nullable();
            $table->foreign('tenant_id')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('tenant_id')->nullable();
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
        Schema::dropIfExists('provider_recognition_users');
    }
}

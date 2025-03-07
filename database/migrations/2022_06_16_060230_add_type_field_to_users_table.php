<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeFieldToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('provider_type_id')->nullable();
            $table->foreign('provider_type_id')->references('id')->on('provider_types')->onDelete('cascade');
            $table->unsignedBigInteger('provider_sub_type_id')->nullable();
            $table->foreign('provider_sub_type_id')->references('id')->on('provider_sub_types')->onDelete('cascade');
            $table->unsignedBigInteger('title_id')->nullable();
            $table->foreign('title_id')->references('id')->on('titles')->onDelete('cascade');
            $table->string('point_cycle_date')->nullable();
            $table->string('total_point_to_distribute')->nullable();
            $table->string('total_point_remaining_for_point_cycle')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}

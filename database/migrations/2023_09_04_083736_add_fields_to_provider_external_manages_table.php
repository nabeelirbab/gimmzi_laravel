<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToProviderExternalManagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('provider_external_manages', function (Blueprint $table) {
            $table->string('book_online_url')->nullable();
            $table->boolean('book_online_display')->default(false);
            $table->string('guest_portal_url')->nullable();
            $table->boolean('guest_portal_display')->default(false);
            $table->boolean('location_display')->default(false);
            $table->boolean('request_info_display')->default(false);
            $table->foreign('travel_tourism_id')->references('id')->on('travel_tourisms')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('travel_tourism_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('provider_external_manages', function (Blueprint $table) {
            //
        });
    }
}

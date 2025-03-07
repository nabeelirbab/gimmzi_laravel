<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMailAddressToBusinessProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_profiles', function (Blueprint $table) {
            $table->text('mailing_address')->nullable();
            $table->string('mailing_city')->nullable();
            $table->string('mailing_zipcode')->nullable();
            $table->foreign('mailing_state_id')->references('id')->on('states')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('mailing_state_id')->nullable();
            $table-> boolean('same_address')->default(true);
            $table-> boolean('no_physical_address')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_profiles', function (Blueprint $table) {
            //
        });
    }
}

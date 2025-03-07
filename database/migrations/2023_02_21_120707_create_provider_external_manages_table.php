<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProviderExternalManagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_external_manages', function (Blueprint $table) {
            $table->id();
            $table->foreign('property_id')->references('id')->on('providers')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('property_id')->nullable();
            $table->string('contact_community_url')->nullable();
            $table->boolean('contact_community_display')->default(false);
            $table->string('lease_online_url')->nullable();
            $table->boolean('lease_online_display')->default(false);
            $table->string('resident_portal_url')->nullable();
            $table->boolean('resident_portal_display')->default(false);
            $table->string('visit_website_url')->nullable();
            $table->boolean('visit_website_display')->default(false);
            $table->boolean('floor_plan_display')->default(false);
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
        Schema::dropIfExists('provider_external_manages');
    }
}

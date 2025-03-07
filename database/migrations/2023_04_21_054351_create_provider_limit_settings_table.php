<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProviderLimitSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_limit_settings', function (Blueprint $table) {
            $table->id();
            $table->foreign('property_id')->references('id')->on('providers')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('property_id')->nullable();
            $table->string('term_limit')->nullable();
            $table->string('frequency')->nullable();
            $table->integer('current_allowance_point_limit')->nullable();
            $table->integer('sign_up_bonus_point')->nullable();
            $table->integer('low_point_balance')->nullable();
            $table->integer('add_point')->nullable();
            $table->integer('tenant_of_the_month_Reward')->nullable();
            $table->integer('pass_inspection_reward')->nullable();
            $table->integer('great_tenant_reward')->nullable();
            $table->integer('community_helper_reward')->nullable();
            $table->integer('good_samaritan_reward')->nullable();
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('provider_limit_settings');
    }
}

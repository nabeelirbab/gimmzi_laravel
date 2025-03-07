<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreign('business_id')->references('id')->on('business_profiles')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('business_id')->nullable();
            $table->foreign('deal_id')->references('id')->on('deals')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('deal_id')->nullable();
            $table->foreign('loyalty_id')->references('id')->on('merchant_loyalty_programs')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('loyalty_id')->nullable();

            $table->string('event_name')->nullable();
            $table->boolean('is_event_advertise')->default(false)->nullable();
            $table->date('event_start_date')->nullable();
            $table->date('event_end_date')->nullable();
            $table->boolean('one_day_event')->default(false)->nullable();
            $table->string('event_street_address')->nullable();
            $table->string('event_city')->nullable();
            $table->string('event_state_id')->nullable();
            $table->string('event_zip')->nullable();
            $table->string('event_lat')->nullable();
            $table->string('event_long')->nullable();
            $table->boolean('event_status')->default(true)->nullable();
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
        Schema::dropIfExists('events');
    }
}

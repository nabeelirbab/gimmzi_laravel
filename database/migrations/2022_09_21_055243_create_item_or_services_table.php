<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemOrServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_or_services', function (Blueprint $table) {
            $table->id();
            $table->string('item_name')->nullable();
            $table->string('item_value')->nullable();
            $table->foreign('business_category_id')->references('id')->on('business_categories')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('business_category_id')->nullable();
            $table->text('note')->nullable();
            $table->boolean('status')->default(true);
            $table->foreign('merchant_id')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('merchant_id')->nullable();
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
        Schema::dropIfExists('item_or_services');
    }
}

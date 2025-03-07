<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGiftManagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gift_manages', function (Blueprint $table) {
            $table->id();
            $table->string('gift_name')->nullable();
            $table->string('gift_value')->nullable();
            $table->foreign('business_category_id')->references('id')->on('business_categories')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('business_category_id')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('gift_manages');
    }
}

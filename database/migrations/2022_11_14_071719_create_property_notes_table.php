<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_notes', function (Blueprint $table) {
            $table->id();
            $table->text('note')->nullable();
            $table->foreign('prospective_id')->references('id')->on('prospective_appartment_lists')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('prospective_id')->nullable();
            $table->enum('action_taken', ['Phone Call', 'Email Sent', 'Site Visited', 'Planned Site Visit', 'Added to Network', 'Unlist Provider', 'Relist']);
            $table->foreign('user_id')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->nullable();
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
        Schema::dropIfExists('property_notes');
    }
}

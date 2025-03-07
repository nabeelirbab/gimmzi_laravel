<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProviderMessageBoardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_message_boards', function (Blueprint $table) {
            $table->id();
            $table->foreign('provider_id')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('provider_id')->nullable();

            $table->foreign('message_board_id')->references('id')->on('message_boards')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('message_board_id')->nullable();
            
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('display_board')->default(false);
            $table->boolean('tenant_only')->default(false);
            $table->boolean('make_public')->default(false);
            $table->boolean('status')->default(true);
            $table->text('message')->nullable();
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
        Schema::dropIfExists('provider_message_boards');
    }
}

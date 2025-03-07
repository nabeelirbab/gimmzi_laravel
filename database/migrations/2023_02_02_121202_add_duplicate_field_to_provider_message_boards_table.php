<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDuplicateFieldToProviderMessageBoardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('provider_message_boards', function (Blueprint $table) {
            $table->foreign('message_board_id2')->references('id')->on('message_boards')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('message_board_id2')->nullable();
            
            $table->date('start_date2')->nullable();
            $table->date('end_date2')->nullable();
            $table->boolean('display_board2')->default(false);
            $table->boolean('tenant_only2')->default(false);
            $table->boolean('make_public2')->default(false);
            $table->text('message2')->nullable();
            $table->boolean('add_message_date2')->default(false);
            $table->boolean('add_message_date')->default(false)->after('end_date');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('provider_message_boards', function (Blueprint $table) {
            //
        });
    }
}

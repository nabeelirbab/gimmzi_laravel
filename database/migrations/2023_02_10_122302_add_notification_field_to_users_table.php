<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNotificationFieldToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('communication_setting')->nullable();
            $table->boolean('newsletter')->default(false);
            $table->boolean('gimmzi_update')->default(false);
            $table->boolean('special_promotion_offer')->default(false);
            $table->boolean('gimmzi_upcoming_event')->default(false);
            $table->boolean('unsubscribe_from_all')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}

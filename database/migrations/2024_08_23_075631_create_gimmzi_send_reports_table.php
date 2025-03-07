<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGimmziSendReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gimmzi_send_reports', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('report_id')->nullable();
            $table->bigInteger('send_to_user')->nullable();
            $table->string('report_doc')->nullable();
            $table->string('user_email')->nullable();
            $table->date('report_send_date')->nullable();
            $table->boolean('is_send')->nullable();
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
        Schema::dropIfExists('gimmzi_send_reports');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneratedReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generated_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id')->nullable()->constrained('report_types')->onDelete('cascade');
            $table->string('request_as')->nullable();
            $table->date('from_date')->nullable();
            $table->date('to_date')->nullable();
            $table->date('send_on')->nullable();
            $table->foreignId('business_id')->nullable()->constrained('business_profiles')->onDelete('cascade');
            $table->foreignId('generated_by')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('report_doc')->nullable();
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
        Schema::dropIfExists('generated_reports');
    }
}

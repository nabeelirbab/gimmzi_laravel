<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToGeneratedReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('generated_reports', function (Blueprint $table) {
            $table->boolean('is_request_end')->default(false);
            $table->foreignId('property_id')->nullable()->constrained('providers')->onDelete('cascade');
            $table->foreignId('travel_tourism_id')->nullable()->constrained('travel_tourisms')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('generated_reports', function (Blueprint $table) {
            //
        });
    }
}

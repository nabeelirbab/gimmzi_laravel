<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_videos', function (Blueprint $table) {
            $table->id();
            $table->foreign('business_profile_id')->references('id')->on('business_profiles')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('business_profile_id')->nullable();
            $table->string('video_path')->nullable();
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
        Schema::dropIfExists('business_videos');
    }
}

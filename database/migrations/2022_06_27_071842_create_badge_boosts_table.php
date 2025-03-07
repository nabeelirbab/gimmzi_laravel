<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBadgeBoostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('badge_boosts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('badges_id')->nullable()->constrained('badges')->onDelete('cascade');
            $table->text('description')->nullable();
            $table->string('boost_name')->nullable();
            $table->string('point')->nullable();
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('badge_boosts');
    }
}

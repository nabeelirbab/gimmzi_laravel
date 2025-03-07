<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsumerWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumer_wallets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('consumer_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('business_id')->nullable()->constrained('business_profiles')->onDelete('cascade');
            $table->foreignId('deal_id')->nullable()->constrained('deals')->onDelete('cascade');
            $table->foreignId('loyalty_id')->nullable()->constrained('merchant_loyalty_programs')->onDelete('cascade');
            $table->foreignId('badge_id')->nullable()->constrained('badges')->onDelete('cascade');
            $table->foreignId('location_id')->nullable()->constrained('business_locations')->onDelete('cascade');
            $table->integer('points')->nullable();
            $table->boolean('is_redeemed')->default(false)->nullable();
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
        Schema::dropIfExists('consumer_wallets');
    }
}

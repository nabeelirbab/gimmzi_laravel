<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('merchant_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('business_id')->nullable()->constrained('business_profiles')->onDelete('cascade');
            $table->foreignId('category_id')->nullable()->constrained('coupon_categories')->onDelete('cascade');
            $table->string('start_Date')->nullable();
            $table->string('end_Date')->nullable();
            $table->string('suggested_description')->nullable();
            $table->text('description')->nullable();
            $table->decimal('sales_amount', $precision = 8, $scale = 2)->nullable();
            $table->enum('discount_type', ['free', 'discount','percentage'])->nullable();
            $table->decimal('discount_amount', $precision = 8, $scale = 2)->nullable();
            $table->integer('point')->nullable();
            $table->integer('voucher_number')->nullable();
            $table->boolean('voucher_unlimited')->default(false);
            $table->enum('available_location', ['this_location', 'more_location','no_deal_location'])->nullable();
            $table->text('deal_location')->nullable();
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('deals');
    }
}

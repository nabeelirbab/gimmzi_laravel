<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProviderTenantRecognitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_tenant_recognitions', function (Blueprint $table) {
            $table->id();
            $table->foreign('type_id')->references('id')->on('recognition_types')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('type_id')->nullable();

            $table->string('provider_id')->nullable();
            
            $table->boolean('recognition_option')->default(false);
            $table->string('system_message')->nullable();
            $table->string('custom_message')->nullable();
            $table->boolean('tenant_only')->default(false);
            $table->boolean('make_public')->default(false);
            $table->boolean('status')->default(true);
            $table->boolean('is_published')->default(false);
            $table->string('month')->nullable();
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
        Schema::dropIfExists('provider_tenant_recognitions');
    }
}

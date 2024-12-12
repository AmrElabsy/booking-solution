<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('route_prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('price');
            $table->unsignedBigInteger('return_price')->nullable();
            $table->unsignedBigInteger('vehicle_model_id');
            $table->unsignedBigInteger('route_id');
            $table->foreign('vehicle_model_id')->references('id')->on('vehicle_models')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('route_id')->references('id')->on('routes')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('route_prices');
    }
};
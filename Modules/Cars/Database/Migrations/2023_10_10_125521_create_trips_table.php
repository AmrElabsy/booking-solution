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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date_time');
            $table->string('status');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('route_price_id');
            $table->timestamps();
            
            $table->foreign('customer_id')->on('customers')->references('id')->onDelete('CASCADE');
            $table->foreign('route_price_id')->on('route_prices')->references('id')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trips');
    }
};

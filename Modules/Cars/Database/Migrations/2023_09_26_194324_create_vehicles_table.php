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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('color');
            $table->string('add_field')->nullable();
            $table->boolean('isactive')->default(false);
            $table->unsignedBigInteger('model_id');
            $table->unsignedBigInteger('type_id');
            $table->foreign('model_id')->references('id')->on('vehicle_models')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('type_id')->references('id')->on('vehicle_types')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamp('license_date')->nullable();
            $table->timestamp('license_expire_date')->nullable();
            $table->timestamp('car_license')->nullable();
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
        Schema::dropIfExists('vehicles');
    }
};

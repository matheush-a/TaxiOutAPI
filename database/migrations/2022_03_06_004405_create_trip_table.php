<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('driver_id')->unsigned();
            $table->dateTime('date_time_begin');
            $table->integer('price');
            $table->integer('status_id')->unsigned();
            $table->string('origin_address');
            $table->string('destination_address');
            $table->timestamps();
            $table->foreign('driver_id')->references('id')->on('users');
            $table->foreign('status_id')->references('id')->on('trip_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trip');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatistikTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistik', function (Blueprint $table) {
            $table->unsignedBigInteger('area_id');
            $table->string('min_humidity')->nullable();
            $table->string('max_humidity')->nullable();
            $table->string('min_temperature_celcius')->nullable();
            $table->string('min_temperature_fahrenheit')->nullable();
            $table->string('max_temperature_celcius')->nullable();
            $table->string('max_temperature_fahrenheit')->nullable();
            $table->string('timerange')->nullable();
            $table->timestamps();
        });
        Schema::table('statistik', function (Blueprint $table){
            $table->foreign('area_id')->references('area_id')->on('wilayah');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statistik');
    }
}

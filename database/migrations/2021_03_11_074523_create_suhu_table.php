<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuhuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suhu', function (Blueprint $table) {
            $table->unsignedBigInteger('area_id');
            $table->string('celcius')->nullable();
            $table->string('fahrenheit')->nullable();
            $table->string('timerange')->nullable();
            $table->timestamps();
        });
        Schema::table('suhu', function (Blueprint $table){
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
        Schema::dropIfExists('suhu');
    }
}

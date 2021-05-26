<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArahAnginTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arah_angin', function (Blueprint $table) {
            $table->unsignedBigInteger('area_id');
            $table->string('deg')->nullable();
            $table->string('card')->nullable();
            $table->string('sexa')->nullable();
            $table->timestamp('timerange');
            $table->timestamps();
        });
        Schema::table('arah_angin', function (Blueprint $table){
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
        Schema::dropIfExists('arah_angin');
    }
}

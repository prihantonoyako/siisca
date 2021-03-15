<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKecepatanAnginTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kecepatan_angin', function (Blueprint $table) {
            $table->unsignedBigInteger('area_id');
            $table->string('knot')->nullable();
            $table->string('mph')->nullable();
            $table->string('kph')->nullable();
            $table->string('ms')->nullable();
            $table->string('timerange')->nullable();
            $table->timestamps();
        });
        Schema::table('kecepatan_angin', function (Blueprint $table){
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
        Schema::dropIfExists('kecepatan_angin');
    }
}

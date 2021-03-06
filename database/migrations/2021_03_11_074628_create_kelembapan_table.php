<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelembapanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelembapan', function (Blueprint $table) {
            $table->unsignedBigInteger('area_id');
            $table->string('kelembapan')->nullable();
            $table->timestamp('timerange');
            $table->timestamps();
        });
        Schema::table('kelembapan', function (Blueprint $table){
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
        Schema::dropIfExists('kelembapan');
    }
}

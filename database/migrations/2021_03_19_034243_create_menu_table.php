<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->id('id_menu');
            $table->unsignedBigInteger('id_group');
            $table->string('nama_menu',10);
            $table->string('url_menu')->nullable();
            $table->string('icon')->nullable();
            $table->timestamps();
        });
        Schema::table('menu', function (Blueprint $table){
            $table->foreign('id_group')->references('id_group')->on('menu_group');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu');
    }
}

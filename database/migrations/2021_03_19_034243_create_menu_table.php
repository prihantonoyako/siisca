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
            $table->unsignedInteger('urutan');
            $table->string('nama_menu');
            $table->string('url_menu');
            $table->string('icon');
            $table->enum('is_aktif',[0,1]);
            $table->timestamps();
        });
        Schema::table('menu', function (Blueprint $table){
            $table->foreign('id_group')->references('id_group')->on('menu_group');
            $table->unique(['id_group','urutan']);
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

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAksesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('akses', function (Blueprint $table) {
            $table->id('id_akses');
            $table->unsignedBigInteger('id_role');
            $table->unsignedBigInteger('id_menu');
            $table->enum('is_aktif',[0,1]);
            $table->timestamps();
        });
        Schema::table('akses', function (Blueprint $table){
            $table->foreign('id_role')->references('id_role')->on('role');
            $table->foreign('id_menu')->references('id_menu')->on('menu');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('akses');
    }
}

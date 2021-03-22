<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolePenggunaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_pengguna', function (Blueprint $table) {
            $table->id('id_role_pengguna');
            $table->unsignedBigInteger('id_pengguna');
            $table->unsignedBigInteger('id_role');
            $table->timestamps();
        });
        Schema::table('role_pengguna', function (Blueprint $table){
            $table->foreign('id_pengguna')->references('id_pengguna')->on('pengguna');
            $table->foreign('id_role')->references('id_role')->on('role');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_pengguna');
    }
}

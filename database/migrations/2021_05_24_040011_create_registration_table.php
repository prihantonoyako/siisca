<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registration', function (Blueprint $table) {
            $table->id('id_registration');
            $table->unsignedBigInteger('id_pengguna');
            $table->char('verification_code',40);
            $table->timestamps();
        });
        Schema::table('registration', function (Blueprint $table){
            $table->foreign('id_pengguna')->references('id_pengguna')->on('pengguna');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registration');
    }
}

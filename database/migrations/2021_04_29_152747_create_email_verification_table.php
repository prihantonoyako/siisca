<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailVerificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_verification', function (Blueprint $table) {
            $table->id('id_email_verification');
            $table->unsignedBigInteger('id_pengguna');
            $table->string('verification_code');
            $table->timestamps();
        });
        Schema::table('email_verification', function (Blueprint $table){
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
        Schema::dropIfExists('email_verification');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription', function (Blueprint $table) {
            $table->id('id_subscription');
            $table->unsignedBigInteger('id_pengguna');
            $table->unsignedBigInteger('id_subscription_plan');
            $table->timestamp('valid_thru');
            $table->timestamps();
        });
        Schema::table('subscription', function (Blueprint $table){
            $table->foreign('id_pengguna')->references('id_pengguna')->on('pengguna');
            $table->foreign('id_subscription_plan')->references('id_subscription_plan')->on('subscription_plan');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscription');
    }
}

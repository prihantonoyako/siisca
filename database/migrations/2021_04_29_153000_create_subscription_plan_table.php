<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionPlanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_plan', function (Blueprint $table) {
            $table->id('id_subscription_plan');
            $table->unsignedBigInteger('id_role');
            $table->string('nama');
            $table->unsignedInteger('month');
            $table->unsignedInteger('year');
            $table->timestamps();
        });
        Schema::table('subscription_plan', function (Blueprint $table){
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
        Schema::dropIfExists('subscription_plan');
    }
}

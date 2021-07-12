<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_group', function (Blueprint $table) {
            $table->id('id_group');
            $table->unsignedInteger('urutan');
            $table->string('nama_group',20);
            $table->string('url_group');
            $table->string('icon');
            $table->enum('is_aktif',[0,1]);
            $table->timestamps();
        });
        Schema::table('menu_group', function(Blueprint $table){
            $table->unique('urutan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_group');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRaportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('raport');
        Schema::create('raport', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('semester');
            $table->integer('absent');
            $table->dateTime('create_at');
            $table->dateTime('update_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::dropIfExists('raport');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConstantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('constant', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code',255);
            $table->string('name',255);
            $table->string('value',255);
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
        Schema::dropIfExists('constant');
    }
}

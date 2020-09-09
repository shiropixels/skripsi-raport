<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('role');

     Schema::create('role', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('name',45);
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
        Schema::dropIfExists('role');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRaportDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('raport_detail');

        Schema::create('raport_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('course_id');
            $table->bigInteger('raport_id');
            $table->double('score')->nullable();
            $table->double('practicume')->nullable();
            $table->string('description',255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('raport_detail');
    }
}

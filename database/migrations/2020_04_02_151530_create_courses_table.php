<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('course');

        Schema::create('course', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',45);
            $table->double('min_grade');
            $table->dateTime('create_at');
            $table->dateTime('update_at');
            $table->string('active',1);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course');
    }
}

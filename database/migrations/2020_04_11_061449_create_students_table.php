<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('student');
        Schema::create('student', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code',45);
            $table->string('name',45);
            $table->string('email',45);
            $table->string('password',255);
            $table->string('phone', 20);
            $table->string('profile_picture',255);
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
        Schema::dropIfExists('student');
    }
}

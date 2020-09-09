<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMStudentClasssTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::dropIfExists('m_student_class');
       Schema::create('m_student_class', function (Blueprint $table) {
        $table->bigInteger('student_id');
        $table->bigInteger('class_id');
        $table->bigInteger('raport_id');
        $table->string('start_year',4);
        $table->string('end_year',4);
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
        Schema::dropIfExists('m_student_class');
    }
}

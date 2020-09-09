<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMMpClasssTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('m_mp_class');

        Schema::create('m_mp_class', function (Blueprint $table) {
            $table->bigInteger('class_id');
            $table->bigInteger('course_id');
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
        Schema::dropIfExists('m_mp_class');
    }
}

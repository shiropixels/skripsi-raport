<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MStudentClass extends Model
{
    protected $table='m_student_class';
    protected $fillable=['student_id','class_id','raport_id','start_year','end_year','create_at','update_at','actuve'];

    public $timestamps = false;
    protected $primarykey = 'id';
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RaportDetail extends Model
{
    protected $table = 'raport_detail';
    protected $fillable = ['course_id','raport_id','score','practicume','description'];

    
    public $timestamps = false;
    protected $primarykey = 'id';
}

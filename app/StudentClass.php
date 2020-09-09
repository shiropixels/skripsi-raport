<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
    protected $table='class';
    protected $fillable=['id','class_name','peminatan','grade','create_at','update_at'];


    protected $primarykey = 'id';
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table='course';
    protected $fillable=['id','nama','min_grade', 'active', 'create_at','update_at'];

    public $timestamps = false;
    protected $primarykey = 'id';
}

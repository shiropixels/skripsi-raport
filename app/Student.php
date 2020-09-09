<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Student extends Model
{
    protected $table='student';
    protected $fillable=['id','code','name','email','password','phone','profile_picture','create_at','update_at','active'];

    public $timestamps = false;

    protected $primarykey = 'id';
}

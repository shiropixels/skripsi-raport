<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolInternal extends Model
{
	public $timestamps = false;
	protected $table='school_internal';
	
	protected $fillable=['id','name','email','phone','password','profile_picture','role_id','create_at','update_at','active'];


	protected $primarykey = 'id';
}



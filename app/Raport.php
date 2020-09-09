<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Raport extends Model
{
    protected $table='raport';
    protected $fillable=['id','semester','absent','create_at','update_at'];
    public $timestamps=false;
    protected $primaryKey = 'id';

  
}

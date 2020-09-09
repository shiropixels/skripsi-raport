<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Constant extends Model
{
    protected $table = 'constant';
    protected $fillable = ['id', 'code', 'name', 'value', 'create_at', 'update_at'];
    public $timestamps = false;

    protected $primarykey = 'id';
    
}

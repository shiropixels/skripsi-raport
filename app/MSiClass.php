<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MSiClass extends Model
{
    protected $table = 'm_si_class';
    protected $fillable = ['class_id', 'school_internal_id', 'raport_id','start_year', 'end_year', 'create_at', 'update_at', 'active'];
    public $timestamps = false;

}

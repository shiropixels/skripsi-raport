<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rapor_header extends Model
{
    protected $table = "rapor_headers";
    protected $fillable = ['id', 'tahun_ajaran','semester','grade','absen', 'rapor_id'];
    public $timestamps = false;

    protected $primaryKey = 'id';

  
}

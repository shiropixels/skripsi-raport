<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mata_pelajaran extends Model
{
    protected $table = 'mata_pelajarans';
    protected $fillable = ['id', 'nama_mata_pelajaran','kkm','create_at','update_at'];
    public $timestamps = false;

    protected $primaryKey = 'id';


    // public function Rapor_header()
    // {
    //     return $this->belongsTo('App\Raport_header');
    // }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Identifikasi_MataPelajaran extends Model
{
    protected $table = 'identifikasi_matapelajarans';
    protected $fillable = ['id', 'class_id', 'mata_pelajaran_id'];


    protected $primarykey = 'id';
}

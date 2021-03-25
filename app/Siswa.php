<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';

    public function kelas()
    {
        return $this->belongsTo('App\Kelas');
    }

    public function spp()
    {
        return $this->belongsToMany('App\Spp', 'siswa_spp');
    }
}

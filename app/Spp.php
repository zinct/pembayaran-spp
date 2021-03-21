<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spp extends Model
{
    protected $table = 'spp';

    public function kelas() 
    {
        return $this->belongsToMany('App\Kelas', 'spp_kelas');
    }

    public function tahun()
    {
        return $this->belongsTo('App\Tahun');
    }

    protected static function booted()
    {
        self::deleted(function ($spp) {
            $spp->kelas()->detach();
        });
    }
}

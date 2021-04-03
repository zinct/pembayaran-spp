<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    protected $table = 'tagihan';

    public function spp()
    {
        return $this->belongsTo('App\Spp');
    }

    public function siswa()
    {
        return $this->belongsTo('App\Siswa');
    }

    public function view()
    {
        return $this->belongsTo('App\TagihanView', 'id', 'id');
    }
}

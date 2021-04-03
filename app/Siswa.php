<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Siswa extends Authenticatable
{
    use Notifiable;
    protected $table = 'siswa';

    protected $hidden = [
        'password',
    ];

    public function kelas()
    {
        return $this->belongsTo('App\Kelas');
    }

    public function spp()
    {
        return $this->belongsToMany('App\Spp', 'tagihan')->withPivot('id');
    }
}

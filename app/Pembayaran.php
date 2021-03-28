<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';

    public function tagihan()
    {
        return $this->belongsTo('App\Tagihan');
    }
}

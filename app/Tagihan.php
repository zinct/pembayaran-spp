<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    protected $table = 'pembayaran';

    public function view()
    {
        return $this->belongsTo('App\TagihanView');
    }
}

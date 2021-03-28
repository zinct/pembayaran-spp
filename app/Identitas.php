<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Identitas extends Model
{
    protected $table = 'identitas';
    public $timestamps = false; 

    public static function get() {
        $collection = [];     
        $identitas = DB::table('identitas')->get();
        foreach($identitas as $row) {
            $collection[$row->key] = $row->value;
        }

        return collect($collection);
    }
}

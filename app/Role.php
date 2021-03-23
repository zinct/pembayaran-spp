<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';

    public function permissions()
    {
        return $this->belongsToMany('\App\Permission');
    }

    protected static function booted()
    {
        self::deleted(function ($role) {
            $role->permissions()->detach();
        });
    }
}

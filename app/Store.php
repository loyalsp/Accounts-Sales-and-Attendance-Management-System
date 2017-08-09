<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    public function getSale()
    {
        return $this->hasMany('App\Sale');
    }
}

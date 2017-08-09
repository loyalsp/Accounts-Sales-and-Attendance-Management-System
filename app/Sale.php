<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
protected $fillable =[
    'sale_today',
    'user_id',
    //'current_month',
    'store_id'
];

    public function getStore()
    {
        return $this->belongsTo('App\Store','store_id');
    }
}

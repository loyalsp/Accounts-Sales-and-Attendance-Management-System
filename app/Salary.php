<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
protected $fillable = [
    'salary_of_month',
    'status',
    'user_id'
];
public function getUser()
{
    return $this->belongsTo('App\User','user_id');
}
}

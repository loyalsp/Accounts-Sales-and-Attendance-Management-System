<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable=[
        'user_id',
        'check_in',
        'check_out',
        'leave_type',
    ];
    public function getUser()
    {
        return $this->belongsTo('App\User','user_id');
    }
}

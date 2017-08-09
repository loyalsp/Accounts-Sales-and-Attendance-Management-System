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
        'working_hours',
        'day',
        'store_id',
        //'current_date',
        //'current_month'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

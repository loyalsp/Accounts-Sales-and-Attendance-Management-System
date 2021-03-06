<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Notifications\Notifiable;
//use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Authenticatable;

class User extends Model implements \Illuminate\Contracts\Auth\Authenticatable,CanResetPasswordContract
{
    use Authenticatable,CanResetPassword,Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name', 'email', 'password','hourly_rate'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $guarded = [
        'is_admin'
    ];

    public function attendance()
    {
        return $this->hasMany('App\Attendance');
    }
    public function sale()
    {
        return $this->hasMany('App\Sale');
    }
    public function personal_information()
    {
        return $this->hasOne('App\PersonalInformation');
    }

    public function isAdmin()
    {
        return $this->is_admin;
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: adi
 * Date: 8/3/17
 * Time: 2:59 PM
 */

namespace App\Repositories;


use App\Attendance;
use App\Repositories\AbsNConcrete\CommonBehaviors;
use DB;

/**
 * Class AttendanceDao
 * @package App\Repositories
 */
class AttendanceDao extends CommonBehaviors
{
    /**
     * @var
     */
    protected $model;

    /**
     * @return string
     */
    public function model()
    {
        return 'App\Attendance';
    }

    /**
     * @param $user_id
     * @return mixed
     */
    public function getCurrentMonthAttendance($user_id)
    {
        return $this->model->where('user_id', $user_id)->
            whereMonth('created_at',date('m'))->
            whereYear('created_at',date('Y'))->get();
    }


    /**
     * @param $user_id
     * @return mixed if no row found it will return null, if found then it will return an object, else false
     */
    //function will get an attendance record of today against the user
    public function getTodayAttendance($user_id)
    {
        return $this->model->where('user_id', $user_id)
            ->whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->whereDay('created_at', date('d'))
            ->first();
    }

}
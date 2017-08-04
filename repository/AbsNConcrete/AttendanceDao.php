<?php
/**
 * Created by PhpStorm.
 * User: adi
 * Date: 8/3/17
 * Time: 2:59 PM
 */

namespace App\Repositories;


use App\Repositories\AbsNConcrete\CommonBehaviors;

/**
 * Class AttendanceDao
 * @package App\Repositories
 */
class AttendanceDao extends CommonBehaviors
{
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
    public function getMonthlyRecord($user_id)
    {
        return $this->getTable('attendances')->where('user_id', $user_id)->
        whereMonth('created_at', date('m'))
            ->whereYear('created_at', '=', date('Y'))->get();
    }

    /**
     * @param $user_id
     * @return mixed
     */
    public function getTodayCheckIn($user_id)
    {
        return $this->getTable('attendances')->where('user_id', $user_id)->
        whereMonth('created_at', date('m'))->
        whereYear('created_at', date('Y'))->
        whereDay('created_at',date('d'))->first();
    }
}
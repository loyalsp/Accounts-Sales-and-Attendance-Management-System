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
use Illuminate\Container\Container;

/**
 * Class AttendanceDao
 * @package App\Repositories
 */
class AttendanceDao extends CommonBehaviors
{
    /**
     * @var
     */
    private $attendance;

    /**
     * AttendanceDao constructor.
     * @param $model
     */
    public function __construct(Attendance $attendance)
    {   parent::__construct(new Container());
        $this->attendance = $attendance;
    }

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
    public function userCurrentMonthAttendance($user_id)
    {
        return $this->attendance
            ->getRecordsByCurrentMonth()
            ->where('user_id', $user_id)
            ->get();
    }

/*    public function getCurrentMonthHours($user_id)
    {
        return $this->attendance
            ->getRecordsByCurrentMonth()
            ->where('user_id', $user_id)
            ->sum('working_hours');
    }*/


    /**
     * @param $user_id
     * @return mixed if no row found it will return null, if found then it will return an object, else false
     */
    //function will get an attendance record of today against the user
    /**
     * @param $user_id
     * @return mixed
     */
    public function getUserTodayAttendance($user_id)
    {
        return $this->attendance
            ->getRecordsByCurrentDate()
            ->where('user_id', $user_id)
            ->first();
    }

    /**
     * @param $column
     * @param $order
     * @param $limit int
     * @return mixed
     */
    public function getAttendancesHavingMaxHour($limit)
    {

        return $this->attendance
            ->getRecordsByCurrentMonth()
            ->orderBy('working_hours','desc')
            ->take($limit)->get();
    }

    public function getAllAttendancesByCurrentDate()
    {
        return $this->attendance->getRecordsByCurrentDate()
            ->get();
    }

    public function getAttendance($fromDate, $toDate, $user_id = null)
    {
            return $this->attendance->getRecords($fromDate, $toDate)
                ->where('user_id', $user_id)
                ->get();
    }

    public function getWorkingHour($fromDate,$toDate,$user_id)
    {
        return $this->attendance->getRecords($fromDate, $toDate)
            ->where('user_id',$user_id)
            ->sum('working_hours');
    }
}
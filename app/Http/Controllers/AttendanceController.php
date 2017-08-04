<?php
/**
 * Created by PhpStorm.
 * User: adi
 * Date: 8/3/17
 * Time: 2:47 PM
 */

namespace App\Http\Controllers;

use App\Repositories\AttendanceDao;
use Illuminate\Http\Request;
use DB;

class AttendanceController extends Controller
{
    private $attendanceDao;


    /**
     * AttendanceController constructor.
     * @param $attendanceDao
     */
    public function __construct(AttendanceDao $attendanceDao)
    {
        $this->attendanceDao = $attendanceDao;

    }


    public function check_in()
    {
        $user = $this->getUser();
        $user_id = $user->id;
        $current_time = $this->getCurrentTime();
        $record =$this->attendanceDao->getTodayCheckIn($user_id);
        if(is_null($record))
        {
            $checked_id= $this->attendanceDao->createRecord(['user_id' => $user_id,

                'check_in' => $current_time]);
            if($checked_id)
            {
                return redirect()->route('employee.index')->with(['success' =>'
                Check in at: '.$current_time]);
            }
        }
    }

    public function check_out()
    {
        $user = $this->getUser();
        $user_id = $user->id;
        $current_time = $this->getCurrentTime();
        $record = $this->attendanceDao->getTodayCheckIn($user_id);
        if(!is_null($record))
        {
            $check_out = $record->check_out;
            if(is_null($check_out))
            {
               $updated = $this->attendanceDao->updateRecord($record->id,['check_out' => $current_time]);
                if($updated)
                {
                    return redirect()->route('employee.index')->with(['success' =>'
                Check out at: '.$current_time]);
                }
            }
        }
        return redirect()->route('employee.index')->with(['fail' =>'
                You record not found or already checked out']);
    }

    public function showCurrentMonthRecord()
    {

        $current_date_time = $this->getCurrentDateTime();
        $user = $this->getUser();
        $user->first_name = $this->getFirstName($user);
        $records = $this->attendanceDao->getMonthlyRecord($user->id,$current_date_time);
        if(!is_null($records))
        return view('employee.monthly-record',['records' => $records,'user' => $user]);
        else return redirect()->route('employee.index')->with(['fail' => 'monthly record not found']);
    }
}
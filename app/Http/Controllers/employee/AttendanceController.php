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
use App\User;
use Illuminate\Support\Facades\Auth;
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


    public function post_check_in(Request $request)
    {
        $this->validate($request, [
            'store_id' => 'required|integer'
        ]);
        $user_id = $this->getUser()->id;
        $current_time = $this->getCurrentTime(); //format will be 'H:i:s' 00:00:00
        $current_date = $this->getCurrentDate('D M j'); // format day month year
        //$current_month = $this->getCurrentDate('y-m'); getting year and month only 00-00
        $today_attendance = $this->attendanceDao->getUserTodayAttendance($user_id);
        if (is_null($today_attendance))
        {
            $check_in = $this->attendanceDao->createRecord([
                'user_id' => $user_id,
                'store_id' => $request['store_id'],
                'current_date' => $current_date,
                'check_in' => $current_time]);
            if ($check_in)
            {
                return redirect()->route('employee.index')->with(['success' => '
                Check in at: ' . $current_time]);
            }
        }
        return redirect()->route('employee.index')->with(['fail' => '
               You have already Checked in']);
    }

    /**
     * @param $attendance
     * @return mixed
     */
    public function checkOutUser($attendance)
    {
        $check_in_time = $attendance->check_in;
        $current_time = $this->getCurrentTime();
        $working_hours = $this->getWorkingHours($check_in_time, $current_time);
        $update = $this->attendanceDao->updateRecord($attendance->id, [
            'check_out' => $current_time,
            'working_hours' => $working_hours
        ]);
        return $update; //return true if successfull.
    }

    public function showCurrentMonthAttendance()
    {

        $user = $this->getUser();
        $user->first_name = $this->getFirstName($user);
        $attendances = $this->attendanceDao->userCurrentMonthAttendance($user->id);
        if (!is_null($attendances))
        {
            return view('employee.monthly-attendance-record', ['attendances' => $attendances, 'user' => $user]);
        }
        return redirect()->route('employee.index')->with(['fail' => 'monthly record not found']);
    }

    public function getCheckOutPage()
    {
        $user = $this->getUser();
        $today_attendance = $this->attendanceDao->getUserTodayAttendance($user->id);
        $user->first_name = $this->getFirstName($user);
        if (!is_null($today_attendance))
        {
            $today_attendance->first_name = $user->first_name;
            if (is_null($today_attendance->check_out))
            {
                return view('employee.sale-today', ['user' => $today_attendance]);
            }
        }
        return redirect()->route('employee.index')->with(['fail' => 'it seems that you
        have already checked out or not checked_id']);
    }

    /**
     * @param $check_in
     * @param $check_out
     * @return float
     */
    private function getWorkingHours($check_in, $check_out)
    {
        $check_in = strtotime($check_in);
        $check_out = strtotime($check_out);
        return round(abs($check_in - $check_out) / 3600, 2);

    }
}
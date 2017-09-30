<?php
/**
 * Created by PhpStorm.
 * User: Adi
 * Date: 9/11/2017
 * Time: 5:12 PM
 */

namespace App\Http\Controllers;
use App\Repositories\AttendanceDao;
use App\Repositories\UserDao;
use Illuminate\Http\Request;

class AdminAttendanceController extends  Controller
{
    private $attendanceDao;
    private $userDao;

    /**
     * AdminAttendanceController constructor.
     * @param $attendanceDao
     */
    public function __construct(AttendanceDao $attendanceDao,UserDao $userDao)
    {
        $this->attendanceDao = $attendanceDao;
        $this->userDao = $userDao;
    }

    public function getAttendancePage()
    {
        $today_attendances = $this->attendanceDao->getAllAttendancesByCurrentDate();
        $users = $this->userDao->getAllRecords();
        return view('admin.attendance-record',[
            'attendances' => $today_attendances,
            'users' => $users,
            'user_name' => null
        ]);
    }

    public function showUserAttendancesByDates(Request $request)
    {
        $this->validate($request, [
            'date_from' => 'required|date',
            'date_to' => 'required|date',
            'idAndName' => 'required',
        ]);
        
        $user = $this->getIdAndName($request);// will return an object that will contain two attributes user("id and name")
        $attendances = $this->attendanceDao->getAttendance($request['date_from'], $request['date_to'],$user->id);
        $users = $this->userDao->getAllRecords();
        return view('admin.attendance-record',[
            'attendances' => $attendances,
            'user_name' =>$user->name,
            'users' => $users,
        ]);
    }
}
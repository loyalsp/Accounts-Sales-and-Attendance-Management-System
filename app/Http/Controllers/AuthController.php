<?php
/**
 * Created by PhpStorm.
 * User: adi
 * Date: 7/28/17
 * Time: 11:14 AM
 */

namespace App\Http\Controllers;

use App\Repositories\AttendanceDao;
use App\Repositories\StoreDao;
use App\Store;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Repositories\UserDao;

/**
 * Class AuthController
 * @package App\Http\Controllers
 */
class AuthController extends Controller
{
    /**
     * @var UserDao
     */
    private $attendanceDao;
    private $storeDao;
    /**
     * AuthController constructor.
     */
     public function __construct(AttendanceDao $attendanceDao,StoreDao $storeDao)
    {

        $this->attendanceDao = $attendanceDao;
        $this->storeDao = $storeDao;
    }


    /**
     * @return DateTime
     */


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function getIndex()
    {
        $user = $this->getUser();
        if(!is_null($user))
        {
            return redirect()->route('employee.index');
        }
        $time = $this->getCurrentTime('Gi');
        return view('index', ['time' => $time]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function post_employee_login(Request $request)
    {
        $this->validate($request,[
            'email' => 'required',
            'password' => 'required'
        ]);
        if (!Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            return redirect()->back()->with(['fail' => 'Incorrect credentials']);
        }
        return redirect()->route('employee.index')->with(['success' => 'You are logged in now']);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getHome ()
    {
        $stores = $this->storeDao->getAllRecords();
        $user = $this->getUser();
        $first_name = $this->getFirstName($user);
        $user->first_name = $first_name;
        $current_date = $this->getCurrentDate();
        $today_attendance = $this->attendanceDao->getTodayAttendance($user->id,$current_date);
        return view('employee.index',['user' => $user,
            'attendance' => $today_attendance,
            'stores' => $stores,]);

    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('index')->with(['success' => 'You are logged out now']);
    }

}
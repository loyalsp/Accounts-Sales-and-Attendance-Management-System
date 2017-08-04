<?php
/**
 * Created by PhpStorm.
 * User: adi
 * Date: 7/28/17
 * Time: 11:14 AM
 */

namespace App\Http\Controllers;

use App\Repositories\AttendanceDao;
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
    private $userDao;
    private $attendanceDao;
    /**
     * AuthController constructor.
     */
     public function __construct(UserDao $userDao,AttendanceDao $attendanceDao)
    {
        $this->userDao = $userDao;
        $this->attendanceDao = $attendanceDao;
    }


    /**
     * @return DateTime
     */
    public function current_time()
    {
        return $this->getDateTime();
    }

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
        $time = $this->current_time();
        $time = $time->format('Gi');
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
        $user = $this->getUser();
        $first_name = $this->getFirstName($user);
        $user->first_name = $first_name;
        $attendance = $this->attendanceDao->getTodayCheckIn($user->id);
        return view('employee.index',['user' => $user, 'attendance' => $attendance]);
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
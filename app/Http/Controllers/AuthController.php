<?php
/**
 * Created by PhpStorm.
 * User: adi
 * Date: 7/28/17
 * Time: 11:14 AM
 */

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    /**
     * @return DateTime
     */
    public function getDateTime()
    {
        return new DateTime('Asia/Karachi');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function getHome()
    {
        $user = $this->getUser();
        if(!is_null($user))
        {
            return redirect()->route('employee.index');
        }
        $time = $this->getDateTime();
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
            return redirect()->back()->with(['fail' => 'sorry could not log in']);
        }
        return redirect()->route('employee.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getDashboard()
    {
        $user = $this->getUser();
        $first_name = $this->getFirstName($user);
        $user->first_name = $first_name;
        return view('employee.index',['user' => $user]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('index')->with(['success' => 'You are logged out']);
    }

    /**
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    private function getUser()
    {
        //getting authenticated user
        return Auth::user();
    }

    /**
     * @param $user
     * @return string
     */
    private function getFirstName($user)
    {
        $full_name = $user->full_name;
        $array = explode(' ',trim($full_name));
        $first_name = ucfirst($array[0]);
        return $first_name;
    }
}
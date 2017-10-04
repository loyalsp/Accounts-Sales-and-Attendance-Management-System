<?php
/**
 * Created by PhpStorm.
 * User: adi
 * Date: 8/3/17
 * Time: 1:36 PM
 */

namespace App\Http\Controllers;;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Http\Controllers\Auth;


class PasswordResetController extends Controller
{
    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
}
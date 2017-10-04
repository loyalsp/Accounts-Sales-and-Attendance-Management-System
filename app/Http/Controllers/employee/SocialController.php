<?php
/**
 * Created by PhpStorm.
 * User: adi
 * Date: 7/31/17
 * Time: 5:17 PM
 */

namespace App\Http\Controllers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\User;
use DB;



class SocialController extends Controller
{

    /**
     * Redirect the user to the facebook authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from facebook.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        try
        {
            $social_user = Socialite::driver('facebook')->user();
        }
        catch(\Exception $e) {
            return redirect()->route('index');
        }

        $social_email = $social_user->getEmail();
        $app_user = User::where('email',$social_email)->first();
        if(!is_null($app_user))
        {
            Auth::login($app_user);
            return redirect()->route('employee.index');
        }
        return redirect()->route('index')->with(['fail' => 'Your facebook email does not match to aaams email']);
    }
}
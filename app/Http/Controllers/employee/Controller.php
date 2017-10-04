<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DateTimeZone;
/**
 * Class Controller
 * @package App\Http\Controllers
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    protected function getUser()
    {
        //getting authenticated user
        return Auth::user();
    }

    /**
     * @return \DateTime
     */
    protected function getDateTime()
    {
        return Carbon::now(new DateTimeZone('Asia/Karachi'));
    }

    /**
     * @param string $format
     * @return string
     */
    protected function getCurrentDate($format = 'Y-m-d')
    {
        return $this->getDateTime()->format($format);
    }

    /**
     * @param string $format
     * @return string
     */
    protected function getCurrentTime($format = 'H:i:s')
    {
        return $this->getDateTime()->format($format);
    }

    /**
     * @param string $format
     * @return string
     */
/*    protected function getCurrentDateTime($format = 'y-m-d H:i:s')
    {

        return $this->getDateTime()->format($format);
    }*/

    /**
     * @param $user
     * @return string
     */
    //$this function will extract first name from the user`s full name
    protected function getFirstName($user)
    {
        $full_name = $user->full_name;
        $array = explode(' ', trim($full_name));
        $first_name = ucfirst($array[0]);
        //view()->share();
        return $first_name;
    }

 /*   protected function getLastDay($format = 'Y-m-d')
    {

        $today = $this->getDateTime();
        $today->modify('- 1day');
        return $today->format($format);
    }*/

    protected function getIdAndName($request)
    {
        //instantiating an empty object to hold id and name from the request
        $id_and_name = new \stdClass();
        $id_and_name->id = null;
        $id_and_name->name = null;
        if (!is_null($request['idAndName'])) // we will pass data to this $request array key in this form "1,name"
        {
            $array = $request['idAndName'];
            $array = explode(',', $array);
            $id_and_name->id = $array[0];
            $id_and_name->name = $array[1];
        }
        return $id_and_name;
    }
    private function getLastMonth()
    {

     return $this->getDateTime()->subMonth(1)->toDateString();

    }
    protected function getDateWithLastMonth($dayNumber)
    {
        $last_month_date = $this->getLastMonth();
        return $this->getSpecificDate($last_month_date,$dayNumber); //0000-00-$date

    }
    protected function getSpecificDate($date,$dayNumber)
    {
        return substr($date,0, 8).$dayNumber;
    }
}

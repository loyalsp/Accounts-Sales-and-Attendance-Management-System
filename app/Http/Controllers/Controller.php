<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

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
        return new \DateTime('Asia/Karachi');
    }

    /**
     * @param string $format
     * @return string
     */
    protected function getCurrentDate($format = 'y-d-m')
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
    protected function getCurrentDateTime($format = 'y-m-d H:i:s')
    {
        return $this->getDateTime()->format($format);
    }

    /**
     * @param $user
     * @return string
     */
    protected function getFirstName($user)
    {
        $full_name = $user->full_name;
        $array = explode(' ',trim($full_name));
        $first_name = ucfirst($array[0]);
        return $first_name;
    }

    protected function getPreviousDay($format = 'y-d-m')
    {

        $today = $this->getDateTime();
        $today->modify('- 1day');
        return $today->format($format);
    }

}

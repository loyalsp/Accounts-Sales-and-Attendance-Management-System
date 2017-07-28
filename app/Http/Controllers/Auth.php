<?php
/**
 * Created by PhpStorm.
 * User: adi
 * Date: 7/28/17
 * Time: 11:14 AM
 */

namespace App\Http\Controllers;
use DateTime;


class Auth extends Controller
{
    public function getDateTime()
    {
        return new DateTime('Asia/Karachi');
    }
    public function getHome()
    {

        $time = $this->getDateTime();
        $time = $time->format('Gi');
        return view('index',['time' => $time]);
    }
}
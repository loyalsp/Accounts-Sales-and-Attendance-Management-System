<?php
/**
 * Created by PhpStorm.
 * User: adi
 * Date: 7/28/17
 * Time: 11:14 AM
 */

namespace App\Http\Controllers;


class Auth extends Controller
{
    public function getHome()
    {
        return view('index');
    }
}
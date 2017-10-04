<?php
/**
 * Created by PhpStorm.
 * User: Adi
 * Date: 9/19/2017
 * Time: 4:01 PM
 */

namespace App\Repositories\Contracts;


interface ISaleRepository
{
    public function userCurrentMonthSale($user_id);
}
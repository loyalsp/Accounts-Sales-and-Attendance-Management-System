<?php
/**
 * Created by PhpStorm.
 * User: adi
 * Date: 8/6/17
 * Time: 10:37 AM
 */

namespace App\Repositories;

use App\Repositories\AbsNConcrete\CommonBehaviors;

class SaleDao extends CommonBehaviors
{
    protected $model;

    public function model()
    {
        return 'App\Sale';
    }

    public function userCurrentMonthSale($user_id)
    {
        return $this->getResultByCurrentMonth()
            ->where('user_id', $user_id);
    }


}
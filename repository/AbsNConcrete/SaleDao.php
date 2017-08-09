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

  /*  public function getCurrentMonthSale($user_id, $current_month)
    {
        return $this->model->getMonthlyRecord($user_id, $current_month);
    }*/

    public function getCurrentMonthSale($user_id)
    {
        return $this->model->where('user_id', $user_id)->
        whereMonth('created_at', date('m'))->
        whereYear('created_at', date('Y'))
            ->paginate(1);
    }
}
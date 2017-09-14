<?php
/**
 * Created by PhpStorm.
 * User: adi
 * Date: 8/6/17
 * Time: 10:37 AM
 */

namespace App\Repositories;

use App\Repositories\AbsNConcrete\CommonBehaviors;
use App\Sale;
use Illuminate\Container\Container;

/**
 * Class SaleDao
 * @package App\Repositories
 */
class SaleDao extends CommonBehaviors
{

    /**
     * @var Sale
     */
    private $sale;

    /**
     * SaleDao constructor.
     * @param Sale $sale
     */
    public function __construct(Sale $sale)
    {

        parent::__construct(new Container());
        $this->sale = $sale;

    }


    /**
     * @return string
     */
    public function model()
    {
        return 'App\Sale';
    }


    /**
     * @param $user_id
     * @return mixed
     */
    public function userCurrentMonthSale($user_id)
    {
        return $this->sale->getRecordsByCurrentMonth()
            ->where('user_id', $user_id)->paginate(3);
    }


    /**
     * @return mixed
     */
    public function getTodayAllSales()
    {
        return $this->sale->getRecordsByCurrentDate()->get();
    }


    /**
     * @param $fromDate
     * @param $toDate
     * @param null $user_id(int)
     * @return mixed
     */
    public function getAllSale($fromDate, $toDate, $user_id)
    {
        if (is_null($user_id))
        {
            return $this->sale->getRecords($fromDate, $toDate)
                    ->get();
        }
        return $this->sale->getRecords($fromDate, $toDate)
                ->where('user_id', $user_id)
                ->get();
    }

//or we can create a separate method for records against a user
    /**
     * @param $column string
     * @param $order
     * @param $limit null/int
     * @return mixed
     */

    public function getMaxSalesOfCurrentMonth($limit)
{

    return $this->sale->getRecordsByCurrentMonth()
        ->orderBy('sale_today','desc')
        ->take($limit)
        ->get();
}

    /**
     * @param $column string
     * @return mixed
     */
    public function getSumOfSaleColumn($column)
    {
        //sum is built in method of a model
        return $this->sale->sum($column);
    }

    public function getStoreSale($fromDate, $toDate, $store_id)
    {
        return $this->sale->getRecords($fromDate, $toDate)
            ->where('store_id', $store_id)
            ->get();
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: Adi
 * Date: 9/7/2017
 * Time: 9:09 PM
 */

namespace App\Http\Controllers;
use App\Repositories\StoreDao;
use App\Repositories\UserDao;
use App\Repositories\SaleDao;
use App\Store;
use Illuminate\Http\Request;

class AdminSaleController extends Controller
{
    private $saleDao;
    private $userDao;
    private $storeDao;

    public function __construct(SaleDao $saleDao, UserDao $userDao,StoreDao $storeDao)
    {

        $this->saleDao = $saleDao;
        $this->userDao = $userDao;
        $this->storeDao = $storeDao;
    }
    public function getAllSaleByCurrentDatePage()
    {

        $users = $this->userDao->getAllRecords();
        $grand_total = $this->saleDao->getSumOfSaleColumn('sale_today');
        return view('admin.sales-record',[
            'users' => $users,
            'grand_total' => $grand_total]);
    }
    public function showUserAllSaleByDates(Request $request)
    {
        $this->validate($request, [
            'date_from' => 'required|date',
            'date_to' => 'required|date',
        ]);
        $user =$this->getIdAndName($request);
        // if user_id is null it will get all record from sale table between the dates else
        // it will return all records against the user between the dates.
        $sales = $this->saleDao->getAllSale($request['date_from'], $request['date_to'], $user->id);
        //this function will get total sale of all stores till now
        $grand_total = $this->saleDao->getSumOfSaleColumn('sale_today');
        $users = $this->userDao->getAllRecords();
        return view('admin.sales-record', [
            'sales' => $sales,
            'grand_total' => $grand_total,
            'user_info' => $user,
            'users' => $users,
        ]);
    }

    public function getSaleByStorePage()
    {
        $stores = $this->storeDao->getAllRecords();
        return view('admin.store-sale-record',[
            'stores' => $stores
        ]);
    }

    public function showStoreSaleByDates(Request $request)
    {
        $this->validate($request, [
            'date_from' => 'required|date',
            'date_to' => 'required|date',
            'idAndName' => 'required',
        ]);
        $store = $this->getIdAndName($request);// will return an object that will contain two attributes store("id and name")
        $sales = $this->saleDao->getStoreSale($request['date_from'], $request['date_to'],$store->id);
        $stores = $this->storeDao->getAllRecords();
        return view('admin.store-sale-record',[
            'stores' => $stores,
            'store_name' =>$store->name,
            'sales' => $sales,
        ]);
    }

}
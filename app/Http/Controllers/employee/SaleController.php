<?php
/**
 * Created by PhpStorm.
 * User: adi
 * Date: 8/6/17
 * Time: 10:28 AM
 */

namespace App\Http\Controllers;

use App\Repositories\AttendanceDao;
use App\Repositories\SaleDao;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    private $saleDao;
    private $attendanceDao;

    public function __construct(SaleDao $saleDao, AttendanceDao $attendanceDao)
    {

        $this->saleDao = $saleDao;
        $this->attendanceDao = $attendanceDao;
    }

    /***************Employee Functionalities***************/
    public function postSaleNCheckOut(Request $request)
    {
        $this->validate($request, [
            'sale_today' => 'numeric|min:1',
            'store_id' => 'required',
            'user_id' => 'required'
        ]);
        $user_id = $this->getUser()->id;
        $today_attendance = $this->attendanceDao->getUserTodayAttendance($user_id);
        if (is_null($today_attendance) || !is_null($today_attendance->check_out))
        {
            return redirect()->route('employee.index')->with(['fail' => 'it seems that you
        have already checked out or not checked in']);
        }
        $this->checkOut($today_attendance);
        $this->saleDao->createRecord($request->all());
      /*  $user = User::find($user_id);
        $sale = new Sale();
        $sale->store_id = $request['store_id'];
        $sale->sale_today = $request['sale_today'];
        $user->sale()->save($sale);*/
        return redirect()->route('employee.index')->with(['success' => 'You have checked out now']);

    }

    public function showUserCurrentMonthSale()
    {

        $user = $this->getUser();
        $user->first_name = $this->getFirstName($user);
        $sales = $this->saleDao->userCurrentMonthSale($user->id);
        if (!is_null($sales))
        {

            return view('employee.monthly-sale-record', ['sales' => $sales, 'user' => $user]);

        }
        return redirect()->route('employee.index')->with(['fail' => 'monthly record not found']);
    }

    private function checkOut($attendance)
    {
        $attendanceCont = new AttendanceController($this->attendanceDao);
        $attendanceCont->checkOutUser($attendance);
    }

}

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
use Illuminate\Support\Facades\Auth;

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
    public function createSaleNCheckOut(Request $request)
    {
        $this->validate($request, [
            'sale_today' => 'numeric|min:1',
            'store_id' => 'required',
            'user_id' => 'required'
        ]);
        $user_id = $this->getUser()->id;
        $today_attendance = $this->attendanceDao->userTodayAttendance($user_id);
        if(is_null($today_attendance) || !is_null($today_attendance->check_out))
        {
            return redirect()->route('employee.index')->with(['fail' => 'it seems that you
        have already checked out or not checked_id']);
        }
        $this->checkOutUser($today_attendance);
        $this->saleDao->createRecord($request->all());
        return redirect()->route('employee.index')->with(['success'=> 'You have checked out now']);

    }

    public function showCurrentMonthSale()
    {

        $user = $this->getUser();
        $user->first_name = $this->getFirstName($user);
        $sales = $this->saleDao->userCurrentMonthSale($user->id)->paginate(3);
        if (is_object($sales)) {

            return view('employee.monthly-sale-record', ['sales' => $sales, 'user' => $user]);

        }
        return redirect()->route('employee.index')->with(['fail' => 'monthly record not found']);
    }
    
    private function checkOutUser($attendance)
    {
        $attendanceCont = new AttendanceController($this->attendanceDao);
        $attendanceCont->checkOut($attendance);
    }
    /******************Admin functionalities*************/
}

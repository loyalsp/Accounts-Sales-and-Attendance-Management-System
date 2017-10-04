<?php

namespace App\Http\Controllers;

use App\Sale;
use App\User;
use ConsoleTVs\Charts\Facades\Charts;
use App\Repositories\SaleDao;
use App\Repositories\AttendanceDao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{

    /**
     * AdminController constructor.
     */
    private $saleDao;
    private $attendanceDao;

    public function __construct(SaleDao $saleDao, AttendanceDao $attendanceDao)
    {
        $this->saleDao = $saleDao;
        $this->attendanceDao = $attendanceDao;
    }
//This function will set and send the chart into admin.index page
    public function getAdminIndex()
    {
        $limit = 5;
        //This call will get 5 records with in the current month from the table that have maximum 5 values in give column
        $sales = $this->saleDao->getMaxSalesOfCurrentMonth($limit);
        $sales_chart = 'Atleast 5 sales needed to render the chart';
        if (count($sales) == 5) {
            $salesNEmployees = $this->getLabelsAndValuesFor($sales); //setting up the labels and values for the chart
            $sales_chart = $this->getChart($salesNEmployees[0], $salesNEmployees[1],
                'Top 5 Sales of the current Month By the Employees', 'Sale in US $');
            //will get 5 records with in the current month
            $attendances = $this->attendanceDao->getAttendancesHavingMaxHour($limit);
            $hoursNEmployees = $this->getLabelsAndValuesFor($attendances);
            $attendance_chart = $this->getChart($hoursNEmployees[0], $hoursNEmployees[1],
                'Highest 5 Working hours of the current Month by Employees', 'Hours', 'line');
            $current_day_sale = $this->saleDao->getTodayAllSales();
            return view('admin.index', [
                'sale_chart' => $sales_chart,
                'attendance_chart' => $attendance_chart,
                'sales' => $current_day_sale
            ]);

        }
        return view('admin.index', ['sale_chart' => $sales_chart]);
    }

    private function getChart($labels, $values, $title, $elementLabel, $style = 'bar')
    {
        return Charts::create($style, 'highcharts')
            ->title($title)
            ->elementLabel($elementLabel)
            ->dimensions(500, 500)
            ->responsive(false)
            ->labels([$labels[0], $labels[1], $labels[2], $labels[3], $labels[4]])
            ->values([$values[0], $values[1], $values[2], $values[3], $values[4]])
            ->dimensions(0, 500);
    }

    private function getLabelsAndValuesFor($vars)
    {

        $labels = array();
        $values = array();
        $labelsAndValues = array();//it will be multidimensional array. its job is to hold $labels and $values arrays
        foreach ($vars as $var)
        {
            if ($var instanceof Sale)
            {
                $value = $var->sale_today;
                array_push($values, $value);
            } else
            {
                $value = $var->working_hours;
                array_push($values, $value);
            }
            array_push($labels, $var->user->full_name);
        }
        array_push($labelsAndValues, $labels, $values);
        return $labelsAndValues;

    }

    public function getAdminLogin()
    {
        return view ('admin.login');
    }
    public function postAdminLogin(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if(Auth::attempt($request->only('email','password')))
        {
            return redirect()->route('admin.index');
        }
        return redirect()->back()->with(['fail' => 'invalid login']);
    }

    public function get_logOut()
    {
        Auth::logout();
        return redirect()->route('admin.login')->with(['success' => 'Logged out']);
    }
}
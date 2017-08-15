<?php

namespace App\Http\Controllers;


use ConsoleTVs\Charts\Facades\Charts;
use App\Repositories\SaleDao;
use App\Repositories\AttendanceDao;


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

    public function getAdmin()
    {

        $sales = $this->saleDao->getTodayMaxValues('sale_today')->take(5)->get();
        $sales_chart = 'Atleast 5 sales needed to render the chart';
        if (count($sales) == 5) {
            $saleAndNames = $this->getLabelsAndValues($sales);
            $sales_chart = $this->getChart($saleAndNames[0], $saleAndNames[1], 'Top 5 Sales of the Day', 'Sale in $ :');
            $attendances = $this->attendanceDao->getTodayMaxValues('working_hours')->take(5)->get();
            $hoursAndName = $this->getLabelsAndValues($attendances);
            $attendance_chart = $this->getChart($hoursAndName[0], $hoursAndName[1], 'Top 5 Working hours of the Day', 'Hours', 'line');
            return view('admin.index', ['sale_chart' => $sales_chart, 'attendance_chart' => $attendance_chart]);
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

    private function getLabelsAndValues($vars)
    {

        $labels = array();
        $values = array();
        $labelsAndValues = array();
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
                array_push($values, $value);
            }
            array_push($labels, $var->user->full_name);
        }
        array_push($labelsAndValues, $labels, $values);
        return $labelsAndValues;

    }
}
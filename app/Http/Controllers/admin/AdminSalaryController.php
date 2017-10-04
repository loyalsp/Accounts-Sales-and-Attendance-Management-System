<?php
/**
 * Created by PhpStorm.
 * User: Adi
 * Date: 9/19/2017
 * Time: 4:54 PM
 */

namespace App\Http\Controllers;


use App\Repositories\AttendanceDao,
    App\Repositories\UserDao,
    App\Repositories\SalaryDao;


class AdminSalaryController extends Controller
{
    private $salaryDao;
    private $userDao;
    private $attendanceDao;

    /**
     * AdminSalaryController constructor.
     * @param $salaryDao
     * @param $userDao
     */
    public function __construct(SalaryDao $salaryDao, UserDao $userDao, AttendanceDao $attendanceDao)
    {
        $this->salaryDao = $salaryDao;
        $this->userDao = $userDao;
        $this->attendanceDao = $attendanceDao;
    }

    public function create_salary()
    {
        $current_date = $this->getCurrentDate();
        $current_day = substr($current_date, 0, 2);
        $last_month_date = $this->getDateWithLastMonth('26');
        $current_month_date = $this->getSpecificDate($current_date,'26');

        if ($current_day = 30 >= 26)
        {
            $salaries = $this->salaryDao->getCurrentMonthSalaries();
            if (count($salaries) !== 0)
            {
                $users = $this->userDao->getAllRecords();
                foreach ($users as $user)
                {
                    $working_hours = $this->attendanceDao->getWorkingHour($last_month_date,$current_month_date, $user->id);
                    $hourly_rate = $user->personal_information->hourly_rate;
                    $current_month_salary = $working_hours * $hourly_rate;
                    $this->salaryDao->create_salaries($current_month_salary, $user->id);
                }
                return redirect()->route('admin.current-month-salaries')->with(['success' => 'salaries has been created']);
            }
            return redirect()->route('admin.current-month-salaries')->with(['fail' =>'salaries has been already created']);
        }
        return redirect()->route('admin.current-month-salaries')->with(['fail' =>'To create the salaries current date must be 26 or higher']);
    }

    public function show_current_month_salaries()
    {
        $salaries = $this->salaryDao->getCurrentMonthSalaries();
        return view('admin.current-month-salaries', ['salaries' => $salaries]);
    }

    public function salary_paid($user_id)
    {
     $salary = $this->salaryDao->get_current_month_salary($user_id);
        if(!is_null($salary))
        {
            if ($salary->status == 'due')
            {
                $this->salaryDao->update_salary_status($salary->id);
                return redirect()->route('admin.current-month-salaries')->with(['success' => 'status has been updated']);
            }
        }
        return redirect()->back()->with(['fail' => 'salary record not found or already paid']);
    }
}
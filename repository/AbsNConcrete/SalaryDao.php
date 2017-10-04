<?php
/**
 * Created by PhpStorm.
 * User: Adi
 * Date: 9/19/2017
 * Time: 4:56 PM
 */

namespace App\Repositories;
use App\Attendance;
use App\Salary;
use App\User;
use App\Repositories\AbsNConcrete\CommonBehaviors;
use Illuminate\Container\Container;

class SalaryDao extends CommonBehaviors
{
   private $salary;

    public function __construct(Salary $salary)
    {
        parent::__construct(new Container());
        $this->salary = $salary;

    }

    public function model()
     {
         return 'App\Salary';
     }

    public function create_salaries($current_month_salary,$user_id)
    {
                    $this->createRecord(['user_id' => $user_id,
                        'salary_of_month' => $current_month_salary,
                        'status' => 'due']);
    }

    public function getCurrentMonthSalaries()
    {
        return $this->salary->getRecordsByCurrentMonth()->get();
    }
    
    public function get_current_month_salary($user_id)
    {
       return $this->salary->getRecordsByCurrentMonth()
        ->where('user_id',$user_id)
        ->first();
    }

    public function update_salary_status($salary_id)
    {
        return $this->updateRecord($salary_id,['status' => 'paid']);
    }
}
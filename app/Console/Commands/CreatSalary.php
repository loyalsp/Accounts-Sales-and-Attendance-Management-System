<?php

namespace App\Console\Commands;

use App\Attendance;
use App\Http\Controllers\AdminSalaryController;
use App\Repositories\AttendanceDao;
use App\Repositories\SalaryDao;
use App\Repositories\UserDao;
use App\Salary;
use App\User;
use Illuminate\Console\Command;

class CreatSalary extends Command
{
    private $adminSalaryCont;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:salary';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will create employee salaries after every minunts';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(AdminSalaryController $adminSalaryCont)
    {
        parent::__construct();
        $this->adminSalaryCont = $adminSalaryCont;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
       $this->adminSalaryCont->create_salary();
    }
}

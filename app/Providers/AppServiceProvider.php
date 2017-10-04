<?php

namespace App\Providers;

use App\Repositories\AttendanceDao;
use App\Repositories\SalaryDao;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\IRepository;
use App\Repositories\UserDao;
use App\Repositories\SaleDao;
use App\Repositories\StoreDao;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    /* $this->app->singleton(IRepository::class,UserDao::class);
        $this->app->singleton(IRepository::class,AttendanceDao::class);
        $this->app->singleton(IRepository::class,SaleDao::class);
        $this->app->singleton(IRepository::class,StoreDao::class);
        $this->app->singleton(IRepository::class,Queries::class);
     $this->app->singleton(IRepository::class,SalaryDao::class);*/
    }
}

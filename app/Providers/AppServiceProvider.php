<?php

namespace App\Providers;

use App\Repositories\AttendanceDao;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\IRepository;
use App\Repositories\UserDao;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(IRepository::class,UserDao::class);
        $this->app->singleton(IRepository::class,AttendanceDao::class);
    }
}

<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['web']], function () {
    /* ***************************************
                    Frontend routes
     * ***************************************/
    Route::get('/', [
        'uses' => 'AuthController@getIndex',
        'as' => 'index'
    ]);
    Route::get('/admin-logout', [
        'uses' => 'AdminController@get_logOut',
        'as' => 'admin-logout'
    ]);

    Route::post('/employee-login', [
        'uses' => 'AuthController@post_employee_login',
        'as' => 'employee-login'
    ]);
    Route::get('/admin-login', [
        'uses' => 'AdminController@getAdminLogin',
        'as' => 'admin.login'
    ]);

    Route::post('/post-admin-login', [
        'uses' => 'AdminController@postAdminLogin',
        'as' => 'post-admin-login'
    ]);


    Route::group(['middleware' => 'admin'], function ()
    {
/*  Route::get('/admin/login', [
            'uses' => 'AuthController@post_employee_login',
            'as' => 'employee-login'
        ]);*/
        Route::get('/admin/dashboard', [
            'uses' => 'AdminController@getAdminIndex',
            'as' => 'admin.index'
        ]);

        Route::get('/create_salary', [
            'uses' => 'AdminSalaryController@create_salary',
            'as' => 'create-salary'
        ]);

        Route::get('/current_month_salaries', [
            'uses' => 'AdminSalaryController@show_current_month_salaries',
            'as' => 'admin.current-month-salaries'
        ]);

        Route::get('/salary-paid/{user_id}', [
            'uses' => 'AdminSalaryController@salary_paid',
            'as' => 'update-salary-status'
        ]);

        Route::group(['prefix' => 'admin/employee'], function ()
        {
            Route::get('/sale-record', [
                'uses' => 'AdminSaleController@getAllSaleByCurrentDatePage',
                'as' => 'admin.sale-record'
            ]);

            Route::post('/sale/record', [
                'uses' => 'AdminSaleController@showUserAllSaleByDates',
                'as' => 'show-sale-by-dates'
            ]);

            Route::get('/store-sale', [
                'uses' => 'AdminSaleController@getSaleByStorePage',
                'as' => 'admin.store-sale'
            ]);

            Route::post('/store/sale', [
                'uses' => 'AdminSaleController@showStoreSaleByDates',
                'as' => 'show-store-sale'
            ]);

            Route::get('/attendance-record', [
                'uses' => 'AdminAttendanceController@getAttendancePage',
                'as' => 'admin.attendance-record'
            ]);

            Route::post('/attendance/record', [
                'uses' => 'AdminAttendanceController@showUserAttendancesByDates',
                'as' => 'show.attendance-record'
            ]);
            Route::get('/admin-logout', [
                'uses' => 'AdminController@get_logOut',
                'as' => 'admin-logout'
            ]);

        });
    });

    /* *************************************
     *          Employee routes
     * ************************************/
    Route::group(['middleware' => 'user'], function () {

        Route::group(['prefix' => 'employee'], function () {
            Route::get('/home', [
                'uses' => 'AuthController@getHome',
                'as' => 'employee.index'
            ]);

            Route::get('/logout', [
                'uses' => 'AuthController@getLogout',
                'as' => 'employee-logout'
            ]);
            Route::post('/check-in', [
                'uses' => 'AttendanceController@post_check_in',
                'as' => 'post-check-in'
            ]);


            Route::get('/check-out', [
                'uses' => 'AttendanceController@getCheckOutPage',
                'as' => 'employee.sale-today'
            ]);

            Route::post('/sale-today', [
                'uses' => 'SaleController@postSaleNCheckOut',
                'as' => 'post-employee.sale-today'
            ]);

            Route::get('/monthly/sale', [
                'uses' => 'SaleController@showUserCurrentMonthSale',
                'as' => 'employee.monthly-sale-record'
            ]);
            Route::get('/monthly-attendance', [
                'uses' => 'AttendanceController@showCurrentMonthAttendance',
                'as' => 'employee.monthly-attendance-record'
            ]);

        });
    });
});

//Socialite Routes
Route::get('login/facebook', [
    'uses' => 'SocialController@redirectToProvider',
    'as' => 'login-with-facebook'
]);
Route::get('login/facebook/callback', 'SocialController@handleProviderCallback');

Route::get('password-reset/{token?}', 'Auth\ResetPasswordController@showResetForm');
Route::post('password/email', 'Auth\ResetPasswordController@sendResetLinkEmail');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Auth::routes();



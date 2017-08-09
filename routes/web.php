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


    Route::post('/employee-login', [
        'uses' => 'AuthController@post_employee_login',
        'as' => 'employee-login'
    ]);


    /* *************************************
     *          Employee routes
     * ************************************/
    Route::group(['middleware' => 'auth'], function () {
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
                'uses' => 'AttendanceController@getCheckOut',
                'as' => 'employee.sale-today'
            ]);

            Route::post('/sale-today', [
                'uses' => 'SaleController@createSaleNCheckOut',
                'as' => 'post-employee.sale-today'
            ]);

            Route::get('/monthly/sale', [
                'uses' => 'SaleController@showCurrentMonthSale',
                'as' => 'employee.monthly-sale-record'
            ]);
            Route::get('/monthly/attendance', [
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



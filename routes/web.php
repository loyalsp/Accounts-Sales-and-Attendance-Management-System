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
        'uses' => 'AuthController@getHome',
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

        Route::get('/dashboard', [
            'uses' => 'AuthController@getDashboard',
            'as' => 'employee.index'
        ]);

        Route::get('/logout', [
            'uses' => 'AuthController@getLogout',
            'as' => 'employee-logout'
        ]);
        Route::get('/employee/check-in', [
            'uses' => 'AttendanceController@check_in',
            'as' => 'check-in'
        ]);
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



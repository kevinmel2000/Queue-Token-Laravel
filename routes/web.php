<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['middleware' => 'install'], function() {
    Route::get('/', ['as' => 'main', 'uses' => 'MainController@redirect']);
    Route::get('locale/{locale}', ['as' => 'change_locale', 'uses' => 'MainController@changeLocale']);

    // Login
    Route::get('login', ['as' => 'get_login', 'uses' => 'Auth\LoginController@showLoginForm']);
    Route::post('login', ['as' => 'post_login', 'uses' => 'Auth\LoginController@login']);

    // Forgot Password
    Route::get('password/email', ['as' => 'get_email', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
    Route::post('password/email', ['as' => 'post_email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);

    // Reset Password
    Route::get('password/reset/{token}', ['as' => 'get_reset', 'uses' => 'Auth\ResetPasswordController@showResetForm']);
    Route::post('password/reset', ['as' => 'post_reset', 'uses' => 'Auth\ResetPasswordController@reset']);

    // Add to Queue
    Route::get('queue', ['as' => 'add_to_queue', 'uses' => 'AddToQueueController@index']);
    Route::post('queue', ['as' => 'post_add_to_queue', 'uses' => 'AddToQueueController@postDept']);

    // Display
    Route::get('display', ['as' => 'display', 'uses' => 'DisplayController@index']);

    // Authenticated
	Route::group(['middleware' => 'auth:users'], function() {
        // Logout
		Route::post('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

		// Dashboard
		Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);
        Route::post('dashboard/settings', ['as' => 'dashboard_store', 'uses' => 'DashboardController@store']);

        // Calls
        Route::get('calls', ['as' => 'calls', 'uses' => 'CallController@index']);
        Route::post('calls', ['as' => 'post_call', 'uses' => 'CallController@newCall']);
        Route::post('calls/recall', ['as' => 'post_recall', 'uses' => 'CallController@recall']);
        Route::post('calls/dept/{department}', ['as' => 'post_dept', 'uses' => 'CallController@postDept']);

        // Department
        Route::resource('departments', 'DepartmentController', ['except' => ['show']]);

        // Counter
        Route::resource('counters', 'CounterController', ['except' => ['show']]);

        //Reports
        Route::group(['prefix' => 'reports', 'as' => 'reports::'], function() {
            // User Report
            Route::get('user', ['as' => 'user', 'uses' => 'UserReportController@index']);
            Route::get('user/{user}/{date}', ['as' => 'user_show', 'uses' => 'UserReportController@show']);

            // Queue list
            Route::get('queuelist/{date}', ['as' => 'queue_list', 'uses' => 'QueueListReportController@index']);

            // Monthly Report
            Route::get('monthly', ['as' => 'monthly', 'uses' => 'MonthlyReportController@index']);
            Route::get('monthly/{department}/{sdate}/{edate}', ['as' => 'monthly_show', 'uses' => 'MonthlyReportController@show']);

            // Statistical Report
            Route::get('statistical', ['as' => 'statistical', 'uses' => 'StatisticalReportController@index']);
            Route::get('statistical/{date}/{user}/{department}/{counter}', ['as' => 'statistical_show', 'uses' => 'StatisticalReportController@show']);

            // Missed
            Route::get('missed-overtime', ['as' => 'missed', 'uses' => 'MissedOvertimeReportController@index']);
            Route::get('missed-overtime/{date}/{user}/{counter}/{type}', ['as' => 'missed_show', 'uses' => 'MissedOvertimeReportController@show']);
        });

        // Users
        Route::get('users/{user}/password', ['as' => 'get_user_password', 'uses' => 'UserController@getPassword']);
        Route::post('users/{user}/password', ['as' => 'post_user_password', 'uses' => 'UserController@postPassword']);
        Route::resource('users', 'UserController', ['except' => ['show', 'edit', 'update']]);

        // Settings
        Route::get('settings', ['as' => 'settings', 'uses' => 'SettingsController@index']);
        Route::post('settings', ['as' => 'post_settings', 'uses' => 'SettingsController@update']);
        Route::post('settings/company', ['as' => 'post_company', 'uses' => 'SettingsController@companyUpdate']);
        Route::post('settings/overmissed', ['as' => 'post_over_missed', 'uses' => 'SettingsController@overmissedUpdate']);
        Route::post('settings/locale', ['as' => 'post_locale', 'uses' => 'SettingsController@localeUpdate']);
    });
});

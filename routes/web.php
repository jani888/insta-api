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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    Route::get('/review', 'ReviewController@index')->name('review');

    Route::get('/review/{post}/reject', 'ReviewController@reject');

    Route::post('/schedule', 'ScheduleController@enqueue');

    Route::post('/account_selector', 'AccountSelectorController@set')->name('account_selector.select');

    Route::resource('user', 'UserController', ['except' => ['show']]);

    Route::get('/settings', 'SettingController@index');

	Route::resource('accounts', 'InstagramAcountController', ['name' => 'accounts.create', 'except' => ['show']]);

	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

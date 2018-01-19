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

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('/dashboard', 'DashboardController@index');

/**
 * Account
 */
Route::group(['prefix' => 'account', 'middleware' => ['auth'], 'as' => 'account.'], function(){
	Route::get('/', 'Account\AccountController@index')->name('index');

	/**
	 * Profile
	 */
	Route::get('/profile', 'Account\ProfileController@index')->name('profile.index');
	Route::post('/profile', 'Account\ProfileController@store')->name('profile.store');

});

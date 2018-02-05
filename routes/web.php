<?php

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');


Route::group(['middleware' => ['auth', 'subscription.active']], function () {
	Route::get('/dashboard', 'DashboardController@index');
});


/**
 * Account
 */
Route::group(['prefix' => 'account', 'middleware' => ['auth'], 'as' => 'account.', 'namespace' => 'Account'], function () {
	Route::get('/', 'AccountController@index')->name('index');

	/**
	 * Profile
	 */
	Route::get('/profile', 'ProfileController@index')->name('profile.index');
	Route::post('/profile', 'ProfileController@store')->name('profile.store');


	/**
	 * Password
	 */
	Route::get('/password', 'PasswordController@index')->name('password.index');
	Route::post('/password', 'PasswordController@store')->name('password.store');

	/**
	 * Subscription (Account)
	 */
	Route::group(['prefix' => 'subscription', 'namespace' => 'Subscription', 'as' => 'subscription.'], function () {
		/**
		 * Cancel
		 */
		Route::group(['as' => 'cancel.', 'middleware' => ['subscription.notcancelled']], function () {
			Route::get('/cancel', 'CancelController@index')->name('index');
			Route::post('/cancel', 'CancelController@store')->name('store');
		});

		/**
		 * Card
		 */
		Route::group(['as' => 'card.', 'middleware' => ['subscription.notcancelled']], function () {
			Route::get('/card', 'CardController@index')->name('index');
		});

		/**
		 * Change
		 */
		Route::group(['as' => 'change.', 'middleware' => ['subscription.notcancelled']], function () {
			Route::get('/change', 'ChangeController@index')->name('index');
		});

		/**
		 * Resume
		 */
		Route::group(['as' => 'resume.', 'middleware' => ['subscription.cancelled']], function () {
			Route::get('/resume', 'ResumeController@index')->name('index');
			Route::post('/resume', 'ResumeController@store')->name('store');
		});
	});
});

/**
 * Account activation
 */
Route::group(['prefix' => 'activation', 'as' => 'activation.', 'middleware' => ['guest']], function () {
	Route::get('/resend', 'Auth\ActivationResendController@index')->name('resend');
	Route::post('/resend', 'Auth\ActivationResendController@store')->name('resend.store');

	Route::get('/{confirmation_token}', 'Auth\ActivationController@activate')->name('activate');
});

/**
 * Subscription Plans
 */
Route::group(['prefix' => 'plans', 'as' => 'plans.', 'middleware' => ['subscription.inactive']], function () {
	Route::get('/', 'Subscription\PlanController@index')->name('index');
	Route::get('/teams', 'Subscription\PlanTeamController@index')->name('teams.index');
});

/**
 * Subscription
 */
Route::group(['prefix' => 'subscription', 'as' => 'subscription.', 'middleware' =>['auth.register', 'subscription.inactive']], function () {
	Route::get('/', 'Subscription\SubscriptionController@index')->name('index');
	Route::post('/', 'Subscription\SubscriptionController@store')->name('store');
});



<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');

Route::get('/test/geometry', function() {

	$geo = Vinfo\Geometry::orderBy('id', 'desc')->first();

	dd($geo->geometry);

});

Route::group(['namespace' => 'Auth', 'prefix' => 'auth', 'middleware' => 'guest'], function() {

	// Authentication routes...
	Route::get('login', 'AuthController@getLogin');
	Route::post('login', 'AuthController@postLogin');

	// Registration routes...
	Route::get('register', 'AuthController@getRegister');
	Route::post('register', 'AuthController@postRegister');

});

Route::group(['middleware' => 'auth'], function() {

	Route::get('/home', function () {
		return redirect('/');
	});

	Route::group(['prefix' => 'auth'], function() {

		Route::get('account', 'UsersController@getAccount');
		Route::post('account', 'UsersController@postAccount');
		Route::get('account/language/{language}', 'UsersController@setLanguage');

		Route::group(['namespace' => 'Auth'], function() {
			Route::get('logout', 'AuthController@getLogout');
		});
	});

	Route::group(['prefix' => 'admin'], function() {
		Route::resource('bottle_sizes', 'BottleSizesController');
		Route::resource('consumed_reasons', 'ConsumedReasonsController');
		Route::resource('countries', 'CountriesController');
		Route::resource('currencies', 'CurrenciesController');
		Route::resource('languages', 'LanguagesController');
		Route::resource('region_types', 'RegionTypesController');
		Route::resource('users', 'UsersController');
	});

	Route::group(['prefix' => 'api'], function() {
		Route::get('language/{language}/name', 'ApiController@languageNameByLanguageCode');
		Route::get('country/{language}/settings', 'ApiController@languageAndCurrencyByCountry');
	});

});
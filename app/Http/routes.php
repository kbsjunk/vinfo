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

	// $wkt = 'POINT (30 10)';
	// $wkt = 'LINESTRING (30 10, 10 30, 40 40)';
	// $wkt = 'POLYGON ((30 10, 40 40, 20 40, 10 20, 30 10))';
	// $wkt = 'POLYGON ((35 10, 45 45, 15 40, 10 20, 35 10), (20 30, 35 35, 30 20, 20 30))';
	// $wkt = 'MULTIPOINT ((10 40), (40 30), (20 20), (30 10))';
	// $wkt = 'MULTILINESTRING ((10 10, 20 20, 10 40),(40 40, 30 30, 40 20, 30 10))';
	// $wkt = 'MULTIPOLYGON (((30 20, 45 40, 10 40, 30 20)),((15 5, 40 10, 10 20, 5 10, 15 5)))';
	// $wkt = 'MULTIPOLYGON (((40 40, 20 45, 45 30, 40 40)),((20 35, 10 30, 10 10, 30 5, 45 20, 20 35),(30 20, 20 15, 20 25, 30 20)))';
	// $wkt = 'GEOMETRYCOLLECTION(POINT(4 6),LINESTRING(4 6,7 10))';
	// $wkt = 'POINT ZM (1 1 5 60)';

	// echo $wkt;

	// $factory = new Kitbs\Geoimport\Generator();
	// $parser = new GeoIO\WKT\Parser\Parser($factory);

	// $geo = $parser->parse($wkt);

	// $extractor = new Kitbs\Geoimport\Extractor();
	// $generator = new GeoIO\WKT\Generator\Generator($extractor);

	// echo '<br>';

	// echo $generator->generate($geo);

	// dd($geo);


	// dd();

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
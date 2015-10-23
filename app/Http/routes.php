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

Route::get('/test/locales', function() {
		
	function getName($key, $locale)
	{
		switch (@$_GET['type'] ?: 'country') {
			case 'language':
			return Punic\Language::getName($key, $locale);
			case 'currency':
			return Punic\Currency::getName($key, null, $locale);
			default:
			return Punic\Territory::getName($key, $locale);
		}
	}

	switch (@$_GET['type'] ?: 'country') {
		case 'language':
		$list = array_keys(Punic\Language::getAll()); sort($list);
		break;
		case 'currency':
		$list = Vinfo\Currency::lists('code')->toArray();
		break;
		default:
		$list = Vinfo\Country::whereActive()->lists('code')->toArray();
		break;
	}

	$locales = [
		'en' => ['GB', 'US'],
/* 		['nl', 'af'], */
		'fr' => ['CA', 'FR'],
		'pt' => ['PT', 'BR'],
		'zh' => ['Hans', 'Hant'],
		'de' => ['DE', 'CH', 'AT'],
		'es' => ['ES', '419'],
	];
	
	echo '<style>
	body,td,th {
		font-size: 10pt;
		font-family: sans-serif;
	}
	</style>';

	echo '<table border=1>';
	echo '<thead>';
	echo '<tr>';
	echo '<th>code</th>';
	foreach ($locales as $locale => $countries) {
		if (!is_numeric($locale)) {
			echo '<th>'.$locale.'</th>';
		}
		foreach ($countries as $country) {
			echo '<th>'.$country.'</th>';
		}
	}
	echo '</tr>';
	echo '</thead>';
	echo '<tbody>';
	foreach ($list as $code) {
		echo '<tr>';
		echo '<td>'.$code.'</td>';
		foreach ($locales as $locale => $countries) {
			if (!is_numeric($locale)) {
				$baseName = getName($code, $locale);
				echo '<td><strong>'.$baseName.'</strong></td>';
				foreach ($countries as $country) {
					if (($localeName = getName($code, $locale.'-'.$country)) != $baseName) {
						echo '<td style="background:lightgreen;">'.$localeName.'</td>';
					}
					else {
						echo '<td></td>';
					}
				}
			}
			else {
				$baseName = getName($code, head($countries));
				echo '<td><strong>'.$baseName.'</strong></td>';
				array_shift($countries);
				foreach ($countries as $country) {
					if (($localeName = getName($code, $country)) != $baseName) {
						echo '<td style="background:lightgreen;">'.$localeName.'</td>';
					}
					else {
						echo '<td></td>';
					}
				}
			}
		}
		echo '<tr>';
	}
	echo '</tbody>';
	echo '</table>';

});

Route::get('/test/geometry', function() {

	// $wkt = 'POINT (30 10)';
	// $wkt = 'LINESTRING (30 10, 10 30, 40 40)';
	// $wkt = 'POLYGON ((30 10, 40 40, 20 40, 10 20, 30 10))';
	// $wkt = 'POLYGON ((35 10, 45 45, 15 40, 10 20, 35 10), (20 30, 35 35, 30 20, 20 30))';
	// $wkt = 'MULTIPOINT ((10 40), (40 30), (20 20), (30 10))';
	// $wkt = 'MULTILINESTRING ((10 10, 20 20, 10 40),(40 40, 30 30, 40 20, 30 10))';
	// $wkt = 'MULTIPOLYGON (((30 20, 45 40, 10 40, 30 20)),((15 5, 40 10, 10 20, 5 10, 15 5)))';
	// $wkt = 'MULTIPOLYGON (((40 40, 20 45, 45 30, 40 40)),((20 35, 10 30, 10 10, 30 5, 45 20, 20 35),(30 20, 20 15, 20 25, 30 20)))';
	/* 	$wkt = 'GEOMETRYCOLLECTION(POINT(4 6),LINESTRING(4 6,7 10))'; */
	// $wkt = 'POINT ZM (1 1 5 60)';

	// echo $wkt;

	/* 	$factory = new Kitbs\Geoimport\Generator();
		$parser = new GeoIO\WKT\Parser\Parser($factory); */

	// $geo = $parser->parse($wkt);

	// $extractor = new Kitbs\Geoimport\Extractor();
	// $generator = new GeoIO\WKT\Generator\Generator($extractor);

	// echo '<br>';

	// echo $generator->generate($geo);

	// dd($geo);


	// dd();

	/* 	$geo = new Vinfo\Geometry;//orderBy('id', 'desc')->first(); */

	/* 	$wkt = '{
	  "type": "FeatureCollection",
	  "features": [
		{
		  "type": "Feature",
		  "properties": {},
		  "geometry": {
			"type": "Point",
			"coordinates": [
			  122.16796875,
			  -29.152161283318915
			]
		  }
		}
	  ]
	}';	 */
	$wkt = '{ "type": "Feature", "properties": { "name": "Western Plains", "description": null, "timestamp": null, "begin": null, "end": null, "altitudeMode": null, "tessellate": -1, "extrude": -1, "visibility": -1, "drawOrder": null, "icon": null, "folders": "Wine Regions of Australia\/\/New South Wales\/\/" }, "geometry": { "type": "Point", "coordinates": [ 148.637671479877298, -32.264375774937847, 0.0 ] } }';

	$wkt = json_decode($wkt);
	$feature = GeoJson\GeoJson::jsonUnserialize($wkt);

	/* 	dd($wkt); */

	/* 	dd($feature); */

	/* 	$geo->geometry = $wkt; //$parser->parse($wkt); */
	//dd($geo);

	Vinfo\Geometry::createFromFeature($feature);

	/* 	$geo->save(); */


	// dd(json_encode($geo->toFeatureCollection()->jsonSerialize()));

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
		Route::resource('regions', 'RegionsController');
		Route::resource('users', 'UsersController');
	});

	Route::group(['prefix' => 'api'], function() {
		Route::get('language/{language}/name', 'ApiController@languageNameByLanguageCode');
		Route::get('country/{language}/settings', 'ApiController@languageAndCurrencyByCountry');
	});

});
<?php

use Vinfo\Region;

class RegionsATTableSeeder extends RegionsTableSeeder
{
	/**
     * Run the database seeds.
     *
     * @return void
     */
	public function run()
	{

		$country = Region::whereTranslation('name', 'Austria', 'en')->first();
		DB::table('regions')->where('country_id', $country->country_id)->where('id', '!=', $country->id)->delete();

		$regions = [];
		$depths  = [7, 2, 10, 15];

		$regions["de:Weinland Österreich"]
			["de:Niederösterreich|en:Lower Austria|es:Baja Austria|fr:Basse-Autriche|zh:下奥地利"]
			["de:Wachau"]                                                                                      = [];
		$regions["de:Weinland Österreich"]
			["de:Niederösterreich|en:Lower Austria|es:Baja Austria|fr:Basse-Autriche|zh:下奥地利"]
			["de:Kremstal"]
			["de:Kremstal DAC"]                                                                                = [];
		$regions["de:Weinland Österreich"]
			["de:Niederösterreich|en:Lower Austria|es:Baja Austria|fr:Basse-Autriche|zh:下奥地利"]
			["de:Kamptal"]
			["de:Kamptal DAC"]                                                                                 = [];
		$regions["de:Weinland Österreich"]
			["de:Niederösterreich|en:Lower Austria|es:Baja Austria|fr:Basse-Autriche|zh:下奥地利"]
			["de:Traisental"]
			["de:Traisental DAC"]                                                                              = [];
		$regions["de:Weinland Österreich"]
			["de:Niederösterreich|en:Lower Austria|es:Baja Austria|fr:Basse-Autriche|zh:下奥地利"]
			["de:Wagram"]                                                                                      = [];
		$regions["de:Weinland Österreich"]
			["de:Niederösterreich|en:Lower Austria|es:Baja Austria|fr:Basse-Autriche|zh:下奥地利"]
			["de:Donauland"]                                                                                   = "_SHORTCUT_Wagram";
		$regions["de:Weinland Österreich"]
			["de:Niederösterreich|en:Lower Austria|es:Baja Austria|fr:Basse-Autriche|zh:下奥地利"]
			["de:Weinviertel"]
			["de:Weinviertel DAC"]                                                                             = [];
		$regions["de:Weinland Österreich"]
			["de:Niederösterreich|en:Lower Austria|es:Baja Austria|fr:Basse-Autriche|zh:下奥地利"]
			["de:Carnuntum"]                                                                                   = [];
		$regions["de:Weinland Österreich"]
			["de:Niederösterreich|en:Lower Austria|es:Baja Austria|fr:Basse-Autriche|zh:下奥地利"]
			["de:Thermenregion"]                                                                               = [];
		$regions["de:Weinland Österreich"]
			["de:Burgenland|zh:布尔根兰"]
			["de:Neusiedlersee"]
			["de:Leithaberg DAC"]                                                                              = [];
		$regions["de:Weinland Österreich"]
			["de:Burgenland"]
			["de:Neusiedlersee–Hügelland"]
			["de:Leithaberg DAC"]                                                                              = "_SHORTCUT";
		$regions["de:Weinland Österreich"]
			["de:Burgenland"]
			["de:Mittelburgenland"]
			["de:Mittelburgenland DAC"]                                                                        = [];
		$regions["de:Weinland Österreich"]
			["de:Burgenland"]
			["de:Südburgenland"]
			["de:Eisenberg DAC"]                                                                               = [];
		$regions["de:Steirerland|en:Styria|zh:施蒂利亚|fr:Styrie|es:Estiria"]
			["de:Steiermark|en:Styria|zh:施蒂利亚|fr:Styrie|es:Estiria"]
			["de:Süd-Oststeiermark|en:Southeast Styria|zh:东南施蒂利亚|fr:Styrie du Sud-Est|es:Estiria del Sudeste"] = [];
		$regions["de:Steirerland|en:Styria|zh:施蒂利亚|fr:Styrie|es:Estiria"]
			["de:Steiermark|en:Styria|zh:施蒂利亚|fr:Styrie|es:Estiria"]
			["de:Südsteiermark|en:South Styria|zh:南施蒂利亚|fr:Styrie du Sud|es:Estiria del Sur"]              = [];
		$regions["de:Steirerland|en:Styria|zh:施蒂利亚|fr:Styrie|es:Estiria"]
			["de:Steiermark|en:Styria|zh:施蒂利亚|fr:Styrie|es:Estiria"]
			["de:Weststeiermark|en:West Styria|zh:西施蒂利亚|fr:Styrie de l'Ouest|es:Estiria del Oeste"]        = [];
		$regions["de:Wien|en:Vienna|zh:维也纳|fr:Vienne|es:Viena"]
			["de:Wien|en:Vienna|zh:维也纳|fr:Vienne|es:Viena"]
			["de:Wien|en:Vienna|zh:维也纳|fr:Vienne|es:Viena"]
			["de:Wiener Gemischter Satz DAC"]                                                = [];
		$regions["de:Bergland Österreich"]
			["de:Oberösterreich|en:Upper Austria|es:Alta Austria|fr:Haute-Autriche|zh:上奥地利"] = [];
		$regions["de:Bergland Österreich"]
			["de:Kärnten|en:Carinthia|es:Carintia|fr:Carinthie|zh:克恩滕"]                      = [];
		$regions["de:Bergland Österreich"]
			["de:Salzburg|fr:Salzbourg|es:Salzburgo|zh:萨尔茨堡"]                                = [];
		$regions["de:Bergland Österreich"]
			["de:Tirol|en:Tyrol|fr:Tyrol|zh:蒂罗尔"]                                            = [];
		$regions["de:Bergland Österreich"]
			["de:Vorarlberg|zh:福拉尔贝格"]                                                       = [];

		foreach ($regions as $region => $children) {
			$this->makeChild($country, $region, $children, $depths, $country->country_id);
		}

		// $deNames = [
		// 'Australian Capital Territory' => 'Australisches Hauptstadtterritorium',
		// ];

		// foreach ($deNames as $en => $de) {
		// 	$region = Region::whereTranslation('name', $en, 'en')->first();
		// 	$region->fill(['de' => ['name' => $de]])->save();
		// }

	}

}

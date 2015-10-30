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

        $regions["de:Weinland Österreich"]["de:Niederösterreich|en:Lower Austria"]["de:Wachau"]                            = [];
        $regions["de:Weinland Österreich"]["de:Niederösterreich|en:Lower Austria"]["de:Kremstal"]["de:Kremstal DAC"]       = [];
        $regions["de:Weinland Österreich"]["de:Niederösterreich|en:Lower Austria"]["de:Kamptal"]["de:Kamptal DAC"]         = [];
        $regions["de:Weinland Österreich"]["de:Niederösterreich|en:Lower Austria"]["de:Traisental"]["de:Traisental DAC"]   = [];
        $regions["de:Weinland Österreich"]["de:Niederösterreich|en:Lower Austria"]["de:Wagram"]                            = [];
        $regions["de:Weinland Österreich"]["de:Niederösterreich|en:Lower Austria"]["de:Donauland"]                         = "_SHORTCUT_Wagram";
        $regions["de:Weinland Österreich"]["de:Niederösterreich|en:Lower Austria"]["de:Weinviertel"]["de:Weinviertel DAC"] = [];
        $regions["de:Weinland Österreich"]["de:Niederösterreich|en:Lower Austria"]["de:Carnuntum"]                         = [];
        $regions["de:Weinland Österreich"]["de:Niederösterreich|en:Lower Austria"]["de:Thermenregion"]                     = [];
        $regions["de:Weinland Österreich"]["de:Burgenland"]["de:Neusiedlersee"]["de:Leithaberg DAC"]                       = [];
        $regions["de:Weinland Österreich"]["de:Burgenland"]["de:Neusiedlersee–Hügelland"]["de:Leithaberg DAC"]             = "_SHORTCUT";
        $regions["de:Weinland Österreich"]["de:Burgenland"]["de:Mittelburgenland"]["de:Mittelburgenland DAC"]              = [];
        $regions["de:Weinland Österreich"]["de:Burgenland"]["de:Südburgenland"]["de:Eisenberg DAC"]                        = [];
        $regions["de:Steirerland|en:Styria"]["de:Steiermark|en:Styria"]["de:Süd-Oststeiermark|en:Southeast Styria"]        = [];
        $regions["de:Steirerland|en:Styria"]["de:Steiermark|en:Styria"]["de:Südsteiermark|en:South Styria"]                = [];
        $regions["de:Steirerland|en:Styria"]["de:Steiermark|en:Styria"]["de:Weststeiermark|en:West Styria"]                = [];
        $regions["de:Wien|en:Vienna"]["de:Wien|en:Vienna"]["de:Wien|en:Vienna"]["de:Wiener Gemischter Satz DAC"]           = [];
        $regions["de:Bergland Österreich"]["de:Oberösterreich|en:Upper Austria"]                                           = [];
        $regions["de:Bergland Österreich"]["de:Kärnten|en:Carinthia"]                                                      = [];
        $regions["de:Bergland Österreich"]["de:Salzburg"]                                                                  = [];
        $regions["de:Bergland Österreich"]["de:Tirol|en:Tyrol"]                                                            = [];
        $regions["de:Bergland Österreich"]["de:Vorarlberg"]                                                                = [];

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

<?php

use Vinfo\Region;

class RegionsCATableSeeder extends RegionsTableSeeder
{
	/**
     * Run the database seeds.
     *
     * @return void
     */
	public function run()
	{

		$country = Region::whereTranslation('name', 'Canada', 'en')->first();
		DB::table('regions')->where('country_id', $country->country_id)->where('id', '!=', $country->id)->delete();

		$regions = [];
		$depths  = [3, 12, 14, 14, 14];

		$regions["Alberta"]                                                                                                                                                     = [];
		$regions["en:British Columbia|fr:Colombie-Brittanique"]                                                                                                                 = [];
		$regions["en:British Columbia|fr:Colombie-Brittanique"]["en:Okanagan Valley|fr:Vallée de l'Okanagan"]                                                                   = [];
		$regions["en:British Columbia|fr:Colombie-Brittanique"]["en:Okanagan Valley|fr:Vallée de l'Okanagan"]["Golden Mile Bench"]                                              = [];
		$regions["en:British Columbia|fr:Colombie-Brittanique"]["en:Similkameen Valley|fr:Vallée de la Similkameen"]                                                            = [];
		$regions["en:British Columbia|fr:Colombie-Brittanique"]["en:Fraser Valley|fr:Valée du Fraser"]                                                                          = [];
		$regions["en:British Columbia|fr:Colombie-Brittanique"]["en:Vancouver Island|fr:Île de Vancouver"]                                                                      = [];
		$regions["en:British Columbia|fr:Colombie-Brittanique"]["en:Gulf Islands|fr:Îles du golfe"]                                                                             = [];
		$regions["Manitoba"]                                                                                                                                                    = [];
		$regions["en:New Brunswick|fr:Nouveau-Brunswick"]                                                                                                                       = [];
		$regions["en:Newfoundland and Labrador|fr:Terre-Neuve-et-Labrador"]                                                                                                     = [];
		$regions["en:Nova Scotia|fr:Nouvelle-Écosse"]                                                                                                                           = [];
		$regions["Ontario"]                                                                                                                                                     = [];
		$regions["Ontario"]["en:Lake Erie North Shore|fr:Rive nord du lac Érié"]                                                                                                = [];
		$regions["Ontario"]["en:Prince Edward County|fr:Comté du Prince-Édouard"]                                                                                               = [];
        $regions["Ontario"]["en:Niagara Peninsula|fr:Péninsule du Niagara"]                                                                                                     = [];
        $regions["Ontario"]["en:Niagara Peninsula|fr:Péninsule du Niagara"]["en:Niagara Escarpment|fr:Escarpement du Niagara"]                                                  = [];
        $regions["Ontario"]["en:Niagara Peninsula|fr:Péninsule du Niagara"]["en:Niagara Escarpment|fr:Escarpement du Niagara"]["Short Hills Bench"]                             = [];
        $regions["Ontario"]["en:Niagara Peninsula|fr:Péninsule du Niagara"]["en:Niagara Escarpment|fr:Escarpement du Niagara"]["Twenty Mile Bench"]                             = [];
        $regions["Ontario"]["en:Niagara Peninsula|fr:Péninsule du Niagara"]["en:Niagara Escarpment|fr:Escarpement du Niagara"]["Beamsville Bench"]                              = [];
        $regions["Ontario"]["en:Niagara Peninsula|fr:Péninsule du Niagara"]["en:Niagara-on-the-Lake|fr:Niagara-sur-le-Lac"]                                                     = [];
        $regions["Ontario"]["en:Niagara Peninsula|fr:Péninsule du Niagara"]["en:Niagara-on-the-Lake|fr:Niagara-sur-le-Lac"]["en:Niagara River|fr:Rivière Niagara"]              = [];
        $regions["Ontario"]["en:Niagara Peninsula|fr:Péninsule du Niagara"]["en:Niagara-on-the-Lake|fr:Niagara-sur-le-Lac"]["Niagara Lakeshore"]                                = [];
        $regions["Ontario"]["en:Niagara Peninsula|fr:Péninsule du Niagara"]["en:Niagara-on-the-Lake|fr:Niagara-sur-le-Lac"]["en:Four Mile Creek|fr:Ruisseau des Quatre Milles"] = [];
        $regions["Ontario"]["en:Niagara Peninsula|fr:Péninsule du Niagara"]["en:Niagara-on-the-Lake|fr:Niagara-sur-le-Lac"]["St. David’s Bench"]                                = [];
        $regions["Ontario"]["en:Niagara Peninsula|fr:Péninsule du Niagara"]["en:Niagara-on-the-Lake|fr:Niagara-sur-le-Lac"]["Vinemount Ridge"]                                  = [];
        $regions["Ontario"]["en:Niagara Peninsula|fr:Péninsule du Niagara"]["en:Niagara-on-the-Lake|fr:Niagara-sur-le-Lac"]["Creek Shores"]                                     = [];
        $regions["Ontario"]["en:Niagara Peninsula|fr:Péninsule du Niagara"]["en:Niagara-on-the-Lake|fr:Niagara-sur-le-Lac"]["Lincoln Lakeshore"]                                = [];
        $regions["en:Prince Edward Island|fr:Île-du-Prince-Édouard"]                                                                                                            = [];
		$regions["en:Quebec|fr:Québec"]                                                                                                                                         = [];
		$regions["Saskatchewan"]                                                                                                                                                = [];

		foreach ($regions as $region => $children) {
			$this->makeChild($country, $region, $children, $depths, $country->country_id);
		}

		$regions = [];
		$depths  = [4];
		
		$regions["Nunavut"]                                                      = [];
		$regions["en:Northwest Territories|fr:Territoires du Nord-Ouest"]        = [];
		$regions["Yukon"]                                                        = [];

		foreach ($regions as $region => $children) {
			$this->makeChild($country, $region, $children, $depths, $country->country_id);
		}

		$existing = Region::whereTranslationIn('name', ['Niagara Escarpment', 'Niagara-on-the-Lake'], 'en')->update(['region_type_id' => 13]);

	}

}

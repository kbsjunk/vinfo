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
    	$regions = [];
    	$depths  = [3, 12, 13, 14];

    	$regions["Alberta"]                                                                  = [];
    	$regions["British Columbia"]                                                         = [];
    	$regions["British Columbia"]["Okanagan Valley"]                                      = [];
    	$regions["British Columbia"]["Okanagan Valley"]["Golden Mile Bench"]                 = [];
    	$regions["British Columbia"]["Similkameen Valley"]                                   = [];
    	$regions["British Columbia"]["Fraser Valley"]                                        = [];
    	$regions["British Columbia"]["Vancouver Island"]                                     = [];
    	$regions["British Columbia"]["Gulf Islands"]                                         = [];
    	$regions["Manitoba"]                                                                 = [];
    	$regions["New Brunswick"]                                                            = [];
    	$regions["Newfoundland"]                                                             = [];
    	$regions["Nova Scotia"]                                                              = [];
    	$regions["Ontario"]                                                                  = [];
    	$regions["Ontario"]["Lake Erie North Shore"]                                         = [];
    	$regions["Ontario"]["Prince Edward County"]                                          = [];
    	$regions["Ontario"]["Niagara Peninsula"]                                             = [];
    	$regions["Ontario"]["Niagara Peninsula"]["Niagara Escarpment"]                       = [];
    	$regions["Ontario"]["Niagara Peninsula"]["Niagara Escarpment"]["Short Hills Bench"]  = [];
    	$regions["Ontario"]["Niagara Peninsula"]["Niagara Escarpment"]["Twenty Mile Bench"]  = [];
    	$regions["Ontario"]["Niagara Peninsula"]["Niagara Escarpment"]["Beamsville Bench"]   = [];
    	$regions["Ontario"]["Niagara Peninsula"]["Niagara-on-the-Lake"]                      = [];
    	$regions["Ontario"]["Niagara Peninsula"]["Niagara-on-the-Lake"]["Niagara River"]     = [];
    	$regions["Ontario"]["Niagara Peninsula"]["Niagara-on-the-Lake"]["Niagara Lakeshore"] = [];
    	$regions["Ontario"]["Niagara Peninsula"]["Niagara-on-the-Lake"]["Four Mile Creek"]   = [];
    	$regions["Ontario"]["Niagara Peninsula"]["Niagara-on-the-Lake"]["St. David’s Bench"] = [];
    	$regions["Ontario"]["Niagara Peninsula"]["Niagara-on-the-Lake"]["Vinemount Ridge"]   = [];
    	$regions["Ontario"]["Niagara Peninsula"]["Niagara-on-the-Lake"]["Creek Shores"]      = [];
    	$regions["Ontario"]["Niagara Peninsula"]["Niagara-on-the-Lake"]["Lincoln Lakeshore"] = [];
    	$regions["Prince Edward Island"]                                                     = [];
    	$regions["Quebec"]                                                                   = [];
    	$regions["Saskatchewan"]                                                             = [];

    	foreach ($regions as $region => $children) {
    		$this->makeChild($country, $region, $children, $depths, $country->country_id);
    	}

    	$existing = Region::whereTranslation('name', 'Golden Mile Bench', 'en')->update(['region_type_id' => 14]);

    }

}

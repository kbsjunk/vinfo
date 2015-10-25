<?php

use Illuminate\Database\Seeder;

use Vinfo\Country;
use Vinfo\Region;
use Vinfo\RegionTranslation;

class RegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('regions')->delete();

        $countries = Country::whereIsWine()->whereIsActive()->get();

        foreach ($countries as $country) {
        	$country = Region::create(['name' => $country->name, 'region_type_id' => 1, 'country_id' => $country->id]);
        	$country->makeRoot();
        }

        // --------------------------------------------------------------------

		$country = Region::whereTranslation('name', 'Australia', 'en')->first();
		$regions = [];
		$depths  = [2, 6, 7, 8];

		$regions['South Australia']                                                                = [];
		$regions['South Australia']['Barossa']['Barossa Valley']                                   = [];
		$regions['South Australia']['Barossa']['Eden Valley']['High Eden']                         = [];
		$regions['South Australia']['Far North']['Southern Flinders Ranges']                       = [];
		$regions['South Australia']['Fleurieu']['Currency Creek']                                  = [];
		$regions['South Australia']['Fleurieu']['Kangaroo Island']                                 = [];
		$regions['South Australia']['Fleurieu']['Langhorne Creek']                                 = [];
		$regions['South Australia']['Fleurieu']['McLaren Vale']                                    = [];
		$regions['South Australia']['Fleurieu']['Southern Fleurieu']                               = [];
		$regions['South Australia']['Limestone Coast']['Coonawarra']                               = [];
		$regions['South Australia']['Limestone Coast']['Mount Benson']                             = [];
		$regions['South Australia']['Limestone Coast']['Mount Gambier']                            = [];
		$regions['South Australia']['Limestone Coast']['Padthaway']                                = [];
		$regions['South Australia']['Limestone Coast']['Robe']                                     = [];
		$regions['South Australia']['Limestone Coast']['Wrattonbully']                             = [];
		$regions['South Australia']['Lower Murray']['Riverland']                                   = [];
		$regions['South Australia']['Mount Lofty Ranges']['Adelaide Hills']['Lenswood']            = [];
		$regions['South Australia']['Mount Lofty Ranges']['Adelaide Hills']['Piccadilly Valley']   = [];
		$regions['South Australia']['Mount Lofty Ranges']['Adelaide Plains']                       = [];
		$regions['South Australia']['Mount Lofty Ranges']['Clare Valley']                          = [];
		$regions['South Australia']['The Peninsulas']                                              = [];
		$regions['New South Wales']                                                                = [];
		$regions['New South Wales']['Big Rivers']['Murray Darling']                                = [];
		$regions['New South Wales']['Big Rivers']['Perricoota']                                    = [];
		$regions['New South Wales']['Big Rivers']['Riverina']                                      = [];
		$regions['New South Wales']['Big Rivers']['Swan Hill']                                     = [];
		$regions['New South Wales']['Central Ranges']['Cowra']                                     = [];
		$regions['New South Wales']['Central Ranges']['Mudgee']                                    = [];
		$regions['New South Wales']['Central Ranges']['Orange']                                    = [];
		$regions['New South Wales']['Hunter Valley']['Hunter']['Broke Fordwich']                   = [];
		$regions['New South Wales']['Hunter Valley']['Hunter']['Pokolbin']                         = [];
		$regions['New South Wales']['Hunter Valley']['Hunter']['Upper Hunter Valley']              = [];
		$regions['New South Wales']['Northern Rivers']['Hastings River']                           = [];
		$regions['New South Wales']['Northern Slopes']['New England Australia']                    = [];
		$regions['New South Wales']['South Coast']['Shoalhaven Coast']                             = [];
		$regions['New South Wales']['South Coast']['Southern Highlands']                           = [];
		$regions['New South Wales']['Southern New South Wales']['Canberra District']               = [];
		$regions['New South Wales']['Southern New South Wales']['Gundagai']                        = [];
		$regions['New South Wales']['Southern New South Wales']['Hilltops']                        = [];
		$regions['New South Wales']['Southern New South Wales']['Tumbarumba']                      = [];
		$regions['Western Australia']                                                              = [];
		$regions['Western Australia']['Central Western Australia']                                 = [];
		$regions['Western Australia']['Eastern Plains - Inland and North of Western Australia']    = [];
		$regions['Western Australia']['Greater Perth']['Peel']                                     = [];
		$regions['Western Australia']['Greater Perth']['Perth Hills']                              = [];
		$regions['Western Australia']['Greater Perth']['Swan District']['Swan Valley']             = [];
		$regions['Western Australia']['South West Australia']['Blackwood Valley']                  = [];
		$regions['Western Australia']['South West Australia']['Geographe']                         = [];
		$regions['Western Australia']['South West Australia']['Great Southern']['Albany']          = [];
		$regions['Western Australia']['South West Australia']['Great Southern']['Denmark']         = [];
		$regions['Western Australia']['South West Australia']['Great Southern']['Frankland River'] = [];
		$regions['Western Australia']['South West Australia']['Great Southern']['Mount Barker']    = [];
		$regions['Western Australia']['South West Australia']['Great Southern']['Porongurup']      = [];
		$regions['Western Australia']['South West Australia']['Manjimup']                          = [];
		$regions['Western Australia']['South West Australia']['Margaret River']                    = [];
		$regions['Western Australia']['South West Australia']['Pemberton']                         = [];
		$regions['Western Australia']['West Australian South East Coastal']                        = [];
		$regions['Queensland']                                                                     = [];
		$regions['Queensland']['Granite Belt']                                                     = [];
		$regions['Queensland']['South Burnett']                                                    = [];
		$regions['Victoria']                                                                       = [];
		$regions['Victoria']['Central Victoria']['Bendigo']                                        = [];
		$regions['Victoria']['Central Victoria']['Goulburn Valley']['Nagambie Lakes']              = [];
		$regions['Victoria']['Central Victoria']['Heathcote']                                      = [];
		$regions['Victoria']['Central Victoria']['Strathbogie Ranges']                             = [];
		$regions['Victoria']['Central Victoria']['Upper Goulburn']                                 = [];
		$regions['Victoria']['Gippsland']                                                          = [];
		$regions['Victoria']['North East Victoria']['Alpine Valleys']                              = [];
		$regions['Victoria']['North East Victoria']['Beechworth']                                  = [];
		$regions['Victoria']['North East Victoria']['Glenrowan']                                   = [];
		$regions['Victoria']['North East Victoria']['King Valley']                                 = [];
		$regions['Victoria']['North East Victoria']['Rutherglen']                                  = [];
		$regions['Victoria']['North West Victoria']['Murray Darling']                              = [];
		$regions['Victoria']['North West Victoria']['Swan Hill']                                   = [];
		$regions['Victoria']['Port Phillip']['Geelong']                                            = [];
		$regions['Victoria']['Port Phillip']['Macedon Ranges']                                     = [];
		$regions['Victoria']['Port Phillip']['Mornington Peninsula']                               = [];
		$regions['Victoria']['Port Phillip']['Sunbury']                                            = [];
		$regions['Victoria']['Port Phillip']['Yarra Valley']                                       = [];
		$regions['Victoria']['Western Victoria']['Grampians']['Great Western']                     = [];
		$regions['Victoria']['Western Victoria']['Henty']                                          = [];
		$regions['Victoria']['Western Victoria']['Pyrenees']                                       = [];
		$regions['Tasmania']                                                                       = [];
		$regions['Northern Territory']                                                             = [];
		$regions['Australian Capital Territory']                                                   = [];

		foreach ($regions as $region => $children) {
			$this->makeChild($country, $region, $children, $depths, $country->country_id);
		}

		$deNames = [
		'Australian Capital Territory' => 'Australisches Hauptstadtterritorium',
		'New South Wales'              => 'Neusüdwales',
		'Northern Territory'           => 'Nordterritorium',
		'South Australia'              => 'Südaustralien',
		'Tasmania'                     => 'Tasmanien',
		'Western Australia'            => 'Westaustralien',
		];

		foreach ($deNames as $en => $de) {
			$region = Region::whereTranslation('name', $en, 'en')->first();
			$region->fill(['de' => ['name' => $de]])->save();
		}
		
		// --------------------------------------------------------------------

		$existing = Region::whereTranslation('name', 'South Australia', 'en')->first();

		$new = Region::create(['name' => 'Adelaide', 'region_type_id' => 5, 'country_id' => $country->country_id]);
		$new->makeFirstChildOf($existing);

		$subzones = Region::whereTranslationIn('name', ['Mount Lofty Ranges', 'Fleurieu', 'Barossa'], 'en')->get();

		foreach ($subzones as $subzone) {
			$subzone = Region::create(['name' => $subzone->name, 'region_type_id' => 6, 'shortcut_id' => $subzone->id, 'country_id' => $country->country_id]);
			$subzone->makeLastChildOf($new);
		}
		
		// --------------------------------------------------------------------

		$new = Region::create(['name' => 'South Eastern Australia', 'region_type_id' => 5, 'country_id' => $country->country_id]);
		$new->makeLastChildOf($country);
		
		$subzones = Region::whereTranslationIn('name', ['New South Wales', 'South Australia', 'Queensland', 'Victoria'], 'en')->get();

		foreach ($subzones as $subzone) {
			$subzone = Region::create(['name' => $subzone->name, 'region_type_id' => 2, 'shortcut_id' => $subzone->id, 'country_id' => $country->country_id]);
			$subzone->makeLastChildOf($new);
		}

		// --------------------------------------------------------------------
		
		$existing = Region::whereTranslation('name', 'Murray Darling', 'en')->first();

		$first = $existing->first();
		$last = $existing->orderBy('id', 'desc')->first();

		$last->shortcut_id = $first->id;
		$last->save();

		// --------------------------------------------------------------------
		
		$existing = Region::whereTranslation('name', 'Swan Hill', 'en')->first();

		$first = $existing->first();
		$last = $existing->orderBy('id', 'desc')->first();

		$last->shortcut_id = $first->id;
		$last->save();

		// --------------------------------------------------------------------

		$country = Region::whereTranslation('name', 'New Zealand', 'en')->first();
		$regions = [];
		$depths = [7, 8];

		$regions["Northland"]                       = [];	
		$regions["Auckland"]                        = [];	
		$regions["Auckland"]["Waiheke Island"]      = [];
		$regions["Auckland"]["Henderson"]           = [];
		$regions["Auckland"]["Clevedon"]            = [];
		$regions["Auckland"]["Matakana"]            = [];
		$regions["Auckland"]["Kumeu"]               = [];
		$regions["Waikato"]                         = [];	
		$regions["Bay of Plenty"]                   = [];	
		$regions["Gisborne"]                        = [];	
		$regions["Hawke's Bay"]                     = [];	
		$regions["Hawke's Bay"]["Gimblett Gravels"] = [];
		$regions["Wairarapa"]                       = [];	
		$regions["Wairarapa"]["Carterton"]          = [];
		$regions["Wairarapa"]["Masterton"]          = [];
		$regions["Wairarapa"]["South Wairarapa"]    = [];
		$regions["Wairarapa"]["Martinborough"]      = [];
		$regions["Marlborough"]                     = [];	
		$regions["Marlborough"]["Southern Valleys"] = [];
		$regions["Marlborough"]["Wairau Valley"]    = [];
		$regions["Marlborough"]["Awatere Valley"]   = [];
		$regions["Nelson"]                          = [];	
		$regions["Nelson"]["Moutere"]               = [];
		$regions["Nelson"]["Brightwater"]           = [];
		$regions["Canterbury/ Waipara Valley"]      = [];	
		$regions["Central Otago"]                   = [];	
		$regions["Central Otago"]["Wanaka"]         = [];
		$regions["Central Otago"]["Gibbston"]       = [];
		$regions["Central Otago"]["Bannockburn"]    = [];
		$regions["Central Otago"]["Alexandra"]      = [];
		$regions["Central Otago"]["Roxburgh"]       = [];
		$regions["Central Otago"]["Bendigo"]        = [];
		$regions["Central Otago"]["Lowburn/ Pisa"]  = [];
		$regions["Central Otago"]["Cromwell"]       = [];

		foreach ($regions as $region => $children) {
			$this->makeChild($country, $region, $children, $depths, $country->country_id);
		}

    }

    private function makeChild($parent, $name, $children, $depths = [], $country_id)
	{

		if (count($depths)) {
			$depth = array_shift($depths);
		}
		else {
			$depth = 7;
		}

		$child = Region::create(['en' => ['name' => $name], 'region_type_id' => $depth, 'country_id' => $country_id]);
		$child->makeLastChildOf($parent);

		foreach ($children as $name => $grandchildren) {
			$this->makeChild($child, $name, $grandchildren, $depths, $country_id);
		}


	}
}

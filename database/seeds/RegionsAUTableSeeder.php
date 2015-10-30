<?php

use Vinfo\Region;

class RegionsAUTableSeeder extends RegionsTableSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		$country = Region::whereTranslation('name', 'Australia', 'en')->first();
		DB::table('regions')->where('country_id', $country->country_id)->where('id', '!=', $country->id)->delete();
		
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
		$regions['South Australia']['Adelaide']                                                    = [];
		$regions['South Australia']['Adelaide']['Mount Lofty Ranges']                              = '_SHORTCUT';
		$regions['South Australia']['Adelaide']['Fleurieu']                                        = '_SHORTCUT';
		$regions['South Australia']['Adelaide']['Barossa']                                         = '_SHORTCUT';
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
		$regions['Victoria']['North West Victoria']['Murray Darling']                              = '_SHORTCUT';
		$regions['Victoria']['North West Victoria']['Swan Hill']                                   = '_SHORTCUT';
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

		// $deNames = [
		// 'Australian Capital Territory' => 'Australisches Hauptstadtterritorium',
		// 'New South Wales'              => 'Neusüdwales',
		// 'Northern Territory'           => 'Nordterritorium',
		// 'South Australia'              => 'Südaustralien',
		// 'Tasmania'                     => 'Tasmanien',
		// 'Western Australia'            => 'Westaustralien',
		// ];

		// foreach ($deNames as $en => $de) {
		// 	$region = Region::whereTranslation('name', $en, 'en')->first();
		// 	$region->fill(['de' => ['name' => $de]])->save();
		// }

		$regions = [];
		$depths  = [5, 2];

		$regions['South Eastern Australia']                    = [];
		$regions['South Eastern Australia']['New South Wales'] = '_SHORTCUT';
		$regions['South Eastern Australia']['South Australia'] = '_SHORTCUT';
		$regions['South Eastern Australia']['Queensland']      = '_SHORTCUT';
		$regions['South Eastern Australia']['Victoria']        = '_SHORTCUT';

		foreach ($regions as $region => $children) {
			$this->makeChild($country, $region, $children, $depths, $country->country_id);
		}
		
		$existing = Region::whereTranslationIn('name', ['Australian Capital Territory', 'Northern Territory'], 'en')->update(['region_type_id' => 4]);

    }

}

<?php

use Vinfo\Region;

class RegionsNZTableSeeder extends RegionsTableSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		$country = Region::whereTranslation('name', 'New Zealand', 'en')->first();
		DB::table('regions')->where('country_id', $country->country_id)->where('id', '!=', $country->id)->delete();
		
		$regions = [];
		$depths  = [7, 8];

		$regions["Northland"]                                       = [];
		$regions["Auckland"]                                        = [];
		$regions["Auckland"]["Waiheke Island"]                      = [];
		$regions["Auckland"]["Henderson"]                           = [];
		$regions["Auckland"]["Clevedon"]                            = [];
		$regions["Auckland"]["Matakana"]                            = [];
		$regions["Auckland"]["Kumeu"]                               = [];
		$regions["Waikato"]                                         = [];
		$regions["Bay of Plenty"]                                   = [];
		$regions["Gisborne"]                                        = [];
		$regions["Hawke’s Bay"]                                     = [];
		$regions["Hawke’s Bay"]["Gimblett Gravels"]                 = [];
		$regions["Wairarapa"]                                       = [];
		$regions["Wairarapa"]["Carterton"]                          = [];
		$regions["Wairarapa"]["Masterton"]                          = [];
		$regions["Wairarapa"]["South Wairarapa"]                    = [];
		$regions["Wairarapa"]["Martinborough"]                      = [];
		$regions["Marlborough"]                                     = [];
		$regions["Marlborough"]["Southern Valleys"]                 = [];
		$regions["Marlborough"]["Wairau Valley"]                    = [];
		$regions["Marlborough"]["Awatere Valley"]                   = [];
		$regions["Nelson"]                                          = [];
		$regions["Nelson"]["Moutere"]                               = [];
		$regions["Nelson"]["Brightwater"]                           = [];
		$regions["Canterbury/ Waipara Valley"]                      = [];
		$regions["Canterbury/ Waipara Valley"]["Waipara Valley"]    = [];
		$regions["Canterbury/ Waipara Valley"]["Canterbury Plains"] = [];
		$regions["Canterbury/ Waipara Valley"]["Waitaki Valley"]    = [];
		$regions["Central Otago"]                                   = [];
		$regions["Central Otago"]["Wanaka"]                         = [];
		$regions["Central Otago"]["Gibbston"]                       = [];
		$regions["Central Otago"]["Bannockburn"]                    = [];
		$regions["Central Otago"]["Alexandra"]                      = [];
		$regions["Central Otago"]["Roxburgh"]                       = [];
		$regions["Central Otago"]["Bendigo"]                        = [];
		$regions["Central Otago"]["Lowburn/ Pisa"]                  = [];
		$regions["Central Otago"]["Cromwell"]                       = [];

		foreach ($regions as $region => $children) {
			$this->makeChild($country, $region, $children, $depths, $country->country_id);
		}

    }

}

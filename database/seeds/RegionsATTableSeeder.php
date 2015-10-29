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
		$regions = [];
		$depths  = [7, 8];

$text = <<<TXT
AT			
|	Weinland Österreich		Region
||	Niederösterreich	Lower Austria	Bundesland
|||	Wachau		Gebiet
|||	Kremstal		Gebiet
||||	Kremstal DAC		Districtus Austriae Controllatus
|||	Kamptal		Gebiet
||||	Kamptal DAC		Districtus Austriae Controllatus
|||	Traisental		Gebiet
||||	Traisental DAC		Districtus Austriae Controllatus
|||	Wagram/ Donauland		Gebiet
|||	Weinviertel		Gebiet
||||	Weinviertel DAC		Districtus Austriae Controllatus
|||	Carnuntum		Gebiet
|||	Thermenregion		Gebiet
||	Burgenland		Bundesland
|||	Neusiedlersee		Gebiet
||||	Leithaberg DAC		Districtus Austriae Controllatus
|||	Neusiedlersee-Hügelland		Gebiet
||||	Leithaberg DAC_SHORTCUT		Districtus Austriae Controllatus
|||	Mittelburgenland		Gebiet
||||	Mittelburgenland DAC		Districtus Austriae Controllatus
|||	Südburgenland	South Burgenland	Gebiet
||||	Eisenberg DAC		Districtus Austriae Controllatus
|	Steirerland		Region
||	Steiermark	Styria	Bundesland
|||	Süd-Oststeiermark		Gebiet
|||	Südsteiermark		Gebiet
|||	Weststeiermark		Gebiet
|	Wien		Region
||	Wien	Vienna	Bundesland
|||	Wien		Gebiet
|	Bergland Österreich		Region
||	Oberösterreich	Upper Austria	Bundesland
||	Kärnten	Carinthia	Bundesland
||	Salzburg		Bundesland
||	Tirol	Tyrol	Bundesland
||	Vorarlberg		Bundesland
TXT;

		$regions["Northland"]                                       = [];

		foreach ($regions as $region => $children) {
			$this->makeChild($country, $region, $children, $depths, $country->country_id);
		}

    }

}

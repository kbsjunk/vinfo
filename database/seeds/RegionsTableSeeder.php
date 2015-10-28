<?php

use Illuminate\Database\Seeder;

use Vinfo\Country;
use Vinfo\Region;

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
    }

    protected function makeChild($parent, $name, $children, $depths = [], $country_id)
    {

    	if (count($depths)) {
    		$depth = array_shift($depths);
    		if (empty($depth)) {
    			$depth = 7;
    		}
    	}
    	else {
    		$depth = 7;
    	}

    	if ($name == '_SHORTCUT') {
    		return;
    	}
    	elseif (is_string($children) && $children == '_SHORTCUT') {
    		$existing = Region::whereTranslation('name', $name, 'en')->first();
    		$child = Region::create(['en' => ['name' => $name], 'region_type_id' => $depth, 'shortcut_id' => $existing->id, 'country_id' => $country_id]);
    		$child->makeLastChildOf($parent);
    	}
    	else {
    		$child = Region::create(['en' => ['name' => $name], 'region_type_id' => $depth, 'country_id' => $country_id]);
    		$child->makeLastChildOf($parent);

    		foreach ($children as $name => $grandchildren) {
    			$this->makeChild($child, $name, $grandchildren, $depths, $country_id);
    		}
    	}

    }
}

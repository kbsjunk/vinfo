<?php

use Illuminate\Database\Seeder;

use Vinfo\Geometry;
use Vinfo\Region;
use Vinfo\Country;

class AssociateGeometriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $geometries = Geometry::where('geometried_id', null)->get();

        foreach ($geometries as $geometry) {
        	$name = $geometry->name;
        	if (stripos($name, ' - ') !== false) {
        		$name = last(explode(' - ', $name));
        	}

        	if ($regions = Region::whereTranslation('name', $name)
        		->where('shortcut_id', null)
        		->where('is_structural', false)
        		->whereIn('country_id', [15, 163])
        		->get()) {
        		if (count($regions) == 1) {
        			$region = $regions->first();
	        		$geometry->geometried()->associate($region);
    	    		$geometry->save();
    	    		$this->command->line('<info>Associated</info> '.$geometry->name . ' <info>to</info> ' . $region->name);
        		}
        		elseif (count($regions) == 0) {

        		}
        		else {
        			$this->command->line('<info>Cannot Associate</info> '.$geometry->name . ' <info>to</info> ' . count($regions) . ' regions');
        		}
        	}
        }
    }
}

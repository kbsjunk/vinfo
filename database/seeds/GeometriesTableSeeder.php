<?php

use Illuminate\Database\Seeder;

use Vinfo\Geometry;

class GeometriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// DB::table('geometries')->delete();

    	// $data = 'data/regions/au.points.geojson';
    	// $data = 'data/regions/au.polygons.geojson';
    	$data = 'data/regions/001.points.geojson';

    	$geometries = json_decode(file_get_contents(base_path($data)), true);

    	$features = GeoJson\GeoJson::jsonUnserialize($geometries);

    	foreach ($features->getFeatures() as $feature) {
    		$geometry = Geometry::createFromFeature($feature);
    	}

    }
}

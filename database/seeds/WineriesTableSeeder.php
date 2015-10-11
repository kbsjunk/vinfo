<?php

use Illuminate\Database\Seeder;
use Vinfo\Winery;
use Vinfo\Country;

class WineriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('wineries')->truncate();

    	$faker = Faker\Factory::create();

    	for ($i=1; $i <= 50; $i++) {

    		$winery = new Winery;
    		$winery->name = ucwords(implode(' ', $faker->words(3)));
    		$winery->address = $faker->address();
    		$winery->country_id = Country::whereCode($faker->countryCode())->first();
    		$winery->save();
    	}

    }
}

<?php

use Illuminate\Database\Seeder;
use Vinfo\Wine;

class WinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wines')->truncate();

        $faker = Faker\Factory::create();

        for ($i=1; $i <= 20; $i++) { 
        	$wine = new Wine;
        	$wine->name = ucwords(implode(' ', $faker->words(3)));
        	$wine->description = $faker->sentence();
        	$wine->winery_id = $
        	$wine->save();
        }

    }
}

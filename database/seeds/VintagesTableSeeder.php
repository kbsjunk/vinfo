<?php

use Illuminate\Database\Seeder;

use Vinfo\Vintage;

class VintagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('vintages')->truncate();

    	for ($i=1; $i <= 20; $i++) { 
			$case = new Vintage;
			$case->wine_id = $i;
			$case->year    = date('Y');
			$case->save();

    	}
    }
}

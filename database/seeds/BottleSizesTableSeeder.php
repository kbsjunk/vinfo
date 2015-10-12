<?php

use Illuminate\Database\Seeder;
use Vinfo\BottleSize;

// http://www.wine-world.com/culture/zt/20140217171349239

class BottleSizesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	DB::table('bottle_sizes')->delete();

        $sizes = json_decode(File::get(dirname(__FILE__).'/bottle_sizes.json'), true);

        foreach ($sizes as $size) {
        	BottleSize::create($size);
        }

    }
}

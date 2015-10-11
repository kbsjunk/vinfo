<?php

use Illuminate\Database\Seeder;
use Vinfo\BottleSize;

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

        $sizes = require(storage_path('app/bottle_sizes.php'));

        foreach ($sizes as $size) {
        	BottleSize::create($size);
        }

    }
}

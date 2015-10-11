<?php

use Illuminate\Database\Seeder;

use Vinfo\BottleCase;
use Vinfo\Bottle;

class BottleCasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('bottle_cases')->truncate();

    	for ($i=11; $i <= 20; $i++) { 
			$case = new BottleCase;
			$case->quantity           = $i % 2 ? 12 : 6;
			$case->vintage_id         = $i;
			$case->rack_id            = $i;
			$case->shelf_id           = $i;
			$case->bottle_size_id     = 1;
			$case->vendor_id          = $i;
			$case->purchased_at       = Carbon\Carbon::now();
			$case->consumed_reason_id = null;

			$case->save();

    	}
    }
}

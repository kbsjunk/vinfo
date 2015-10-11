<?php

use Illuminate\Database\Seeder;

use Vinfo\Bottle;

class BottlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('bottles')->truncate();

    	for ($i=1; $i <= 10; $i++) { 
			$bottle = new Bottle;
			$bottle->vintage_id         = $i;
			$bottle->rack_id            = $i;
			$bottle->shelf_id           = $i;
			$bottle->bottle_size_id     = 1;
			$bottle->vendor_id          = $i;
			$bottle->purchased_at       = Carbon\Carbon::now();
			$bottle->consumed_reason_id = null;

			$bottle->save();
    	}
    }
}

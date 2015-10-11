<?php

use Illuminate\Database\Seeder;

class ConsumedReasonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
	public function run()
	{

		DB::table('consumed_reasons')->truncate();

		$reasons = [
		'Drank'           => [1, ['Rating' => 'rating']],
		'Gave as gift'    => [0, ['Recipient' => 'text']],
		'Sold'            => [0, ['Buyer' => 'text', 'Price' => 'money', 'currency' => 'currency']],
		'Used in cooking' => [1, ['Rating' => 'rating', 'Meal' => 'text']],
		'Corked'          => [0, []],
		'Damaged'         => [0, []],
		'Spilled'         => [0, []],
		'Stolen'          => [0, []],
		'Lost'            => [0, []],
		'(Unknown)'       => [0, []],
		];

		foreach ($reasons as $reason => $drank)
		{
			Vinfo\ConsumedReason::create([
				'name'     => $reason,
				'is_drank' => $drank[0],
				'info'     => $drank[1],
				]);
		}
	}
}

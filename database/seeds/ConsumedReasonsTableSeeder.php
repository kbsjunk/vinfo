<?php

use Illuminate\Database\Seeder;

use Vinfo\ConsumedReason;

class ConsumedReasonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('consumed_reasons')->delete();

        $reasons = [
            [
                'is_drank' => 1,
                'info'     => ['rating' => 'rating'],
                'en'       => ['name'=>'Drank'],
                'de'       => ['name'=>'Getrunken'],
                // 'fr'       => ['name'=>''],
                // 'es'       => ['name'=>''],
            ],
            [
                'is_drank' => 0,
                'info'     => ['recipient' => 'text'],
                'en'       => ['name'=>'Gave as gift'],
                'de'       => ['name'=>'Geschenkt'],
                // 'fr'       => ['name'=>''],
                // 'es'       => ['name'=>''],
            ],
            [
                'is_drank' => 0,
                'info'     => ['buyer' => 'text', 'price' => 'money', 'currency' => 'currency'],
                'en'       => ['name'=>'Sold'],
                'de'       => ['name'=>'Verkauft'],
                // 'fr'       => ['name'=>''],
                // 'es'       => ['name'=>''],
            ],
            [
                'is_drank' => 1,
                'info'     => ['rating' => 'rating', 'meal' => 'text'],
                'en'       => ['name'=>'Used in cooking'],
                'de'       => ['name'=>'Beim Kochen verwendet'],
                // 'fr'       => ['name'=>''],
                // 'es'       => ['name'=>''],
            ],
            [
                'is_drank' => 0,
                'info'     => [],
                'en'       => ['name'=>'Corked'],
                'de'       => ['name'=>'Verdorben'],
                // 'fr'       => ['name'=>''],
                // 'es'       => ['name'=>''],
            ],
            [
                'is_drank' => 0,
                'info'     => [],
                'en'       => ['name'=>'Damaged'],
                'de'       => ['name'=>'Beschädigt'],
                // 'fr'       => ['name'=>''],
                // 'es'       => ['name'=>''],
            ],
            [
                'is_drank' => 0,
                'info'     => [],
                'en'       => ['name'=>'Spilled'],
                'de'       => ['name'=>'Verschüttet'],
                // 'fr'       => ['name'=>''],
                // 'es'       => ['name'=>''],
            ],
            [
                'is_drank' => 0,
                'info'     => [],
                'en'       => ['name'=>'Stolen'],
                'de'       => ['name'=>'Gestohlen'],
                // 'fr'       => ['name'=>''],
                // 'es'       => ['name'=>''],
            ],
            [
                'is_drank' => 0,
                'info'     => [],
                'en'       => ['name'=>'Lost'],
                'de'       => ['name'=>'Verloren'],
                // 'fr'       => ['name'=>''],
                // 'es'       => ['name'=>''],
            ],
            [
                'is_drank' => 0,
                'info'     => [],
                'en'       => ['name'=>'(Unknown)'],
                'de'       => ['name'=>'(Unbekannt)'],
                // 'fr'       => ['name'=>''],
                // 'es'       => ['name'=>''],
            ],
        ];

        foreach ($reasons as $reason)
        {
            $reason = ConsumedReason::create($reason);
        }
    }
}

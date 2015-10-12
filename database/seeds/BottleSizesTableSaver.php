<?php

use Illuminate\Database\Seeder;
use Vinfo\BottleSize;

class BottleSizesTableSaver extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $bottle_sizes = BottleSize::with('translations')->get();

        $output = [];

        foreach ($bottle_sizes as $data) {
            
            $row = [
                'capacity'  => $data['capacity'],
                'is_common' => $data['is_common'],
            ];

            foreach ($data->translations as $translation) {
                foreach ($data->translatedAttributes as $attribute) {
                    $row[$translation->locale][$attribute] = $translation->$attribute;
                }
            }

            $output[] = $row;
        }

        $output = json_encode($output, JSON_PRETTY_PRINT);

        File::put(dirname(__FILE__).'/bottle_sizes.json', $output);

    }
}

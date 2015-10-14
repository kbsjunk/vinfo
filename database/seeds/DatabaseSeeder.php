<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
		
        $this->call(CountriesTableSeeder::class);
        $this->call(LanguagesTableSeeder::class);
        $this->call(CurrenciesTableSeeder::class);
        $this->call(UsersTableSeeder::class); 
        
        $this->call(BottleSizesTableSeeder::class); 
// $this->call(BottleSizesTableSaver::class); 
        // $this->call(ConsumedReasonsTableSeeder::class);
        // $this->call(BottlesTableSeeder::class);
        // $this->call(BottleCasesTableSeeder::class);
        // $this->call(WineriesTableSeeder::class);
        // $this->call(WinesTableSeeder::class);
        // $this->call(VintagesTableSeeder::class);

        Model::reguard();
    }
}

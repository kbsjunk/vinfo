<?php

use Illuminate\Database\Seeder;
use Vinfo\User;
use Vinfo\Country;
use Vinfo\Language;
use Vinfo\Currency;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('users')->delete();

        $users = [
            [
                'id'       => 1,
                'name'     => 'System',
                'email'    => 'system@vinfo',
                'password' => bcrypt('password'),
                'is_admin' => true,
            ],
            [
                'id'       => 2,
                'name'     => 'Admin',
                'email'    => 'admin@vinfo',
                'password' => bcrypt('password'),
                'is_admin' => true,
            ],
			[
                'id'       => 3,
				'name'     => 'User',
				'email'    => 'user@vinfo',
				'password' => bcrypt('password'),
                'is_admin' => false,
			],
		];

        $country = Country::whereCode('GB')->first();
        $language = Language::whereCode('en-GB')->first();
        $currency = Currency::whereCode('GBP')->first();

		foreach ($users as $userData) {
            $user = new User;
            $user->fill($userData);
            $user->country()->associate($country);
            $user->language()->associate($language);
            $user->currency()->associate($currency);
            $user->save();
        }
    }
}

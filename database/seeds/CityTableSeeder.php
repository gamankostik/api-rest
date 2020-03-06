<?php

use Illuminate\Database\Seeder;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities[] = [
            'name' => 'Forestville',
            'latitude'  => 38.473625,
            'longitude'  => -122.889992
        ];
        $cities[] = [
            'name' => 'Houston',
            'latitude'  => 29.749907,
            'longitude'  => -95.358421
        ];

        foreach ($cities as $city) {
            DB::table('city')->insert([
                'name' => $city['name'],
                'latitude' => $city['latitude'],
                'longitude' => $city['longitude'],
            ]);
        }
    }
}

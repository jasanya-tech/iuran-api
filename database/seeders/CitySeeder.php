<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::updateOrCreate([
            ['city_name' => 'jakarta barat', 'province_id' => 1],
            ['city_name' => 'bandung barat', 'province_id' => 2],
        ], ['city_name', 'province_id']);
    }
}

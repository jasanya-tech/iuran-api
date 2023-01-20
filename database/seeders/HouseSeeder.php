<?php

namespace Database\Seeders;

use App\Models\House;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $houses = [
            ["user_id" => 2, "house_name" => "Rumah Laila 1", "unit_cars" => 2, "unit_motorcycles" => 2, "address" => "Jalan Indah no.16", "city_id" => 3174],
            ["user_id" => 2, "house_name" => "Rumah Laila 2", "unit_cars" => null, "unit_motorcycles" => null, "address" => "Jalan Indo no.1", "city_id" => 3174],
            ["user_id" => 3, "house_name" => "Rumah Syahrul", "unit_cars" => 3, "unit_motorcycles" => 1, "address" => "Jalan Indo no.17", "city_id" => 3174],
        ];
        House::upsert($houses, ["user_id", "house_name", "address"]);
    }
}

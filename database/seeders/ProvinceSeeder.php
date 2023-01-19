<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Province::updateOrCreate([
            ['province_name' => 'jakarta'],
            ['province_name' => 'bandung'],
        ], ['province_name']);
    }
}

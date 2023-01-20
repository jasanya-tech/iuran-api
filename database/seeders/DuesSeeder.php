<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DuesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dues = [
            ["house_id" => 1, "dues_type_id" => 1],
            ["house_id" => 1, "dues_type_id" => 2],
            ["house_id" => 1, "dues_type_id" => 3],
            ["house_id" => 1, "dues_type_id" => 4],
            ["house_id" => 2, "dues_type_id" => 1],
            ["house_id" => 2, "dues_type_id" => 2],
            ["house_id" => 3, "dues_type_id" => 1],
            ["house_id" => 3, "dues_type_id" => 2],
            ["house_id" => 3, "dues_type_id" => 3],
            ["house_id" => 3, "dues_type_id" => 4]
        ];
    }
}

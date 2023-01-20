<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ProvinceSeeder::class,
            CitySeeder::class,
            RoleUserSeeder::class,
            UserSeeder::class,
            DuesTypeSeeder::class,
            HouseSeeder::class,
            DuesSeeder::class,
            TransactionSeeder::class,
        ]);
    }
}

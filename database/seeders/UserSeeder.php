<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::upsert([
            ["full_name" => "admin", "email" => "admin@iuran.jasanya.tech", "password" => Hash::make('123456'), "role_user_id" => 1],
            ["full_name" => "laila alfi syah", "email" => "laila@gmail.com", "password" => Hash::make('123456'), "role_user_id" => 2],
            ["full_name" => "syahrul saefulah", "email" => "syahrul@iuran.jasanya.tech", "password" => Hash::make('123456'), "role_user_id" => 2],
        ], ["full_name", "email"]);
    }
}

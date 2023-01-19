<?php

namespace Database\Seeders;

use App\Models\Role_user;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role_user::upsert(
            [
                ["role_name" => "admin", "access" => 'admin'],
                ["role_name" => "warga", "access" => 'warga']
            ],
            ["role_name", "access"]
        );
    }
}

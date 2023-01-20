<?php

namespace Database\Seeders;

use App\Models\Dues_type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DuesTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $duse_types = [
            ["dues_name" => "kebersihan", "price"  => 20000, "jenis_iuran" => "wajib"],
            ["dues_name" => "keamanan", "price"  => 10000, "jenis_iuran" => "wajib"],
            ["dues_name" => "mobil", "price"  => 10000, "jenis_iuran" => "optional"],
            ["dues_name" => "motor", "price"  => 5000, "jenis_iuran" => "optional"],
        ];

        Dues_type::upsert($duse_types, ["dues_name"]);
    }
}

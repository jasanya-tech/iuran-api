<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provinsi = [
            // Pulau Sumatra
            ['id' => '11', 'province_name' => 'ACEH'],
            ['id' => '12', 'province_name' => 'SUMATERA UTARA'],
            ['id' => '13', 'province_name' => 'SUMATERA BARAT'],
            ['id' => '14', 'province_name' => 'RIAU'],
            ['id' => '15', 'province_name' => 'JAMBI'],
            ['id' => '16', 'province_name' => 'SUMATERA SELATAN'],
            ['id' => '17', 'province_name' => 'BENGKULU'],
            ['id' => '18', 'province_name' => 'LAMPUNG'],
            ['id' => '19', 'province_name' => 'KEPULAUAN BANGKA BELITUNG'],
            ['id' => '21', 'province_name' => 'KEPULAUAN RIAU'],
            ['id' => '31', 'province_name' => 'DKI JAKARTA'],
            ['id' => '32', 'province_name' => 'JAWA BARAT'],
            ['id' => '33', 'province_name' => 'JAWA TENGAH'],
            ['id' => '34', 'province_name' => 'DI YOGYAKARTA'],
            ['id' => '35', 'province_name' => 'JAWA TIMUR'],
            ['id' => '36', 'province_name' => 'BANTEN'],
            ['id' => '51', 'province_name' => 'BALI'],
            ['id' => '52', 'province_name' => 'NUSA TENGGARA BARAT'],
            ['id' => '53', 'province_name' => 'NUSA TENGGARA TIMUR'],
            ['id' => '61', 'province_name' => 'KALIMANTAN BARAT'],
            ['id' => '62', 'province_name' => 'KALIMANTAN TENGAH'],
            ['id' => '63', 'province_name' => 'KALIMANTAN SELATAN'],
            ['id' => '64', 'province_name' => 'KALIMANTAN TIMUR'],
            ['id' => '65', 'province_name' => 'KALIMANTAN UTARA'],
            ['id' => '71', 'province_name' => 'SULAWESI UTARA'],
            ['id' => '72', 'province_name' => 'SULAWESI TENGAH'],
            ['id' => '73', 'province_name' => 'SULAWESI SELATAN'],
            ['id' => '74', 'province_name' => 'SULAWESI TENGGARA'],
            ['id' => '75', 'province_name' => 'GORONTALO'],
            ['id' => '76', 'province_name' => 'SULAWESI BARAT'],
            ['id' => '81', 'province_name' => 'MALUKU'],
            ['id' => '82', 'province_name' => 'MALUKU UTARA'],
            ['id' => '91', 'province_name' => 'PAPUA BARAT'],
            ['id' => '94', 'province_name' => 'PAPUA']
        ];

        Province::upsert($provinsi, ['province_name']);
    }
}

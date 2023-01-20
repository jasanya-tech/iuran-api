<?php

namespace Database\Seeders;

use App\Models\Report;
use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tranaction = Transaction::create(
            [
                "house_id" => 1,
                'total_dues' => 60000,
                'status' => "terkonfirmasi",
                'proof_payment' => "/proof_payment/default.jpg",
                "confirmation_date" => Carbon::now()
            ]
        );

        $report = [
            [
                "invoice_payment" => $tranaction->id,
                "dues_type_id" => 1,
                "qty" => 1,
                "price" => 20000,
            ],
            [
                "invoice_payment" => $tranaction->id,
                "dues_type_id" => 2,
                "qty" => 1,
                "price" => 10000,
            ],
            [
                "invoice_payment" => $tranaction->id,
                "dues_type_id" => 3,
                "qty" => 2,
                "price" => 10000,
            ],
            [
                "invoice_payment" => $tranaction->id,
                "dues_type_id" => 4,
                "qty" => 2,
                "price" => 10000,
            ]
        ];
        $report = Report::upsert($report, ['invoice_payment']);
    }
}

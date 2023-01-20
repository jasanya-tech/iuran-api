<?php

namespace App\Http\Controllers\CRUD;

use App\Helpers\Helper;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Dues;
use App\Models\Report;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::all();
        $transactions = collect($transactions)->map->only(['invoce', 'total_dues', 'status', 'proof_payment', 'confirmation_date', 'house']);
        return response()->json([
            "transactions" => $transactions,
            "message" => "Successfully",
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        $transaction = new Transaction;
        $transaction->total_dues = $request->total_dues;
        $transaction->house_id = $request->house_id;
        if ($request->hasFile('proof_payment')) {
            $path = Storage::putFile('public/images/proof_payment', $request->proof_payment);
            $path = Helper::reImagePath($path);
            $transaction->proof_payment = $path;
        } else {
            return response()->json(
                [
                    "message" => [
                        "proof_payment" => [
                            "proof payment required"
                        ]
                    ]
                ],
                400
            );
        }
        $transaction->save();
        DB::commit();
        return response()->json(
            [
                "message" => "Transaksi berhasil silahkan tunggu konfirmasi admin",
            ],
            201
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show($invoice)
    {
        $transaction = Transaction::where('invoice', $invoice)->first();
        $transaction = collect($transaction)->only(['invoice', 'total_dues', 'status', 'proof_payment', 'confirmation_date'])
            ->put('house', collect($transaction->house)->put('detail_dues', collect($transaction->house->dues)->map(function ($dues) {
                if ($dues->dues_type->id == 3) {
                    $dues->dues_type->price = $dues->dues_type->price * $dues->house->unit_cars;
                }
                if ($dues->dues_type->id == 4) {
                    $dues->dues_type->price = $dues->dues_type->price * $dues->house->unit_motorcycles;
                }
                return $dues->dues_type->only(['dues_name', 'price']);
            })));
        return response()->json([
            "transaction" => $transaction,
            "message" => "Successfully",
        ], 200);
    }

    /**
     * Fungsi confirm digunakan untuk Konfirmasi pembayaran.
     *
     * 
     */
    public function confirm($invoice)
    {
        DB::beginTransaction();
        $confirm = Transaction::where(['invoice' => $invoice, 'status' => 'belum di konfirmasi'])->update([
            'status' => 'terkonfirmasi',
            'confirmation_date' => Carbon::now(),
        ]);
        if (!$confirm) {
            DB::rollBack();
            return response()->json(
                [
                    "message" => "Konfirmasi gagal / sudah di konfirmasi"
                ],
                400
            );
        }
        $transaction = Transaction::where('invoice', $invoice)->first();
        $transaction = collect($transaction->house->dues)->map(function ($dues) {
            $price = $dues->dues_type->price;
            if ($dues->dues_type->id == 3) {
                $dues = collect($dues)->put('qty', $dues->house->unit_cars);
            } elseif ($dues->dues_type->id == 4) {
                $dues = collect($dues)->put('qty', $dues->house->unit_motorcycles);
            } else {
                $dues = collect($dues)->put('qty', 1);
            }
            $dues = collect($dues)->put('price', $price);
            return $dues->only(['dues_type_id', 'qty', 'price']);
        });
        $report = [];
        for ($i = 0; $i < $transaction->count(); $i++) {
            $report[] = [
                'invoice_payment' => $invoice,
                'dues_type_id' => $transaction[$i]['dues_type_id'],
                'qty' => $transaction[$i]['qty'],
                'price' => $transaction[$i]['price']
            ];
        }
        $insertReport = Report::insert($report);
        if (!$insertReport) {
            DB::rollBack();
            return response()->json(
                [
                    "message" => "Insert report gagal"
                ],
                400
            );
        }
        DB::commit();
        return response()->json(
            [
                "message" => "konfirmsi berhasil"
            ],
            200
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}

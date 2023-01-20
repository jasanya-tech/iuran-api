<?php

namespace App\Http\Controllers\Warga;

use App\Models\Dues;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\House;
use Illuminate\Support\Facades\Auth;

class DuesController extends Controller
{

    public $user_id;
    public function __construct()
    {
        $this->user_id = Auth::user()->id;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $houses = House::where('user_id', $this->user_id)->get();
        $houses = collect($houses)->map(function ($house) {
            return collect($house)->only(['id', 'picture', 'house_name', 'unit_cars', 'unit_motorcycles'])
                ->put('owner', $house->user->full_name)
                ->put('total_dues', collect($house->dues)->map(function ($d) {
                    if ($d->dues_type->id == 3) {
                        $d->dues_type->price = $d->dues_type->price * $d->house->unit_cars;
                    }
                    if ($d->dues_type->id == 4) {
                        $d->dues_type->price = $d->dues_type->price * $d->house->unit_motorcycles;
                    }
                    return collect($d->dues_type)->only('price');
                })->map(function ($dues) {
                    return $dues->sum('price');
                }));
        });
        return response()->json([
            "houses" => $houses,
            "message" => "data tagihan iuran berdasarkan rumah"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dues  $dues
     * @return \Illuminate\Http\Response
     */
    public function show($house_id)
    {
        $house = House::where(['id' => $house_id, 'user_id' => $this->user_id])->first();
        if (!$house) {
            return response()->json(
                [
                    "message" => "Rumah tidak tersedia"
                ],
                404
            );
        }
        $house = collect($house)->only(['id', 'picture', 'house_name', 'unit_cars', 'unit_motorcycles'])
            ->put('owner', $house->user->full_name)
            ->put('detail_dues', collect($house->dues)->map(function ($d) {
                if ($d->dues_type->id == 3) {
                    $d->dues_type->price = $d->dues_type->price * $d->house->unit_cars;
                }
                if ($d->dues_type->id == 4) {
                    $d->dues_type->price = $d->dues_type->price * $d->house->unit_motorcycles;
                }
                return collect($d->dues_type)->only('dues_name', 'price');
            }))
            ->put('total_dues', collect($house->dues)->map(function ($dues) {
                return $dues->dues_type->price;
            })->sum());
        return response()->json($house);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dues  $dues
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dues $dues)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dues  $dues
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dues $dues)
    {
        //
    }
}

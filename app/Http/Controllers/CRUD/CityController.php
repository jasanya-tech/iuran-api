<?php

namespace App\Http\Controllers\CRUD;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = collect(City::all())->map->only(['id', 'city_name', 'province', 'created_at', 'updated_at'])->all();
        return response()->json([
            'code' => 200,
            'data' => $cities,
            'message' => 'data kota berhasil di ambil'
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
        $city = City::updateOrCreate(
            ["province_id" => $request->province_id, "city_name" => $request->city_name,],
            ["city_name", "province_id"]
        );
        $city = collect($city)->put('province', collect($city->province)->only(['id', 'province_name']));
        return response()->json([
            'city' => $city,
            'message' => 'Data kota berhasil disimpan'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        $city = collect($city)->put('province', collect($city->province)->only(['id', 'province_name']));
        return response()->json([
            'city' => $city,
            'message' => '1 Data kota berhasil di ambil'
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        $city->city_name = $request->city_name;
        $city->province_id = $request->province_id;
        $city->save();
        $city = collect($city)->put('province', collect($city->province)->only(['id', 'province_name']));
        return response()->json([
            'city' => $city,
            'message' => 'Data kota berhasil diupdate'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        $city->delete();
        return response()->json([
            'city' => null,
            'message' => 'Data kota berhasil dihapus'
        ], 204);
    }
}

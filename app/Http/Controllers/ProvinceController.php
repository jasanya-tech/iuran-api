<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provinces = collect(Province::all())->map->only(['id', 'province_name', 'cities', 'created_at', 'updated_at'])->all();
        return response()->json([
            'code' => 200,
            'provinces' => $provinces,
            'message' => 'data provinsi berhasil di ambil'
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
        $province = Province::updateOrCreate(
            ["province_name" => $request->province_name],
            ["province_name"]
        );
        return response()->json([
            'province' => $province,
            'message' => 'Data provinsi berhasil disimpan'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function show(Province $province)
    {
        $province = collect($province)->put('cities', collect($province->cities)->map->only(['id', 'city_name']));
        return response()->json([
            'province' => $province,
            'message' => '1 Data provinsi berhasil di ambil'
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Province $province)
    {
        $province->province_name = $request->province_name;
        $province->save();
        $province = collect($province)->put('cities', collect($province->cities)->map->only(['id', 'city_name']));
        return response()->json([
            'province' => $province,
            'message' => 'Data provinsi berhasil diupdate'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function destroy(Province $province)
    {
        $province->delete();
        return response()->json([
            'province' => null,
            'message' => 'Data provinsi berhasil dihapus'
        ], 204);
    }
}

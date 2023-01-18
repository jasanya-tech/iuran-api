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
        $provinces = Province::paginate(10);
        return response()->json([
            'code' => 200,
            'data' => $provinces,
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
        $province = Province::create([
            "province_name" => $request->province_name,
        ]);
        return response()->json([
            'code' => 201,
            'data' => $province,
            'message' => 'Data provinsi berhasil disimpan'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function show(Province $province)
    {
        return response()->json([
            'code' => 200,
            'data' => $province,
            'message' => '1 Data provinsi berhasil di ambil'
        ]);
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
        return response()->json([
            'code' => 200,
            'data' => $province,
            'message' => 'Data provinsi berhasil diupdate'
        ]);
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
            'code' => 204,
            'data' => null,
            'message' => 'Data provinsi berhasil dihapus'
        ], 204);
    }
}

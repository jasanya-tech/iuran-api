<?php

namespace App\Http\Controllers\CRUD;

use App\Models\Dues_type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DuesTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dues_types = Dues_type::all();
        if (count($dues_types) == 0) {
            return response()->json([
                "message" => "jenis iuran kosong"
            ], 404);
        }
        return response()->json([
            "dues_types" => $dues_types,
            "message" => "jenis iuran berhasil di ambil"
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
        $dues_type = Dues_type::where('dues_name', strtolower($request->dues_name))->first();
        if (!$dues_type) {
            $dues_type = new Dues_type();
        }
        $dues_type->dues_name = strtolower($request->dues_name);
        $dues_type->price = $request->price;
        $dues_type->save();
        return response()->json([
            "dues_type" => $dues_type,
            "message" => "jenis iuran berhasil di tambahkan"
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dues_type  $dues_type
     * @return \Illuminate\Http\Response
     */
    public function show(Dues_type $dues_type)
    {
        return response()->json([
            "dues_type" => $dues_type
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dues_type  $dues_type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dues_type $dues_type)
    {
        $dues_type->dues_name = strtolower($request->dues_name);
        $dues_type->price = $request->price;
        $dues_type->save();
        return response()->json([
            "dues_type" => $dues_type,
            "message" => "jenis iuran berhasil di update"
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dues_type  $dues_type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dues_type $dues_type)
    {
        $dues_type->delete();
        return response()->json([
            "message" => "jenis iuran berhasil di delete"
        ], 204);
    }
}

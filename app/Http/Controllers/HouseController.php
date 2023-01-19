<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\House;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $houses  = House::all();
        $houses = collect($houses)->map->only(['id', 'house_name', 'picture', 'unit_cars', 'user', 'unit_motorcycle', 'created_at', 'updated_at'])->all();
        if (count($houses) == 0) {
            return response()->json([
                "message" => "rumah tidak di temukan"
            ], 404);
        }
        return response()->json([
            'houses' => $houses,
            'message' => 'data rumah berhasil di ambil'
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
        $house = new House;
        $house->user_id = $request->user_id;
        $house->house_name = $request->house_name;
        if ($request->hasFile('picture')) {
            $path = Storage::putFile('public/images/houses', $request->picture);
            $path = Helper::reImagePath($path);
            $house->picture = $path;
        }
        $house->unit_cars = $request->unit_cars;
        $house->unit_motorcycle = $request->unit_motorcycle;
        $house->address = $request->address;
        $house->city_id = $request->city_id;
        $house->save();
        return response()->json([
            'house' => $house,
            "message" => "Berhasil menambah rumah"
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\House  $house
     * @return \Illuminate\Http\Response
     */
    public function show(House $house)
    {
        $house = collect($house)->only(['id', 'house_name', 'picture', 'unit_cars', 'unit_motorcycle', 'created_at', 'updated_at'])->put('user', $house->user);
        return response()->json([
            'house' => $house,
            "message" => "data rumah id " . $house['id'] . " berhasil di ambil"
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\House  $house
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, House $house)
    {
        $house->user_id = $request->user_id;
        $house->house_name = $request->house_name;
        if ($request->hasFile('picture')) {
            $path = Storage::putFile('public/images/houses', $request->picture);
            $path = Helper::reImagePath($path);
            $house->picture = $path;
            if ($request->old_picture != 'defaut.jpg') {
                unlink(public_path('storage/images/' . $request->old_picture));
            }
        }
        $house->unit_cars = $request->unit_cars;
        $house->unit_motorcycle = $request->unit_motorcycle;
        $house->address = $request->address;
        $house->city_id = $request->city_id;
        $house->save();
        return response()->json([
            'house' => $house,
            "message" => "Berhasil menambah rumah"
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\House  $house
     * @return \Illuminate\Http\Response
     */
    public function destroy(House $house)
    {
        $house->delete();
        return response()->json([
            "message" => "data rumah berhasil di hapus",
        ], 204);
    }
}

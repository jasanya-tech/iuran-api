<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $users = collect($users)->map->only(['id', 'picture', 'full_name', 'email', 'created_at', 'updated_at', 'role_user'])->all();
        return response()->json([
            'users' => $users,
            'message' => 'data user berhasil di ambil'
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
        $rules = [
            'full_name' => 'required|string|max:45',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                "message" => $validator->errors()
            ], 400);
        }
        $user = new User;
        if ($request->file('picture')) {
            $path = Storage::putFile('public/images/profile', $request->image);
            $path = Helper::reImagePath($path);
            $user->picture = $path;
        }
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_user_id = 2;
        $user->save();
        $user = collect($user)->only(['id', 'full_name', 'email', 'picture'])->put('role_name', $user->role_user->role_name);
        return response()->json([
            'message' => 'data user berhasil di tambahkan',
            'user' => $user,
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json([
            'user' => $user->role_user,
            'message' => '1 Data user berhasil di ambil'
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'full_name' => 'required|string|max:45',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                "message" => $validator->errors()
            ], 400);
        }
        $user = new User;
        if ($request->file('picture')) {
            $path = Storage::putFile('public/images/profile', $request->picture);
            $path = Helper::reImagePath($path);
            $user->picture = $path;
            if ($request->old_picture != 'default.jpg') {
                unlink(public_path('storage/images/' . $request->old_picture));
            }
        }
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_user_id = 2;
        $user->save();
        $user = collect($user)->only(['id', 'full_name', 'email', 'picture'])->put('role_name', $user->role_user->role_name);
        return response()->json([
            'message' => 'data user berhasil di rubah',
            'user' => $user,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([
            'city' => null,
            'message' => 'Data user berhasil dihapus'
        ], 204);
    }
}

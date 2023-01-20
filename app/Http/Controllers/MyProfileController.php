<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyProfileController extends Controller
{
    public function whoami()
    {
        $user = Auth::user();
        return response()->json(
            [
                'name' => collect($user)->only(['id', 'full_name', 'picture'])->put('role_name', $user->role_user->role_name),
                "message" => "Successfully"
            ],
            200
        );
    }
}

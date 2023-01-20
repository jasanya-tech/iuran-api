<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyProfileController extends Controller
{
    public function myName()
    {
        return response()->json(
            [
                'name' => Auth::user()->full_name,
                "message" => "Successfully"
            ],
            200
        );
    }
}

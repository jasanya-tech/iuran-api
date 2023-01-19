<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HttpResponse extends Controller
{
    public function index()
    {
        return response()->json([
            "message" => "Butuh JWT token"
        ], 401);
    }
}

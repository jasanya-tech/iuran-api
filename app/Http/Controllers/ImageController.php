<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function uploadImage(Request $request)
    {
        $path = Storage::putFile('public/images/profile', $request->image);
        $path = Helper::reImagePath($path);
        return response()->json(['path' => $path]);
    }

    public function getImage($dir, $file_name)
    {
        $path = public_path("storage/images/$dir/$file_name");
        if (!File::exists($path)) {
            return response()->json(['error' => $path]);
        }
        $file = File::get($path);
        return response($file, 200)->header('Content-Type', File::mimeType($path));
    }
}

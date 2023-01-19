<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HouseController;
use App\Http\Controllers\HttpResponse;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Authentication

Route::group([
    'middleware' => ['api', 'cors'],
], function ($router) {
    $router->controller(AuthController::class)->group(function () {
        Route::post('login', 'login');
        Route::post('register', 'register');
        Route::post('logout', 'logout');
        Route::post('refresh', 'refresh');
    });
    Route::get('/needJwt', [HttpResponse::class, 'index'])->name('needJWT');
    Route::apiResource('houses', HouseController::class);
    Route::apiResource('users', UserController::class);
});

Route::group([
    'middleware' => ['auth:api', 'cors'],
], function ($router) {
    Route::apiResource('provinces', ProvinceController::class);
    Route::apiResource('cities', CityController::class);
    Route::get('image/{dir}/{file_name}', [ImageController::class, 'getImage']);
    Route::post('image', [ImageController::class, 'uploadImage']);
});

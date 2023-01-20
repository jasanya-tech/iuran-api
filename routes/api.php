<?php

use App\Http\Controllers\CRUD\CityController;
use App\Http\Controllers\CRUD\ProvinceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CRUD\DuesTypeController;
use App\Http\Controllers\CRUD\HouseController;
use App\Http\Controllers\CRUD\TransactionController;
use App\Http\Controllers\Warga\HouseController as WargaHouse;
use App\Http\Controllers\Warga\DuesController as WargaDues;
use App\Http\Controllers\HttpResponse;
use App\Http\Controllers\CRUD\UserController;
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
});

Route::group([
    'middleware' => ['auth:api', 'cors'],
], function ($router) {
    Route::apiResource('provinces', ProvinceController::class);
    Route::apiResource('cities', CityController::class);
    Route::apiResource('houses', HouseController::class);
    Route::apiResource('users', UserController::class);
    $router->controller(TransactionController::class)->group(function ($router) {
        $router->get('transactions', 'index');
        $router->get('transactions/{invoice}', 'show');
        $router->post('transactions', 'store');
        $router->put('transactions/confirm/{invoice}', 'confirm');
        $router->put('transactions/{invoice}', 'update');
        $router->delete('transactions/{invoice}', 'destroy');
    });
    Route::apiResource('dues_types', DuesTypeController::class);
    $router->prefix('warga')->group(function ($router) {
        Route::apiResource('houses', WargaHouse::class);
        $router->controller(WargaDues::class)->group(function ($router) {
            $router->get('dues', 'index');
            $router->get('dues/{home_id}', 'show');
        });
    });
    Route::apiResource('warga/dues', WargaDues::class);
    Route::get('image/{dir}/{file_name}', [ImageController::class, 'getImage']);
    Route::post('image', [ImageController::class, 'uploadImage']);
});

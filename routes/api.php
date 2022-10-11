<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



use App\Http\Controllers\Api\MainController;
use App\Http\Controllers\Api\AuthController;


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

Route::prefix('v1')->group(function () {
    Route::get('governorates', [MainController::class, 'governorates']);
    Route::get('cities', [MainController::class, 'cities']);
    Route::get('categories', [MainController::class, 'categories']);
    Route::get('settings', [MainController::class, 'settings']);
    Route::get('contacts', [MainController::class, 'contacts']);
    Route::get('bloodTypes', [MainController::class, 'bloodTypes']);
    Route::get('favourites', [MainController::class, 'favourites']);

    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('newPassword', [AuthController::class, 'newPassword']);
    Route::post('resetPassword', [AuthController::class, 'resetPassword']);


    Route::middleware('auth:api')->group(function () {

        Route::get('posts', [MainController::class, 'posts']);
        Route::post('profile', [MainController::class, 'profile']);

    });

});







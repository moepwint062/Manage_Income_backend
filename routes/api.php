<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Home\IncomeController;
use App\Http\Controllers\Home\WishesController;
use App\Http\Controllers\Home\ManageController;

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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // Income
    Route::get('/home-service/show-incomeList', [IncomeController::class, 'index']);
    Route::post('/home-service/save-to-income', [IncomeController::class, 'store']);

    // Wish List
    Route::get('/home-service/show-wishList', [WishesController::class, 'index']);
    Route::post('/home-service/save-to-wishList', [WishesController::class, 'store']);

    // Manage Income
    Route::get('/home-service/show-canBuyList', [ManageController::class, 'index']);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
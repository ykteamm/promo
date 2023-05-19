<?php

use App\Http\Controllers\ApiBattleController;
use App\Http\Controllers\ApiMatrixController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

Route::post('order-store', [OrderController::class, 'orderStore']);

Route::post('provizor-store', [UserController::class, 'provizorStore']);

Route::post('get-provizor', [ApiBattleController::class, 'getProvizor']);

Route::get('orders', [ApiMatrixController::class, 'orders']);

Route::post('change-status', [ApiMatrixController::class, 'changeStatus']);

Route::get('provizors', [ApiMatrixController::class, 'allProvizors']);

Route::post('money-arrival', [ApiMatrixController::class, 'moneyArrival']);

Route::post('battle-store', [ApiMatrixController::class, 'battleStore']);

Route::post('get-order', [ApiBattleController::class, 'getOrder']);

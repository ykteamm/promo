<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Auth::routes();

Route::middleware('auth')->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::post('login-user', [UserController::class, 'login'])->name('login-user');
    Route::get('/home', [UserController::class, 'index'])->name('user');
    Route::get('/shopping', [UserController::class, 'shopping'])->name('shopping');

    Route::get('market', [UserController::class, 'market'])->name('market');
    Route::get('order', [UserController::class, 'order'])->name('order');


    

    Route::resource('product', ProductController::class);
    Route::resource('order', OrderController::class);
    Route::resource('admin-order', AdminOrderController::class);

    Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin');
    Route::post('/order/delivery/{id}', [AdminOrderController::class, 'delivery'])->name('delivery');
    Route::post('/order/cashback/{id}', [AdminOrderController::class, 'cashback'])->name('cashback');

});
});

Route::post('/name-etap', [UserController::class, 'nameEtap'])->name('name-etap');
    Route::post('/date-etap', [UserController::class, 'dateEtap'])->name('date-etap');
    Route::post('/phone-etap', [UserController::class, 'phoneEtap'])->name('phone-etap');
    Route::post('/code-etap', [UserController::class, 'codeEtap'])->name('code-etap');
    Route::post('/parol-etap', [UserController::class, 'parolEtap'])->name('parol-etap');
    Route::post('/map-etap', [UserController::class, 'mapEtap'])->name('map-etap');


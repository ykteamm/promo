<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
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

// Route::middleware('auth')->group(function () {

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [UserController::class, 'index'])->name('user');
Route::get('/shopping', [UserController::class, 'shopping'])->name('shopping');

Route::post('/name-etap', [UserController::class, 'nameEtap'])->name('name-etap');
Route::post('/date-etap', [UserController::class, 'dateEtap'])->name('date-etap');
Route::post('/phone-etap', [UserController::class, 'phoneEtap'])->name('phone-etap');
Route::post('/code-etap', [UserController::class, 'codeEtap'])->name('code-etap');
Route::post('/parol-etap', [UserController::class, 'parolEtap'])->name('parol-etap');
Route::post('/map-etap', [UserController::class, 'mapEtap'])->name('map-etap');
// });
Auth::routes();


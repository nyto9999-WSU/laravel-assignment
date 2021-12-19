<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AirConController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|dd
*/

Route::get('/', function () {
    return view('welcome');
});
//tonyadsds
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//I add a route hereddd
Auth::routes();


Route::resource('order', OrderController::class);




Route::get('/aircon/{aircon}/order{order}/', [AirConController::class, 'show'])->name('aircon.show');
Route::post('/aircon/order/{order}', [AirConController::class, 'store'])->name('aircon.store');
Route::resource('aircon', AirConController::class)->except(['store', 'show']);
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AirConController;
use App\Http\Controllers\RolePermissionController;
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
Auth::routes();

/* Dashboards */
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/* Order */
Route::resource('order', OrderController::class);

/* Aircon */
Route::get('/aircon/{aircon}/order{order}/', [AirConController::class, 'show'])->name('aircon.show');
Route::get('/airconall/order{order}/', [AirConController::class, 'showAll'])->name('aircon.showAll');
Route::post('/aircon/order/{order}', [AirConController::class, 'store'])->name('aircon.store');
Route::delete('/aircon/delete/{aircon}/order{order}', [AirConController::class, 'destroy'])->name('aircon.destroy');
Route::resource('aircon', AirConController::class)->except(['store', 'show', 'destroy']);

/* Role & Permission */
Route::get('role-permission', [RolePermissionController::class, 'index'])->name('rolePermission.index');
Route::patch('role-permission/{user}/edit', [RolePermissionController::class, 'update'])->name('rolePermission.update');
Route::delete('role-permission/{user}/destroy', [RolePermissionController::class, 'destroy'])->name('rolePermission.destroy');


<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AirConController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\TechnicianController;
use App\Http\Controllers\CalendarController;
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
Route::get('order/requested', [OrderController::class, 'orderRequested'])->name('order.requested');
Route::get('order/assigned', [OrderController::class, 'orderAssigned'])->name('order.assigned');
Route::get('order/completed', [OrderController::class, 'orderCompleted'])->name('order.completed');
Route::get('order/{order}/actions', [OrderController::class, 'actions'])->name('order.actions');

Route::resource('order', OrderController::class);

/* Aircon */
Route::get('/aircon/{aircon}/order{order}/', [AirConController::class, 'show'])->name('aircon.show');
Route::post('/aircon/order/{order}', [AirConController::class, 'store'])->name('aircon.store');
Route::delete('/aircon/delete/{aircon}/order{order}', [AirConController::class, 'destroy'])->name('aircon.destroy');
Route::resource('aircon', AirConController::class)->except(['store', 'show', 'destroy']);

/* Job */
Route::post('/job/{order}/order', [JobController::class, 'store'])->name('job.store');
Route::resource('job', JobController::class)->except(['store']);

/* Role & Permission */
Route::get('role-permission', [RolePermissionController::class, 'index'])->name('rolePermission.index');
Route::patch('role-permission/{user}/edit', [RolePermissionController::class, 'update'])->name('rolePermission.update');
Route::delete('role-permission/{user}/destroy', [RolePermissionController::class, 'destroy'])->name('rolePermission.destroy');

/* Technician */
Route::resource('technician', TechnicianController::class);

/* Calendar */
Route::resource('calendar', CalendarController::class);


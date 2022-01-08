<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AirConController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\NoteController;
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
//complete this part
//complete this part

/* First page */
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

/* Dashboards */
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/* Order */
Route::get('order/{order}/actions', [OrderController::class, 'actions'])->name('order.actions');
Route::resource('order', OrderController::class);

/* Aircon */
Route::get('/aircon/{aircon}/order{order}/', [AirConController::class, 'show'])->name('aircon.show');
Route::get('/airconall/order{order}/', [AirConController::class, 'showAll'])->name('aircon.showAll');
Route::post('/aircon/order/{order}', [AirConController::class, 'store'])->name('aircon.store');
Route::delete('/aircon/delete/{aircon}/order{order}', [AirConController::class, 'destroy'])->name('aircon.destroy');
Route::resource('aircon', AirConController::class)->except(['store', 'show', 'destroy']);

/* Job */
Route::post('/job/{order}/order', [JobController::class, 'store'])->name('job.store');
Route::resource('job', JobController::class)->except(['store']);

/* User */
Route::patch('user/{user}/profile/edit', [UserController::class, 'updateProfile'])->name('user.updateProfile');
Route::patch('user/{user}/role/edit', [UserController::class, 'updateRole'])->name('user.updateRole');
Route::resource('user', UserController::class);


/* Calendar */
Route::resource('calendar', CalendarController::class);

/* Pages */
Route::get('/pages/user/admins', [PagesController::class, 'admins'])->name('pages.admins');
Route::get('/pages/user/technicians', [PagesController::class, 'technicians'])->name('pages.technicians');
Route::get('/pages/user/users', [PagesController::class, 'users'])->name('pages.users');
Route::get('/pages/order/requested', [PagesController::class, 'orderRequested'])->name('pages.orderRequested');
Route::get('/pages/order/assigned', [PagesController::class, 'orderAssigned'])->name('pages.orderAssigned');
Route::get('/pages/order/completed', [PagesController::class, 'orderCompleted'])->name('pages.orderCompleted');


Route::get('/pages/order/search-requested-jobs', [PagesController::class, 'searchRequestedJobs']);
Route::get('/pages/order/search-request-history', [PagesController::class, 'searchRequesteHistory']);

/* Admin Extra note */
Route::post('/note/order/{order}', [NoteController::class, 'store'])->name('note.store');
Route::resource('note', NoteController::class)->except(['store']);
Route::get('/admin/role-permission-search', [UserController::class, 'SearchUser']);

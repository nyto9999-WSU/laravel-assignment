<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AirConController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
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
Route::get('order/{order}/job/{job?}/actions', [OrderController::class, 'actions'])->name('order.actions');
Route::get('order/{order}/job/{job}/edit', [OrderController::class, 'edit'])->name('order.edit');
Route::resource('order', OrderController::class)->except(['edit']);



// print order route
Route::get('/print-order/{id?}', [OrderController::class, 'printOrder'])->name('order.printOrder');




/* Aircon */
Route::get('/aircon/{id}/order{order}', [AirConController::class, 'show'])->name('aircon.show');
Route::get('/airconall/order{order}/', [AirConController::class, 'showAll'])->name('aircon.showAll');
Route::post('/aircon/order/{order}', [AirConController::class, 'store'])->name('aircon.store');
Route::delete('/aircon/delete/{aircon}/order{order}', [AirConController::class, 'destroy'])->name('aircon.destroy');
Route::resource('aircon', AirConController::class)->except(['store', 'show', 'destroy']);

/* Job */
Route::post('/job/{job}/order/{order}', [JobController::class, 'store'])->name('job.store');
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
Route::get('/pages/login-history', [PagesController::class, 'loginHistory'])->name('pages.loginHistory');
Route::get('/pages/login-history/search', [PagesController::class, 'loginSearch'])->name('pages.loginSearch');

// search  route for all 3 jobs for admin
Route::get('/pages/order/search-requested-jobs', [PagesController::class, 'searchRequestedJobs']);

// search route for requested history for user
Route::get('/pages/order/search-request-history', [PagesController::class, 'searchRequesteHistory']);


/* Admin Extra note */
Route::post('/note/order/{order}', [NoteController::class, 'store'])->name('note.store');
Route::post('/note/ajax', [NoteController::class, 'noteAjax'])->name('note.ajax');
Route::resource('note', NoteController::class)->except(['store']);

// search route for roles and permission on the admin side
Route::get('/admin/role-permission-search', [UserController::class, 'SearchUser']);

/* login history */

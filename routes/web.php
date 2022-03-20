<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\LoginController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [LoginController::class, 'login'])->name('login')->middleware('guest');

Route::post('login/singin', [LoginController::class, 'singIn'])->name('login/singin');
Route::post('login/singout', [LoginController::class, 'logOut'])->name('login/singout');

Route::get('appointment', [AppointmentController::class, 'viewAppointment'])->name('appointment')->middleware('auth');

Route::post('appointment/create', [AppointmentController::class, 'create'])->name('appointment/create');
Route::post('appointment/searchByDate', [AppointmentController::class, 'searchByDate'])->name('appointment/searchByDate');
Route::post('appointment/modalUpdate', [AppointmentController::class, 'modalUpdate'])->name('appointment/modalUpdate');
Route::put('appointment/update', [AppointmentController::class, 'update'])->name('appointment/update');


Route::get('calendar', [CalendarController::class, 'view'])->name('calendar');
Route::post('calendar/events', [CalendarController::class, 'events'])->name('calendar/events');

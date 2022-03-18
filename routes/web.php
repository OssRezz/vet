<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\LoginController;
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

Route::get('/', [LoginController::class, 'login'])->name('login');

Route::get('appointment', [AppointmentController::class, 'viewAppointment'])->name('appointment');

Route::post('appointment/create', [AppointmentController::class, 'create'])->name('appointment/create');
Route::post('appointment/searchByDate', [AppointmentController::class, 'searchByDate'])->name('appointment/searchByDate');

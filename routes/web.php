<?php

use App\Http\Controllers\Admin\BusController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::group(['middleware' => 'auth:web'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Auth::routes();

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('searchbus',[BusController::class, 'searchbus'])->name('searchbus');
    Route::post('buslist',[BusController::class,'buslist'])->name('buslist');
    Route::post('selectcheck',[BusController::class,'selectcheck'])->name('selectcheck');
    Route::post('booking',[BusController::class,'booking'])->name('booking');
    Route::get('payment',[BusController::class, 'payment'])->name('payment');
    Route::post('stripe',[BusController::class, 'stripe'])->name('stripe');
    Route::get('ticket', [BusController::class, 'ticket'])->name('ticket');
    Route::get('generatepdf/{id}', [BusController::class, 'generatepdf'])->name('generatepdf');
// });
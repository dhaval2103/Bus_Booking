<?php

use App\Http\Controllers\Admin\BusController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use Illuminate\Auth\Events\Login;
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

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Auth::routes();

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('searchbus', [BusController::class, 'searchbus'])->name('searchbus');
    Route::post('buslist', [BusController::class,'buslist'])->name('buslist');
    Route::post('selectcheck', [BusController::class,'selectcheck'])->name('selectcheck');
    Route::post('booking', [BusController::class,'booking'])->name('booking');
    Route::post('busRoute', [BusController::class, 'busRoute'])->name('busRoute');
    Route::get('payment', [BusController::class, 'payment'])->name('payment');
    Route::post('stripe', [BusController::class, 'stripe'])->name('stripe');
    Route::get('ticketlist', [BusController::class, 'ticketlist'])->name('ticketlist');
    Route::get('ticket/{id}', [BusController::class, 'ticket'])->name('ticket');
    Route::get('generatepdf/{id}', [BusController::class, 'generatepdf'])->name('generatepdf');


    Route::get('auth/google', [LoginController::class, 'redirectToGoogle']);
    Route::get('auth/google/callback',[LoginController::class,'handleGoogleCallback']);

    Route::get('auth/github', [LoginController::class, 'gitRedirect']);
    Route::get('auth/github/callback', [LoginController::class, 'gitCallback']);

    Route::get('auth/facebook', [LoginController::class, 'redirectToFB']);
    Route::get('callback/facebook', [LoginController::class, 'handleCallback']);
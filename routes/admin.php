<?php

use App\DataTables\BusDatatable;
use App\Http\Controllers\Admin\BusController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Auth'], function () {
    Route::get('/', [LoginController::class, 'loginpage'])->name('logins');
    Route::post('login', [LoginController::class, 'login'])->name('login');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});

Route::group(['middleware' => 'auth:admin'], function () {
    Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
    });

    Route::get('addbus', [BusController::class, 'addbus'])->name('addbus');
    Route::post('insertbus',[BusController::class,'insertbus'])->name('insertbus');
    Route::get('showbus',[BusController::class,'showbus'])->name('showbus');
    Route::get('editbus/{id}',[BusController::class,'editbus'])->name('editbus');
    Route::post('updatebus',[BusController::class,'updatebus'])->name('updatebus');
    Route::get('deletebus/{id}',[BusController::class,'deletebus'])->name('deletebus');
});
?>
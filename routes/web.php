<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\KonversiController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/',[AuthController::class,'login'])->name('login');

Route::post('/',[AuthController::class,'loginProcess'])->name('loginProcess');

Route::get('logout',[AuthController::class,'logout'])->name('logout');

Route::middleware('checkLogin')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('users', [UserController::class, 'index'])->name('users');
    Route::get('users/create', [UserController::class, 'create'])->name('usersCreate');
    Route::post('users/store', [UserController::class, 'store'])->name('usersStore');
    Route::get('users/update/{id}', [UserController::class, 'update'])->name('usersUpdate');
    Route::post('users/update/{id}', [UserController::class, 'update2'])->name('usersUpdate2');

    Route::get('pengajuan', [PengajuanController::class, 'index'])->name('pengajuan');
    
    Route::get('konversi', [KonversiController::class, 'index'])->name('konversi');
});
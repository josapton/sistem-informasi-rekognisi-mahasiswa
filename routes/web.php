<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KegiatanController;
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
    Route::get('users/admin', [UserController::class, 'admin'])->name('usersAdmin');
    Route::get('users/kaprodi', [UserController::class, 'kaprodi'])->name('usersKaprodi');
    Route::get('users/mahasiswa', [UserController::class, 'mahasiswa'])->name('usersMahasiswa');
    Route::get('users/create', [UserController::class, 'create'])->name('usersCreate');
    Route::post('users/store', [UserController::class, 'store'])->name('usersStore');
    Route::get('users/update/{id}', [UserController::class, 'update'])->name('usersUpdate');
    Route::post('users/update/{id}', [UserController::class, 'update2'])->name('usersUpdate2');
    Route::get('users/updateAdmin/{username}', [UserController::class, 'updateAdmin'])->name('usersUpdateAdmin');
    Route::post('users/updateAdmin/{username}', [UserController::class, 'updateAdmin2'])->name('usersUpdateAdmin2');
    Route::get('users/updateKaprodi/{username}', [UserController::class, 'updateKaprodi'])->name('usersUpdateKaprodi');
    Route::post('users/updateKaprodi/{username}', [UserController::class, 'updateKaprodi2'])->name('usersUpdateKaprodi2');
    Route::get('users/updateMahasiswa/{username}', [UserController::class, 'updateMahasiswa'])->name('usersUpdateMahasiswa');
    Route::post('users/updateMahasiswa/{username}', [UserController::class, 'updateMahasiswa2'])->name('usersUpdateMahasiswa2');
    Route::delete('users/destroy/{id}', [UserController::class, 'destroy'])->name('usersDestroy');
    Route::get('users/excel', [UserController::class, 'excel'])->name('usersExcel');
    Route::get('users/pdf', [UserController::class, 'pdf'])->name('usersPdf');

    Route::get('kegiatan', [KegiatanController::class, 'index'])->name('kegiatan');

    Route::get('pengajuan', [PengajuanController::class, 'index'])->name('pengajuan');
    
    Route::get('konversi', [KonversiController::class, 'index'])->name('konversi');
});
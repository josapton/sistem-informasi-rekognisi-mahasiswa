<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\KonversiController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/',[AuthController::class,'login'])->name('login');

Route::post('/',[AuthController::class,'loginProcess'])->name('loginProcess');

Route::get('logout',[AuthController::class,'logout'])->name('logout');

Route::middleware('checkLogin')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // User Management
    Route::get('users/updateMahasiswa/{username}', [UserController::class, 'updateMahasiswa'])->name('usersUpdateMahasiswa');
    Route::post('users/updateMahasiswa/{username}', [UserController::class, 'updateMahasiswa2'])->name('usersUpdateMahasiswa2');
    // Kegiatan Management
    Route::get('kegiatan', [KegiatanController::class, 'index'])->name('kegiatan');
    Route::get('kegiatan/detail/{id}', [KegiatanController::class, 'detail'])->name('kegiatanDetail');
    Route::get('kegiatan/pengajuan', [KegiatanController::class, 'pengajuan'])->name('pengajuanKegiatan');
    Route::patch('kegiatan/pengajuan/{mahasiswa}/{kegiatan}', [KegiatanController::class, 'updateStatus'])->name('pengajuanKegiatanUpdate');
    // Konversi Management
    Route::get('konversi/kegiatan', [KonversiController::class, 'index'])->name('konversiKegiatan');
    Route::patch('konversi/kegiatan/{konversi}', [KonversiController::class, 'validasiPengajuan'])->name('validasiPengajuanKonversi');

    Route::middleware(['checkRole:Admin,Kaprodi'])->group(function () {
        // User Management
        Route::get('users/mahasiswa', [UserController::class, 'mahasiswa'])->name('usersMahasiswa');
        Route::get('users/updateKaprodi/{username}', [UserController::class, 'updateKaprodi'])->name('usersUpdateKaprodi');
        Route::post('users/updateKaprodi/{username}', [UserController::class, 'updateKaprodi2'])->name('usersUpdateKaprodi2');
        // Kegiatan Management
        Route::get('kegiatan/create', [KegiatanController::class, 'create'])->name('kegiatanCreate');
        Route::post('kegiatan/store', [KegiatanController::class, 'store'])->name('kegiatanStore');
        Route::get('kegiatan/edit/{id}', [KegiatanController::class, 'edit'])->name('kegiatanEdit');
        Route::post('kegiatan/update/{id}', [KegiatanController::class, 'update'])->name('kegiatanUpdate');
        Route::delete('kegiatan/destroy/{id}', [KegiatanController::class, 'destroy'])->name('kegiatanDestroy');
        // Konversi Management
        Route::get('konversi/kegiatan/riwayat', [KonversiController::class, 'historyAdmin'])->name('riwayatKonversiKegiatan');

        Route::middleware('checkRole:Admin')->group(function () {
            // User Management
            Route::get('users', [UserController::class, 'index'])->name('users');
            Route::get('users/admin', [UserController::class, 'admin'])->name('usersAdmin');
            Route::get('users/kaprodi', [UserController::class, 'kaprodi'])->name('usersKaprodi');
            Route::get('users/create', [UserController::class, 'create'])->name('usersCreate');
            Route::post('users/store', [UserController::class, 'store'])->name('usersStore');
            Route::get('users/update/{id}', [UserController::class, 'update'])->name('usersUpdate');
            Route::post('users/update/{id}', [UserController::class, 'update2'])->name('usersUpdate2');
            Route::get('users/updateAdmin/{username}', [UserController::class, 'updateAdmin'])->name('usersUpdateAdmin');
            Route::post('users/updateAdmin/{username}', [UserController::class, 'updateAdmin2'])->name('usersUpdateAdmin2');
            
            Route::delete('users/destroy/{id}', [UserController::class, 'destroy'])->name('usersDestroy');
            Route::get('users/excel', [UserController::class, 'excel'])->name('usersExcel');
            Route::get('users/pdf', [UserController::class, 'pdf'])->name('usersPdf');
        });
    });
});
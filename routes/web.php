<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\NFCController;

Route::get('/', [DashboardController::class,'index']);

Route::resource(
    'mahasiswa',
    MahasiswaController::class
);

Route::get(
    '/absensi',
    [AbsensiController::class,'index']
);

Route::get(
    '/scan',
    [NFCController::class,'index']
);

Route::post(
    '/scan',
    [NFCController::class,'scan']
);

Route::get(
    '/register-nfc',
    [NFCController::class,'register']
);

Route::post(
    '/register-nfc',
    [NFCController::class,'storeRegister']
);

Route::get(
    '/stream-absensi',
    [AbsensiController::class,'stream']
);
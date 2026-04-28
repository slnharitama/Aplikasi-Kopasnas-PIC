<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\AnggotaController;
use App\Http\Controllers\Api\CalonAnggotaController;
use App\Http\Controllers\Api\VotingController;
use App\Http\Controllers\Api\OpsiVotingController;
use App\Http\Controllers\Api\VoteController;
use App\Http\Controllers\Api\AuthController;

# =========================
# 🔓 TANPA LOGIN
# =========================

// biar ga error "Route login not defined"
Route::any('/login', function () {
    return response()->json([
        'message' => 'Silakan login terlebih dahulu'
    ], 401);
})->name('login');

// login
Route::post('/login-admin', [AuthController::class, 'loginAdmin']);
Route::post('/login-anggota', [AuthController::class, 'loginAnggota']);

// 🔥 buat akun admin (PENTING)
Route::post('/admin', [AdminController::class, 'store']);

// anggota bisa lihat voting & vote
Route::get('/voting', [VotingController::class, 'index']);
Route::get('/voting/{id}', [VotingController::class, 'show']);
Route::post('/vote', [VoteController::class, 'store']);



# =========================
# 🔐 KHUSUS ADMIN (LOGIN)
# =========================
Route::middleware('auth:sanctum')->group(function () {

    // logout
    Route::post('/logout', [AuthController::class, 'logout']);

    // admin (kecuali create)
    Route::apiResource('admin', AdminController::class)->except(['store']);

    // anggota
    Route::apiResource('anggota', AnggotaController::class);
    Route::apiResource('calon-anggota', CalonAnggotaController::class);

    // voting
    Route::apiResource('voting', VotingController::class);

    // opsi voting
    Route::apiResource('opsi-voting', OpsiVotingController::class);

    // buka hasil
    Route::post('/voting/{id}/buka-hasil', [VotingController::class, 'bukaHasil']);

    // lihat hasil
    Route::get('/voting/{id}/result', [VotingController::class, 'showResult']);
});

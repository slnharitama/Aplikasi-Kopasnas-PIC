<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\AnggotaController;
use App\Http\Controllers\Api\CalonAnggotaController;
use App\Http\Controllers\Api\VotingController;
use App\Http\Controllers\Api\OpsiVotingController;
use App\Http\Controllers\Api\VoteController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
// 👤 ADMIN
Route::apiResource('admin', AdminController::class);

// 👥 ANGGOTA
Route::apiResource('anggota', AnggotaController::class);

// 🧾 CALON ANGGOTA
Route::apiResource('calon-anggota', CalonAnggotaController::class);

// 🗳️ VOTING
Route::apiResource('voting', VotingController::class);

// 🔘 OPSI VOTING
Route::apiResource('opsi-voting', OpsiVotingController::class);

// 🗳️ VOTE (custom karena bukan full CRUD)
Route::post('vote', [VoteController::class, 'store']);

// 🔓 BUKA HASIL VOTING
Route::post('voting/{id}/buka-hasil', [VotingController::class, 'bukaHasil']);

// 📊 LIHAT HASIL VOTING
Route::get('voting/{id}/result', [VotingController::class, 'showResult']);

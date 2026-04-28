<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // 🔐 LOGIN ADMIN
    public function loginAdmin(Request $request)
    {
        $admin = Admin::where('username', $request->username)->first();

        // cek username
        if (!$admin) {


            return response()->json([
                'success' => false,
                'message' => 'Username tidak ditemukan'
            ], 404);
        }

        // cek password
        if (!Hash::check($request->password, $admin->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Password salah'
            ], 401);
        }

        $token = $admin->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login admin berhasil',
            'token' => $token,
            'data' => $admin
        ], 200);
    }


    // 👥 LOGIN ANGGOTA
    public function loginAnggota(Request $request)
    {
        $anggota = Anggota::where('nama', $request->nama)
            ->where('kelas', $request->kelas)
            ->first();

        if (!$anggota) {
            return response()->json([
                'success' => false,
                'message' => 'Data anggota tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Login anggota berhasil',
            'data' => $anggota
        ], 200);
    }

    public function logout(Request $request)
{
    $request->user()->currentAccessToken()->delete();

    return response()->json([
        'success' => true,
        'message' => 'Logout berhasil'
    ]);
}
}

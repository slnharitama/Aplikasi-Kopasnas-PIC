<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index()
    {
        $data = Admin::all();
        return response()->json(['success' => true, 'data' => $data], 200);
    }

        public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:admins,username',
            'password' => 'required|string|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $admin = Admin::create([
            'username' => $request->username,
            'password' => bcrypt($request->password) // 🔥 wajib
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Admin berhasil dibuat',
            'data' => $admin
        ], 201);
    }


    public function show(string $id)
    {
        $data = Admin::find($id);
        if (!$data) return response()->json(['message' => 'Data tidak ditemukan'], 404);

        return response()->json(['success' => true, 'data' => $data], 200);
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:admins,username,' . $id,
            'password' => 'nullable|string|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = Admin::find($id);
        if (!$data) return response()->json(['message' => 'Data tidak ditemukan'], 404);

        $updateData = [
            'username' => $request->username,
        ];

        if ($request->password) {
            $updateData['password'] = bcrypt($request->password);
        }

        $data->update($updateData);

        return response()->json(['success' => true, 'data' => $data], 200);
    }

    public function destroy(string $id)
    {
        $data = Admin::find($id);
        if (!$data) return response()->json(['message' => 'Data tidak ditemukan'], 404);

        $data->delete();
        return response()->json(['success' => true, 'message' => 'Berhasil dihapus'], 200);
    }
}

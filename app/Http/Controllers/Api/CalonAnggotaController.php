<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CalonAnggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CalonAnggotaController extends Controller
{
    public function index()
    {
        $data = CalonAnggota::all();
        return response()->json(['success' => true, 'data' => $data], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'kelas' => 'required|string|max:50'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = CalonAnggota::create($request->all());
        return response()->json(['success' => true, 'data' => $data], 201);
    }

    public function show(string $id)
    {
        $data = CalonAnggota::find($id);
        if (!$data) return response()->json(['message' => 'Data tidak ditemukan'], 404);

        return response()->json(['success' => true, 'data' => $data], 200);
    }

    public function destroy(string $id)
    {
        $data = CalonAnggota::find($id);
        if (!$data) return response()->json(['message' => 'Data tidak ditemukan'], 404);

        $data->delete();
        return response()->json(['success' => true, 'message' => 'Berhasil dihapus'], 200);
    }
}

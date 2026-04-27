<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vote;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function store(Request $request)
    {
        $cek = Vote::where('anggota_id', $request->anggota_id)->exists();

        if ($cek) {
            return response()->json(['message' => 'Sudah voting'], 400);
        }

        $data = Vote::create($request->all());

        return response()->json(['success' => true, 'data' => $data], 201);
    }
}

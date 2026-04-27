<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Voting;
use App\Models\OpsiVoting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VotingController extends Controller
{
    public function index()
    {
        $data = Voting::with('opsi')->get();
        return response()->json(['success' => true, 'data' => $data], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'opsi' => 'required|array|min:2|max:3'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $voting = Voting::create([
            'judul' => $request->judul,
            'status' => 'close',
            'show_result' => false
        ]);

        foreach ($request->opsi as $opsi) {
            OpsiVoting::create([
                'voting_id' => $voting->id,
                'nama_opsi' => $opsi
            ]);
        }

        return response()->json(['success' => true, 'data' => $voting], 201);
    }

    public function show(string $id)
    {
        $data = Voting::with('opsi')->find($id);
        if (!$data) return response()->json(['message' => 'Data tidak ditemukan'], 404);

        return response()->json(['success' => true, 'data' => $data], 200);
    }

    public function bukaHasil(string $id)
    {
        $voting = Voting::find($id);
        if (!$voting) return response()->json(['message' => 'Data tidak ditemukan'], 404);

        $voting->update(['show_result' => true]);

        return response()->json(['success' => true, 'message' => 'Hasil dibuka'], 200);
    }
}

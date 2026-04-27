<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OpsiVoting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OpsiVotingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = OpsiVoting::all();
        return response()->json(['success' => true, 'data' => $data], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'voting_id' => 'required|exists:votings,id',
            'nama_opsi' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = OpsiVoting::create($request->all());
        return response()->json(['success' => true, 'data' => $data], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = OpsiVoting::find($id);
        if (!$data) return response()->json(['message' => 'Data tidak ditemukan'], 404);

        return response()->json(['success' => true, 'data' => $data], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_opsi' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = OpsiVoting::find($id);
        if (!$data) return response()->json(['message' => 'Data tidak ditemukan'], 404);

        $data->update($request->all());
        return response()->json(['success' => true, 'data' => $data], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = OpsiVoting::find($id);
        if (!$data) return response()->json(['message' => 'Data tidak ditemukan'], 404);

        $data->delete();
        return response()->json(['success' => true, 'message' => 'Berhasil dihapus'], 200);
    }
}

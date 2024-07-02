<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\IsiKehadiran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiIsiKehadiranController extends Controller
{
    // Get all attendance entries
    public function index()
    {
        $entries = IsiKehadiran::all();
        return response()->json($entries, 200);
    }

    // Get a single attendance entry by ID
    public function show($id)
    {
        $entry = IsiKehadiran::find($id);

        if (is_null($entry)) {
            return response()->json(['message' => 'Isi kehadiran tidak ditemukan'], 404);
        }

        return response()->json($entry, 200);
    }

    // Create a new attendance entry
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kehadiran_id' => 'required|exists:kehadiran,id',
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:hadir,tidak hadir'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $entry = IsiKehadiran::create([
            'kehadiran_id' => $request->kehadiran_id,
            'user_id' => $request->user_id,
            'status' => $request->status
        ]);

        return response()->json(['message' => 'Isi kehadiran berhasil dibuat', 'data' => $entry], 201);
    }

    // Update an existing attendance entry
    public function update(Request $request, $id)
    {
        $entry = IsiKehadiran::find($id);

        if (is_null($entry)) {
            return response()->json(['message' => 'Isi kehadiran tidak ditemukan'], 404);
        }

        $validator = Validator::make($request->all(), [
            'kehadiran_id' => 'sometimes|required|exists:kehadiran,id',
            'user_id' => 'sometimes|required|exists:users,id',
            'status' => 'sometimes|required|in:hadir,tidak hadir'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        if ($request->has('kehadiran_id')) {
            $entry->kehadiran_id = $request->kehadiran_id;
        }

        if ($request->has('user_id')) {
            $entry->user_id = $request->user_id;
        }

        if ($request->has('status')) {
            $entry->status = $request->status;
        }

        $entry->save();

        return response()->json(['message' => 'Isi kehadiran berhasil diupdate', 'data' => $entry], 200);
    }

    // Delete an attendance entry
    public function destroy($id)
    {
        $entry = IsiKehadiran::find($id);

        if (is_null($entry)) {
            return response()->json(['message' => 'Isi kehadiran tidak ditemukan'], 404);
        }

        $entry->delete();

        return response()->json(['message' => 'Isi kehadiran berhasil dihapus'], 200);
    }
}

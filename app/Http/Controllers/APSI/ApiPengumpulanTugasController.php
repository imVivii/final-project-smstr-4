<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PengumpulanTugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiPengumpulanTugasController extends Controller
{
    // Get all task submissions
    public function index()
    {
        $submissions = PengumpulanTugas::all();
        return response()->json($submissions, 200);
    }

    // Get a single task submission by ID
    public function show($id)
    {
        $submission = PengumpulanTugas::find($id);

        if (is_null($submission)) {
            return response()->json(['message' => 'Pengumpulan tugas tidak ditemukan'], 404);
        }

        return response()->json($submission, 200);
    }

    // Create a new task submission
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tugas_id' => 'required|exists:tugas,id',
            'user_id' => 'required|exists:users,id',
            'file_path' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $submission = PengumpulanTugas::create([
            'tugas_id' => $request->tugas_id,
            'user_id' => $request->user_id,
            'file_path' => $request->file_path
        ]);

        return response()->json(['message' => 'Pengumpulan tugas berhasil dibuat', 'data' => $submission], 201);
    }

    // Update an existing task submission
    public function update(Request $request, $id)
    {
        $submission = PengumpulanTugas::find($id);

        if (is_null($submission)) {
            return response()->json(['message' => 'Pengumpulan tugas tidak ditemukan'], 404);
        }

        $validator = Validator::make($request->all(), [
            'tugas_id' => 'sometimes|required|exists:tugas,id',
            'user_id' => 'sometimes|required|exists:users,id',
            'file_path' => 'sometimes|required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        if ($request->has('tugas_id')) {
            $submission->tugas_id = $request->tugas_id;
        }

        if ($request->has('user_id')) {
            $submission->user_id = $request->user_id;
        }

        if ($request->has('file_path')) {
            $submission->file_path = $request->file_path;
        }

        $submission->save();

        return response()->json(['message' => 'Pengumpulan tugas berhasil diupdate', 'data' => $submission], 200);
    }

    // Delete a task submission
    public function destroy($id)
    {
        $submission = PengumpulanTugas::find($id);

        if (is_null($submission)) {
            return response()->json(['message' => 'Pengumpulan tugas tidak ditemukan'], 404);
        }

        $submission->delete();

        return response()->json(['message' => 'Pengumpulan tugas berhasil dihapus'], 200);
    }
}

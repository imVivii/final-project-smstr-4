<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiPenilaianController extends Controller
{
    // Get all evaluations
    public function index()
    {
        $evaluations = Penilaian::all();
        return response()->json($evaluations, 200);
    }

    // Get a single evaluation by ID
    public function show($id)
    {
        $evaluation = Penilaian::find($id);

        if (is_null($evaluation)) {
            return response()->json(['message' => 'Penilaian tidak ditemukan'], 404);
        }

        return response()->json($evaluation, 200);
    }

    // Create a new evaluation
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pengumpulan_tugas_id' => 'required|exists:pengumpulan_tugas,id',
            'guru_id' => 'required|exists:users,id',
            'nilai' => 'required|integer|min:0|max:100',
            'komentar' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $evaluation = Penilaian::create([
            'pengumpulan_tugas_id' => $request->pengumpulan_tugas_id,
            'guru_id' => $request->guru_id,
            'nilai' => $request->nilai,
            'komentar' => $request->komentar
        ]);

        return response()->json(['message' => 'Penilaian berhasil dibuat', 'data' => $evaluation], 201);
    }

    // Update an existing evaluation
    public function update(Request $request, $id)
    {
        $evaluation = Penilaian::find($id);

        if (is_null($evaluation)) {
            return response()->json(['message' => 'Penilaian tidak ditemukan'], 404);
        }

        $validator = Validator::make($request->all(), [
            'pengumpulan_tugas_id' => 'sometimes|required|exists:pengumpulan_tugas,id',
            'guru_id' => 'sometimes|required|exists:users,id',
            'nilai' => 'sometimes|required|integer|min:0|max:100',
            'komentar' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        if ($request->has('pengumpulan_tugas_id')) {
            $evaluation->pengumpulan_tugas_id = $request->pengumpulan_tugas_id;
        }

        if ($request->has('guru_id')) {
            $evaluation->guru_id = $request->guru_id;
        }

        if ($request->has('nilai')) {
            $evaluation->nilai = $request->nilai;
        }

        if ($request->has('komentar')) {
            $evaluation->komentar = $request->komentar;
        }

        $evaluation->save();

        return response()->json(['message' => 'Penilaian berhasil diupdate', 'data' => $evaluation], 200);
    }

    // Delete an evaluation
    public function destroy($id)
    {
        $evaluation = Penilaian::find($id);

        if (is_null($evaluation)) {
            return response()->json(['message' => 'Penilaian tidak ditemukan'], 404);
        }

        $evaluation->delete();

        return response()->json(['message' => 'Penilaian berhasil dihapus'], 200);
    }
}

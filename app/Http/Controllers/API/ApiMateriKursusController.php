<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\MateriKursus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiMateriKursusController extends Controller
{
    // Get all course materials
    public function index()
    {
        $materis = MateriKursus::all();
        return response()->json($materis, 200);
    }

    // Get a single course material by ID or name
    public function show($identifier)
    {
        $materi = is_numeric($identifier) ? MateriKursus::find($identifier) : MateriKursus::where('nama', $identifier)->first();

        if (is_null($materi)) {
            return response()->json(['message' => 'Materi kursus tidak ditemukan'], 404);
        }

        return response()->json($materi, 200);
    }

    // Create a new course material
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'materi' => 'nullable|string',
            'id_kursus' => 'required|exists:kursus,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $materi = MateriKursus::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'materi' => $request->materi,
            'id_kursus' => $request->id_kursus
        ]);

        return response()->json(['message' => 'Materi kursus berhasil dibuat', 'data' => $materi], 201);
    }

    // Update an existing course material
    public function update(Request $request, $id)
    {
        $materi = MateriKursus::find($id);

        if (is_null($materi)) {
            return response()->json(['message' => 'Materi kursus tidak ditemukan'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama' => 'sometimes|required|string|max:255',
            'deskripsi' => 'nullable|string',
            'materi' => 'nullable|string',
            'id_kursus' => 'sometimes|required|exists:kursus,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        if ($request->has('nama')) {
            $materi->nama = $request->nama;
        }

        if ($request->has('deskripsi')) {
            $materi->deskripsi = $request->deskripsi;
        }

        if ($request->has('materi')) {
            $materi->materi = $request->materi;
        }

        if ($request->has('id_kursus')) {
            $materi->id_kursus = $request->id_kursus;
        }

        $materi->save();

        return response()->json(['message' => 'Materi kursus berhasil diupdate', 'data' => $materi], 200);
    }

    // Delete a course material
    public function destroy($id)
    {
        $materi = MateriKursus::find($id);

        if (is_null($materi)) {
            return response()->json(['message' => 'Materi kursus tidak ditemukan'], 404);
        }

        $materi->delete();

        return response()->json(['message' => 'Materi kursus berhasil dihapus'], 200);
    }
}

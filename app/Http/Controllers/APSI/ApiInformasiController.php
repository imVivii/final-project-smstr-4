<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Informasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiInformasiController extends Controller
{
    // Get all information
    public function index()
    {
        $informasis = Informasi::all();
        return response()->json($informasis, 200);
    }

    // Get a single information by ID or name
    public function show($identifier)
    {
        $informasi = is_numeric($identifier) ? Informasi::find($identifier) : Informasi::where('nama', $identifier)->first();

        if (is_null($informasi)) {
            return response()->json(['message' => 'Informasi tidak ditemukan'], 404);
        }

        return response()->json($informasi, 200);
    }

    // Create a new information
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $informasi = Informasi::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'gambar' => $request->gambar
        ]);

        return response()->json(['message' => 'Informasi berhasil dibuat', 'data' => $informasi], 201);
    }

    // Update an existing information
    public function update(Request $request, $id)
    {
        $informasi = Informasi::find($id);

        if (is_null($informasi)) {
            return response()->json(['message' => 'Informasi tidak ditemukan'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama' => 'sometimes|required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        if ($request->has('nama')) {
            $informasi->nama = $request->nama;
        }

        if ($request->has('deskripsi')) {
            $informasi->deskripsi = $request->deskripsi;
        }

        if ($request->has('gambar')) {
            $informasi->gambar = $request->gambar;
        }

        $informasi->save();

        return response()->json(['message' => 'Informasi berhasil diupdate', 'data' => $informasi], 200);
    }

    // Delete an information
    public function destroy($id)
    {
        $informasi = Informasi::find($id);

        if (is_null($informasi)) {
            return response()->json(['message' => 'Informasi tidak ditemukan'], 404);
        }

        $informasi->delete();

        return response()->json(['message' => 'Informasi berhasil dihapus'], 200);
    }
}

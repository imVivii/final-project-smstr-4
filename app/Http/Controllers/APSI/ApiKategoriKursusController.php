<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\KategoriKursus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiKategoriKursusController extends Controller
{
    // Get all categories
    public function index()
    {
        $categories = KategoriKursus::all();
        return response()->json($categories, 200);
    }

    // Get a single category by ID or name
    public function show($identifier)
    {
        $category = is_numeric($identifier) ? KategoriKursus::find($identifier) : KategoriKursus::where('nama', $identifier)->first();

        if (is_null($category)) {
            return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
        }

        return response()->json($category, 200);
    }

    // Create a new category
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $category = KategoriKursus::create([
            'nama' => $request->nama
        ]);

        return response()->json(['message' => 'Kategori berhasil dibuat', 'data' => $category], 201);
    }

    // Update an existing category
    public function update(Request $request, $id)
    {
        $category = KategoriKursus::find($id);

        if (is_null($category)) {
            return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama' => 'sometimes|required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        if ($request->has('nama')) {
            $category->nama = $request->nama;
        }

        $category->save();

        return response()->json(['message' => 'Kategori berhasil diupdate', 'data' => $category], 200);
    }

    // Delete a category
    public function destroy($id)
    {
        $category = KategoriKursus::find($id);

        if (is_null($category)) {
            return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
        }

        $category->delete();

        return response()->json(['message' => 'Kategori berhasil dihapus'], 200);
    }
}

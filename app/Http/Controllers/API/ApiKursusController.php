<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Kursus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiKursusController extends Controller
{
    // Get all courses
    public function index()
    {
        $courses = Kursus::with('kategoriKursus')->get();
        return response()->json($courses, 200);
    }

    // Get a single course by ID or name
    public function show($identifier)
    {
        $course = is_numeric($identifier) ? Kursus::find($identifier) : Kursus::where('nama', 'like', '%' . $identifier . '%')->first();

        if (is_null($course)) {
            return response()->json(['message' => 'Kursus tidak ditemukan'], 404);
        }

        return response()->json($course, 200);
    }

    // Get a single course by name
    public function showByName($name)
    {
        $courses = Kursus::where('nama', 'like', '%' . $name . '%')->get();

        if ($courses->isEmpty()) {
            return response()->json(['message' => 'Kursus tidak ditemukan'], 404);
        }

        return response()->json($courses, 200);
    }

    // Create a new course
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|integer',
            'gambar' => 'nullable|string',
            'media' => 'nullable|string',
            'user_id' => 'nullable|exists:users,id',
            'kategori_kursus_id' => 'nullable|exists:kategori_kursus,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $course = Kursus::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'gambar' => $request->gambar,
            'media' => $request->media,
            'user_id' => $request->user_id,
            'kategori_kursus_id' => $request->kategori_kursus_id
        ]);

        return response()->json(['message' => 'Kursus berhasil dibuat', 'data' => $course], 201);
    }

    // Update an existing course
    public function update(Request $request, $id)
    {
        $course = Kursus::find($id);

        if (is_null($course)) {
            return response()->json(['message' => 'Kursus tidak ditemukan'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama' => 'sometimes|required|string|max:255',
            'deskripsi' => 'sometimes|required|string',
            'harga' => 'sometimes|required|integer',
            'gambar' => 'nullable|string',
            'media' => 'nullable|string',
            'user_id' => 'nullable|exists:users,id',
            'kategori_kursus_id' => 'nullable|exists:kategori_kursus,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        if ($request->has('nama')) {
            $course->nama = $request->nama;
        }

        if ($request->has('deskripsi')) {
            $course->deskripsi = $request->deskripsi;
        }

        if ($request->has('harga')) {
            $course->harga = $request->harga;
        }

        if ($request->has('gambar')) {
            $course->gambar = $request->gambar;
        }

        if ($request->has('media')) {
            $course->media = $request->media;
        }

        if ($request->has('user_id')) {
            $course->user_id = $request->user_id;
        }

        if ($request->has('kategori_kursus_id')) {
            $course->kategori_kursus_id = $request->kategori_kursus_id;
        }

        $course->save();

        return response()->json(['message' => 'Kursus berhasil diupdate', 'data' => $course], 200);
    }

    // Delete a course
    public function destroy($id)
    {
        $course = Kursus::find($id);

        if (is_null($course)) {
            return response()->json(['message' => 'Kursus tidak ditemukan'], 404);
        }

        $course->delete();

        return response()->json(['message' => 'Kursus berhasil dihapus'], 200);
    }


    public function guruHome()
    {

        $guru = Kursus::with('guru')->get();
        return response()->json($guru, 200);
    }
}

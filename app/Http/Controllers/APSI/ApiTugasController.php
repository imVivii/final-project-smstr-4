<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiTugasController extends Controller
{
    // Get all tasks
    public function index()
    {
        $tasks = Tugas::all();
        return response()->json($tasks, 200);
    }

    // Get a single task by ID
    public function show($id)
    {
        $task = Tugas::find($id);

        if (is_null($task)) {
            return response()->json(['message' => 'Tugas tidak ditemukan'], 404);
        }

        return response()->json($task, 200);
    }

    // Create a new task
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal_deadline' => 'required|date',
            'kursus_id' => 'required|exists:kursus,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $task = Tugas::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal_deadline' => $request->tanggal_deadline,
            'kursus_id' => $request->kursus_id
        ]);

        return response()->json(['message' => 'Tugas berhasil dibuat', 'data' => $task], 201);
    }

    // Update an existing task
    public function update(Request $request, $id)
    {
        $task = Tugas::find($id);

        if (is_null($task)) {
            return response()->json(['message' => 'Tugas tidak ditemukan'], 404);
        }

        $validator = Validator::make($request->all(), [
            'judul' => 'sometimes|required|string|max:255',
            'deskripsi' => 'sometimes|required|string',
            'tanggal_deadline' => 'sometimes|required|date',
            'kursus_id' => 'sometimes|required|exists:kursus,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        if ($request->has('judul')) {
            $task->judul = $request->judul;
        }

        if ($request->has('deskripsi')) {
            $task->deskripsi = $request->deskripsi;
        }

        if ($request->has('tanggal_deadline')) {
            $task->tanggal_deadline = $request->tanggal_deadline;
        }

        if ($request->has('kursus_id')) {
            $task->kursus_id = $request->kursus_id;
        }

        $task->save();

        return response()->json(['message' => 'Tugas berhasil diupdate', 'data' => $task], 200);
    }

    // Delete a task
    public function destroy($id)
    {
        $task = Tugas::find($id);

        if (is_null($task)) {
            return response()->json(['message' => 'Tugas tidak ditemukan'], 404);
        }

        $task->delete();

        return response()->json(['message' => 'Tugas berhasil dihapus'], 200);
    }
}

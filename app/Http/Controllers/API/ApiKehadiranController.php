<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Kehadiran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiKehadiranController extends Controller
{
    // Get all attendances
    public function index()
    {
        $attendances = Kehadiran::all();
        return response()->json($attendances, 200);
    }

    // Get a single attendance by ID
    public function show($id)
    {
        $attendance = Kehadiran::find($id);

        if (is_null($attendance)) {
            return response()->json(['message' => 'Kehadiran tidak ditemukan'], 404);
        }

        return response()->json($attendance, 200);
    }

    // Create a new attendance
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kursus_id' => 'required|exists:kursus,id',
            'tanggal' => 'required|date'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $attendance = Kehadiran::create([
            'kursus_id' => $request->kursus_id,
            'tanggal' => $request->tanggal
        ]);

        return response()->json(['message' => 'Kehadiran berhasil dibuat', 'data' => $attendance], 201);
    }

    // Update an existing attendance
    public function update(Request $request, $id)
    {
        $attendance = Kehadiran::find($id);

        if (is_null($attendance)) {
            return response()->json(['message' => 'Kehadiran tidak ditemukan'], 404);
        }

        $validator = Validator::make($request->all(), [
            'kursus_id' => 'sometimes|required|exists:kursus,id',
            'tanggal' => 'sometimes|required|date'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        if ($request->has('kursus_id')) {
            $attendance->kursus_id = $request->kursus_id;
        }

        if ($request->has('tanggal')) {
            $attendance->tanggal = $request->tanggal;
        }

        $attendance->save();

        return response()->json(['message' => 'Kehadiran berhasil diupdate', 'data' => $attendance], 200);
    }

    // Delete an attendance
    public function destroy($id)
    {
        $attendance = Kehadiran::find($id);

        if (is_null($attendance)) {
            return response()->json(['message' => 'Kehadiran tidak ditemukan'], 404);
        }

        $attendance->delete();

        return response()->json(['message' => 'Kehadiran berhasil dihapus'], 200);
    }
}
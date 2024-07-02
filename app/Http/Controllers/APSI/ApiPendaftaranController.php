<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiPendaftaranController extends Controller
{
    // Get all registrations
    public function index()
    {
        $registrations = Pendaftaran::all();
        return response()->json($registrations, 200);
    }

    // Get a single registration by ID
    public function show($id)
    {
        $registration = Pendaftaran::find($id);

        if (is_null($registration)) {
            return response()->json(['message' => 'Pendaftaran tidak ditemukan'], 404);
        }

        return response()->json($registration, 200);
    }

    // Create a new registration
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_user' => 'required|exists:users,id',
            'id_kursus' => 'required|exists:kursus,id',
            'status_pendaftaran' => 'required|in:menunggu pembayaran,sedang diperiksa,berhasil,gagal',
            'status_kursus' => 'required|in:Aktif,Belum Aktif'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $registration = Pendaftaran::create([
            'id_user' => $request->id_user,
            'id_kursus' => $request->id_kursus,
            'status_pendaftaran' => $request->status_pendaftaran,
            'status_kursus' => $request->status_kursus
        ]);

        return response()->json(['message' => 'Pendaftaran berhasil dibuat', 'data' => $registration], 201);
    }

    // Update an existing registration
    public function update(Request $request, $id)
    {
        $registration = Pendaftaran::find($id);

        if (is_null($registration)) {
            return response()->json(['message' => 'Pendaftaran tidak ditemukan'], 404);
        }

        $validator = Validator::make($request->all(), [
            'id_user' => 'sometimes|required|exists:users,id',
            'id_kursus' => 'sometimes|required|exists:kursus,id',
            'status_pendaftaran' => 'sometimes|required|in:menunggu pembayaran,sedang diperiksa,berhasil,gagal',
            'status_kursus' => 'sometimes|required|in:Aktif,Belum Aktif'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        if ($request->has('id_user')) {
            $registration->id_user = $request->id_user;
        }

        if ($request->has('id_kursus')) {
            $registration->id_kursus = $request->id_kursus;
        }

        if ($request->has('status_pendaftaran')) {
            $registration->status_pendaftaran = $request->status_pendaftaran;
        }

        if ($request->has('status_kursus')) {
            $registration->status_kursus = $request->status_kursus;
        }

        $registration->save();

        return response()->json(['message' => 'Pendaftaran berhasil diupdate', 'data' => $registration], 200);
    }

    // Delete a registration
    public function destroy($id)
    {
        $registration = Pendaftaran::find($id);

        if (is_null($registration)) {
            return response()->json(['message' => 'Pendaftaran tidak ditemukan'], 404);
        }

        $registration->delete();

        return response()->json(['message' => 'Pendaftaran berhasil dihapus'], 200);
    }
}

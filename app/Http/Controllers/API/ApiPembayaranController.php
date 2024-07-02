<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiPembayaranController extends Controller
{
    // Get all payments
    public function index()
    {
        $payments = Pembayaran::all();
        return response()->json($payments, 200);
    }

    // Get a single payment by ID
    public function show($id)
    {
        $payment = Pembayaran::find($id);

        if (is_null($payment)) {
            return response()->json(['message' => 'Pembayaran tidak ditemukan'], 404);
        }

        return response()->json($payment, 200);
    }

    // Create a new payment
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_user' => 'required|exists:users,id',
            'id_kursus' => 'required|exists:kursus,id',
            'jumlah_pembayaran' => 'required|integer',
            'bukti_pembayaran' => 'nullable|string',
            'status_pembayaran' => 'required|in:sedang diperiksa,berhasil,dikembalikan'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $payment = Pembayaran::create([
            'id_user' => $request->id_user,
            'id_kursus' => $request->id_kursus,
            'jumlah_pembayaran' => $request->jumlah_pembayaran,
            'bukti_pembayaran' => $request->bukti_pembayaran,
            'status_pembayaran' => $request->status_pembayaran
        ]);

        return response()->json(['message' => 'Pembayaran berhasil dibuat', 'data' => $payment], 201);
    }

    // Update an existing payment
    public function update(Request $request, $id)
    {
        $payment = Pembayaran::find($id);

        if (is_null($payment)) {
            return response()->json(['message' => 'Pembayaran tidak ditemukan'], 404);
        }

        $validator = Validator::make($request->all(), [
            'id_user' => 'sometimes|required|exists:users,id',
            'id_kursus' => 'sometimes|required|exists:kursus,id',
            'jumlah_pembayaran' => 'sometimes|required|integer',
            'bukti_pembayaran' => 'nullable|string',
            'status_pembayaran' => 'sometimes|required|in:sedang diperiksa,berhasil,dikembalikan'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        if ($request->has('id_user')) {
            $payment->id_user = $request->id_user;
        }

        if ($request->has('id_kursus')) {
            $payment->id_kursus = $request->id_kursus;
        }

        if ($request->has('jumlah_pembayaran')) {
            $payment->jumlah_pembayaran = $request->jumlah_pembayaran;
        }

        if ($request->has('bukti_pembayaran')) {
            $payment->bukti_pembayaran = $request->bukti_pembayaran;
        }

        if ($request->has('status_pembayaran')) {
            $payment->status_pembayaran = $request->status_pembayaran;
        }

        $payment->save();

        return response()->json(['message' => 'Pembayaran berhasil diupdate', 'data' => $payment], 200);
    }

    // Delete a payment
    public function destroy($id)
    {
        $payment = Pembayaran::find($id);

        if (is_null($payment)) {
            return response()->json(['message' => 'Pembayaran tidak ditemukan'], 404);
        }

        $payment->delete();

        return response()->json(['message' => 'Pembayaran berhasil dihapus'], 200);
    }
}

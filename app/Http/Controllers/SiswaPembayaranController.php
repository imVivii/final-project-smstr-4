<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\Pembayaran;
use App\Models\Kursus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SiswaPembayaranController extends Controller
{
    // Menampilkan daftar pembayaran
    public function index()
    {
        $userId = Auth::id();
        $pembayaran = Pembayaran::where('id_user', $userId)->get();

        // Mengambil ID kursus yang sudah dibayar atau sedang diperiksa
        $paidOrPendingKursusIds = $pembayaran->where('status_pembayaran', '!=', 'gagal')->pluck('id_kursus')->toArray();

        // Mengambil pendaftaran kursus yang belum dibayar atau gagal
        $pendaftaran = Pendaftaran::where('id_user', $userId)
            ->whereNotIn('id_kursus', $paidOrPendingKursusIds)
            ->get();

        return view('siswa.pembayaran.index', compact('pembayaran', 'pendaftaran'));
    }

    // Menampilkan form untuk membuat pembayaran baru
    public function create($kursus_id)
    {
        $userId = Auth::id();
        $existingPayment = Pembayaran::where('id_user', $userId)
            ->where('id_kursus', $kursus_id)
            ->first();

        if ($existingPayment) {
            return redirect()->route('siswa.pembayaran.index')->with('error', 'Anda sudah mengirimkan pembayaran untuk kursus ini.');
        }

        $kursus = Kursus::findOrFail($kursus_id);
        return view('siswa.pembayaran.create', compact('kursus'));
    }

    // Menyimpan pembayaran baru
    public function store(Request $request)
    {
        $request->validate([
            'id_kursus' => 'required|exists:kursus,id',
            'jumlah_pembayaran' => 'required|numeric',
            'bukti_pembayaran' => 'required|image'
        ]);

        $userId = Auth::id();
        $existingPayment = Pembayaran::where('id_user', $userId)
            ->where('id_kursus', $request->input('id_kursus'))
            ->first();

        if ($existingPayment) {
            return redirect()->route('siswa.pembayaran.index')->with('error', 'Anda sudah mengirimkan pembayaran untuk kursus ini.');
        }

        $pembayaran = new Pembayaran();
        $pembayaran->id_user = $userId;
        $pembayaran->id_kursus = $request->input('id_kursus');
        $pembayaran->jumlah_pembayaran = $request->input('jumlah_pembayaran');

        if ($request->hasFile('bukti_pembayaran')) {
            $filePath = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
            $pembayaran->bukti_pembayaran = $filePath;
        }

        $pembayaran->status_pembayaran = 'sedang diperiksa';
        $pembayaran->save();

        // Update status pendaftaran menjadi sedang diperiksa
        $pendaftaran = Pendaftaran::where('id_user', $userId)
            ->where('id_kursus', $request->input('id_kursus'))
            ->first();
        if ($pendaftaran) {
            $pendaftaran->status_pendaftaran = 'sedang diperiksa';
            $pendaftaran->save();
        }

        return redirect()->route('siswa.pembayaran.index')->with('success', 'Pembayaran berhasil ditambahkan dan sedang diperiksa.');
    }

    // Menampilkan detail pembayaran
    public function show($id)
    {
        $pembayaran = Pembayaran::where('id_user', Auth::id())->findOrFail($id);
        return view('siswa.pembayaran.show', compact('pembayaran'));
    }

}
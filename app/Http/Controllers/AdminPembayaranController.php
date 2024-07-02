<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\User;
use App\Models\Kursus;
use Illuminate\Support\Facades\Storage;

class AdminPembayaranController extends Controller
{
    public function index(Request $request)
    {
        $query = Pembayaran::with(['kursus', 'user']);

        if ($request->filled('search')) {
            $query->whereHas('kursus', function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
            })->orWhereHas('user', function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $payments = $query->paginate(10);
        return view('admin.pembayaran.index', compact('payments'));
    }

    public function create()
    {
        $courses = Kursus::all();
        $users = User::all();
        return view('admin.pembayaran.create', compact('courses', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'id_kursus' => 'required|exists:kursus,id',
            'jumlah_pembayaran' => 'required|integer',
            'bukti_pembayaran' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('bukti_pembayaran')) {
            $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
        } else {
            $path = null;
        }

        Pembayaran::create([
            'id_user' => $request->id_user,
            'id_kursus' => $request->id_kursus,
            'jumlah_pembayaran' => $request->jumlah_pembayaran,
            'bukti_pembayaran' => $path,
            'status_pembayaran' => 'sedang diperiksa',
        ]);

        return redirect()->route('admin.pembayaran.index')->with('success', 'Pembayaran berhasil ditambahkan.');
    }

    public function show($id)
    {
        $payment = Pembayaran::with(['kursus', 'user'])->findOrFail($id);
        return view('admin.pembayaran.show', compact('payment'));
    }

    public function edit($id)
    {
        $payment = Pembayaran::findOrFail($id);
        $courses = Kursus::all();
        $users = User::all();
        return view('admin.pembayaran.edit', compact('payment', 'courses', 'users'));
    }

    public function update(Request $request, $id)
    {
        $payment = Pembayaran::findOrFail($id);

        $request->validate([
            'id_user' => 'required|exists:users,id',
            'id_kursus' => 'required|exists:kursus,id',
            'jumlah_pembayaran' => 'required|integer',
            'bukti_pembayaran' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status_pembayaran' => 'required|in:sedang diperiksa,berhasil,dikembalikan',
        ]);

        if ($request->hasFile('bukti_pembayaran')) {
            if ($payment->bukti_pembayaran) {
                Storage::disk('public')->delete($payment->bukti_pembayaran);
            }
            $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
        } else {
            $path = $payment->bukti_pembayaran;
        }

        $payment->update([
            'id_user' => $request->id_user,
            'id_kursus' => $request->id_kursus,
            'jumlah_pembayaran' => $request->jumlah_pembayaran,
            'bukti_pembayaran' => $path,
            'status_pembayaran' => $request->status_pembayaran,
        ]);

        return redirect()->route('admin.pembayaran.index')->with('success', 'Pembayaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $payment = Pembayaran::findOrFail($id);
        if ($payment->bukti_pembayaran) {
            Storage::disk('public')->delete($payment->bukti_pembayaran);
        }
        $payment->delete();

        return redirect()->route('admin.pembayaran.index')->with('success', 'Pembayaran berhasil dihapus.');
    }

}
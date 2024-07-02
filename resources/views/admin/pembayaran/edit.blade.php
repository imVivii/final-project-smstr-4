@extends('layouts.app')

@section('title', 'Edit Pembayaran')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Pembayaran</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.pembayaran.update', $payment->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="id_user">Nama Pengguna</label>
                        <select class="form-control" name="id_user" required>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ $payment->id_user == $user->id ? 'selected' : '' }}>{{ $user->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_kursus">Nama Kursus</label>
                        <select class="form-control" name="id_kursus" required>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" {{ $payment->id_kursus == $course->id ? 'selected' : '' }}>{{ $course->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_pembayaran">Jumlah Pembayaran</label>
                        <input type="number" class="form-control" name="jumlah_pembayaran" value="{{ $payment->jumlah_pembayaran }}" required>
                    </div>
                    <div class="form-group">
                        <label for="bukti_pembayaran">Bukti Pembayaran</label>
                        <input type="file" class="form-control" name="bukti_pembayaran">
                        @if($payment->bukti_pembayaran)
                            <a href="{{ asset('storage/' . $payment->bukti_pembayaran) }}" target="_blank">Lihat Bukti Pembayaran</a>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="status_pembayaran">Status Pembayaran</label>
                        <select class="form-control" name="status_pembayaran" required>
                            <option value="sedang diperiksa" {{ $payment->status_pembayaran == 'sedang diperiksa' ? 'selected' : '' }}>Sedang Diperiksa</option>
                            <option value="berhasil" {{ $payment->status_pembayaran == 'berhasil' ? 'selected' : '' }}>Berhasil</option>
                            <option value="dikembalikan" {{ $payment->status_pembayaran == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.pembayaran.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('title', 'Ubah Pendaftaran')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Ubah Pendaftaran</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.pendaftaran.update', $registration->id) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="id_user">Pengguna</label>
                    <select name="id_user" id="id_user" class="form-control">
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ $registration->id_user == $user->id ? 'selected' : '' }}>{{ $user->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="id_kursus">Kursus</label>
                    <select name="id_kursus" id="id_kursus" class="form-control">
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" {{ $registration->id_kursus == $course->id ? 'selected' : '' }}>{{ $course->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="status_pendaftaran">Status Pendaftaran</label>
                    <select name="status_pendaftaran" id="status_pendaftaran" class="form-control">
                        <option value="menunggu pembayaran" {{ $registration->status_pendaftaran == 'menunggu pembayaran' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                        <option value="sedang diperiksa" {{ $registration->status_pendaftaran == 'sedang diperiksa' ? 'selected' : '' }}>Sedang Diperiksa</option>
                        <option value="berhasil" {{ $registration->status_pendaftaran == 'berhasil' ? 'selected' : '' }}>Berhasil</option>
                        <option value="gagal" {{ $registration->status_pendaftaran == 'gagal' ? 'selected' : '' }}>Gagal</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="status_kursus">Status Kursus</label>
                    <select name="status_kursus" id="status_kursus" class="form-control">
                        <option value="Aktif" {{ $registration->status_kursus == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Belum Aktif" {{ $registration->status_kursus == 'Belum Aktif' ? 'selected' : '' }}>Belum Aktif</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Ubah</button>
            </form>
        </div>
    </div>
@endsection

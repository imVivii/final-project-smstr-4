@extends('layouts.app')

@section('title', 'Tambah Kehadiran')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Kehadiran</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.isi_kehadiran.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="kehadiran_id">Pilih Kehadiran</label>
                    <select name="kehadiran_id" id="kehadiran_id" class="form-control" required>
                        <option value="">-- Pilih Kehadiran --</option>
                        @foreach($kehadiran as $item)
                            <option value="{{ $item->id }}">{{ $item->kursus->nama }} - {{ $item->tanggal }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="user_id">Pilih Siswa</label>
                    <select name="user_id" id="user_id" class="form-control" required>
                        <option value="">-- Pilih Siswa --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="status">Status Kehadiran</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="hadir">Hadir</option>
                        <option value="tidak hadir">Tidak Hadir</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection

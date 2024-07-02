@extends('layouts.app')

@section('title', 'Detail Pengumpulan Tugas')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Pengumpulan Tugas</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="tugas">Tugas</label>
                    <input type="text" class="form-control" value="{{ $pengumpulanTugas->tugas->judul }}" readonly>
                </div>

                <div class="form-group">
                    <label for="siswa">Siswa</label>
                    <input type="text" class="form-control" value="{{ $pengumpulanTugas->user->nama }}" readonly>
                </div>

                <div class="form-group">
                    <label for="file">File</label>
                    <a href="{{ asset('storage/' . $pengumpulanTugas->file_path) }}" target="_blank" class="form-control">Download</a>
                </div>

                <a href="{{ route('admin.pengumpulanTugas.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
@endsection

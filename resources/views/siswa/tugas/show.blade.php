@extends('layouts.app')

@section('title', 'Detail Tugas')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header">
                <h3 class="card-title">Detail Tugas: {{ $tugas->judul }}</h3>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <h5 class="font-weight-bold">Judul Tugas</h5>
                    <p>{{ $tugas->judul }}</p>
                </div>
                <div class="mb-4">
                    <h5 class="font-weight-bold">Deskripsi Tugas</h5>
                    <p><a href="{{ $tugas->deskripsi }}" target="_blank" class="btn btn-outline-primary">Lihat Tugas</a></p>
                </div>
                <div class="mb-4">
                    <h5 class="font-weight-bold">Deadline</h5>
                    <p>{{ \Carbon\Carbon::parse($tugas->tanggal_deadline)->format('d M Y, H:i') }}</p>
                </div>
                <a href="{{ route('siswa.tugas.index') }}" class="btn btn-secondary mt-3">Kembali</a>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('title', 'Detail Kursus')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title">Detail Kursus: {{ $kursus->nama }}</h3>
            </div>
            <div class="card-body">
                <h5 class="font-weight-bold">Daftar Materi:</h5>
                @if($materi->isEmpty())
                    <p class="text-muted">Tidak ada materi ditemukan untuk kursus ini.</p>
                @else
                    <div class="list-group">
                        @foreach($materi as $item)
                            <div class="list-group-item list-group-item-action flex-column align-items-start mb-3">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">{{ $item->nama }}</h5>
                                    <small>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</small>
                                </div>
                                <p class="mb-1">{{ $item->deskripsi }}</p>
                                <a href="{{ $item->materi }}" target="_blank" class="btn btn-outline-primary btn-sm mt-2">Lihat Materi</a>
                            </div>
                        @endforeach
                    </div>
                @endif
                <a href="{{ route('siswa.materi.index') }}" class="btn btn-secondary mt-4">Kembali</a>
            </div>
        </div>
    </div>
@endsection

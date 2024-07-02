@extends('layouts.app')

@section('title', 'Kursus Saya')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Kursus Saya</h3>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('siswa.materi.index') }}" class="form-inline mb-3">
                    <div class="form-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari Nama Kursus" value="{{ request()->search }}">
                    </div>
                    <button type="submit" class="btn btn-secondary ml-2">Cari</button>
                </form>
                @if($registrations->isEmpty())
                    <p>Tidak ada kursus ditemukan.</p>
                @else
                    <div class="row">
                        @foreach($registrations as $registration)
                            <div class="col-md-4 mb-4 d-flex align-items-stretch">
                                <div class="card shadow-sm w-100 border" style="max-width: 18rem;">
                                    <img src="{{ $registration->kursus->gambar ? asset('storage/' . $registration->kursus->gambar) : asset('path/to/default/image.jpg') }}" class="card-img-top" alt="{{ $registration->kursus->nama }}" style="height: 100px; object-fit: cover;">
                                    <div class="card-body d-flex flex-column" style="padding: 10px;">
                                        <h5 class="card-title" style="font-size: 1rem;">{{ $registration->kursus->nama }}</h5>
                                        <!-- <p class="card-text" style="font-size: 0.875rem;">{{ $registration->kursus->deskripsi }}</p> -->
                                        <p class="card-text" style="font-size: 0.875rem;"><strong>Status:</strong> {{ $registration->status_kursus }}</p>
                                        <a href="{{ route('siswa.materi.show', $registration->kursus->id) }}" class="btn btn-info mt-auto" style="font-size: 0.875rem; padding: 5px 10px;">Lihat Materi</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{ $registrations->links() }} <!-- Menambahkan navigasi paginasi -->
                @endif
            </div>
        </div>
    </div>
@endsection

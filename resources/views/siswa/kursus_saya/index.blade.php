@extends('layouts.app')

@section('title', 'Daftar Kursus Saya')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Kursus Saya</h3>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <form method="GET" action="{{ route('siswa.kursus_saya.index') }}" class="form-inline mb-3">
                    <div class="form-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari Kursus" value="{{ request()->search }}">
                    </div>
                    <button type="submit" class="btn btn-secondary ml-2">Cari</button>
                </form>
                @if($pendaftaran->isEmpty())
                    <p>Tidak ada kursus ditemukan.</p>
                @else
                    <div class="row">
                        @foreach($pendaftaran as $daftar)
                            <div class="col-md-4 mb-4">
                                <div class="card shadow-sm border" style="max-width: 18rem;">
                                    <img src="{{ $daftar->kursus->gambar ? asset('storage/' . $daftar->kursus->gambar) : asset('path/to/default/image.jpg') }}" class="card-img-top" alt="{{ $daftar->kursus->nama }}" style="height: 100px; object-fit: cover;">
                                    <div class="card-body d-flex flex-column" style="padding: 10px;">
                                        <h5 class="card-title" style="font-size: 1rem;">{{ $daftar->kursus->nama }}</h5>
                                        <p class="card-text" style="font-size: 0.875rem; margin-bottom: 0.25rem;"><strong>Status Kursus:</strong> {{ $daftar->status_kursus }}</p>
                                        <div class="mt-auto">
                                            <a href="{{ route('siswa.kursus_saya.show', $daftar->kursus->id) }}" class="btn btn-info btn-sm" style="font-size: 0.875rem; padding: 5px 10px;">Lihat Detail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{ $pendaftaran->appends(['search' => request()->search])->links() }}
                @endif
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .course-rating .fa-star {
        color: gold !important;
    }
    .course-rating .fa-star.checked {
        color: light !important;
    }
</style>
@endpush

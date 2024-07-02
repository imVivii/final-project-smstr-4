@extends('layouts.app')

@section('title', 'Kursus')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Kursus</h3>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('siswa.kursus.index') }}" class="form-inline mb-3">
                    <div class="form-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari Kursus" value="{{ request()->search }}">
                    </div>
                    <button type="submit" class="btn btn-secondary ml-2">Cari</button>
                </form>
                @if($kursus->isEmpty())
                    <p>Tidak ada kursus ditemukan.</p>
                @else
                    <div class="row">
                        @foreach($kursus as $course)
                            <div class="col-md-4 mb-4">
                                <div class="card shadow-sm border" style="max-width: 18rem;">
                                    <img src="{{ $course->gambar ? asset('storage/' . $course->gambar) : asset('path/to/default/image.jpg') }}" class="card-img-top" alt="{{ $course->nama }}" style="height: 100px; object-fit: cover;">
                                    <div class="card-body d-flex flex-column" style="padding: 10px;">
                                        <h5 class="card-title" style="font-size: 1rem;">{{ $course->nama }}</h5>
                                        <p class="card-text" style="font-size: 0.875rem; margin-bottom: 0.25rem;"><strong>Kategori:</strong> {{ $course->kategoriKursus ? $course->kategoriKursus->nama : 'Tidak ada kategori' }}</p>
                                        <p class="card-text" style="font-size: 0.875rem; margin-bottom: 0.25rem;"><strong>Harga:</strong> {{ $course->harga }}</p>
                                        <p class="card-text" style="font-size: 0.875rem; margin-bottom: 0.25rem;"><strong>Guru:</strong> {{ $course->guru ? $course->guru->nama : 'N/A' }}</p>
                                        @if(isset($course->average_rating))
                                            <div class="card-text course-rating" style="font-size: 0.875rem; margin-bottom: 0.25rem;">
                                                <strong>Rating:</strong>
                                                @php
                                                    $rating = round($course->average_rating);
                                                @endphp
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $rating)
                                                        <span class="fa fa-star checked"></span>
                                                    @else
                                                        <span class="fa fa-star"></span>
                                                    @endif
                                                @endfor
                                            </div>
                                        @endif
                                        <div class="mt-auto">
                                            <a href="{{ route('siswa.kursus.show', $course->id) }}" class="btn btn-info btn-sm" style="font-size: 0.875rem; padding: 5px 10px;">Lihat</a>
                                            @if(!$course->pendaftaran()->where('id_user', Auth::id())->exists())
                                                <form action="{{ route('siswa.pendaftaran.store') }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <input type="hidden" name="kursus_id" value="{{ $course->id }}">
                                                    <input type="hidden" name="status_pendaftaran" value="menunggu pembayaran">
                                                    <input type="hidden" name="status_kursus" value="Belum Aktif">
                                                    <button type="submit" class="btn btn-success btn-sm" style="font-size: 0.875rem; padding: 5px 10px;">Daftar</button>
                                                </form>
                                            @else
                                                <button class="btn btn-secondary btn-sm" style="font-size: 0.875rem; padding: 5px 10px;" disabled>Sudah Terdaftar</button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{ $kursus->appends(['search' => request()->search])->links() }}
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

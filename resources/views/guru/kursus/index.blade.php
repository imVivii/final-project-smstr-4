@extends('layouts.app')

@section('title', 'Kursus Saya')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Kursus Saya</h3>
                <!-- <a href="{{ route('guru.kursus.create') }}" class="btn btn-primary float-right">Tambah Kursus</a> -->
            </div>
            <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
                <form method="GET" action="{{ route('guru.kursus.index') }}" class="form-inline mb-3">
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
                                        <!-- <p class="card-text" style="font-size: 0.875rem; margin-bottom: 0.25rem;">{{ Str::limit($course->deskripsi, 100) }}</p>
                                        <p class="card-text" style="font-size: 0.875rem; margin-bottom: 0.25rem;"><strong>Harga:</strong> {{ $course->harga }}</p> -->
                                        <div class="mt-auto">
                                            <a href="{{ route('guru.kursus.show', $course->id) }}" class="btn btn-info btn-sm" style="font-size: 0.875rem; padding: 5px 10px;">Daftar Siswa</a>
                                            <a href="{{ route('guru.materi.index', ['id_kursus' => $course->id]) }}" class="btn btn-success btn-sm" style="font-size: 0.875rem; padding: 5px 10px;">Daftar Materi</a>
                                            <!-- <a href="{{ route('guru.kursus.edit', $course->id) }}" class="btn btn-warning btn-sm" style="font-size: 0.875rem; padding: 5px 10px;">Ubah</a>
                                            <form action="{{ route('guru.kursus.destroy', $course->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" style="font-size: 0.875rem; padding: 5px 10px;">Hapus</button>
                                            </form> -->
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

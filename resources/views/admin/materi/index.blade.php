@extends('layouts.app')

@section('title', 'Materi Kursus')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Materi Kursus</h3>
                <a href="{{ route('admin.materi.create') }}" class="btn btn-primary float-right">Tambah Materi Kursus</a>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <form method="GET" action="{{ route('admin.materi.index') }}" class="form-inline mb-3">
                    <div class="form-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari Materi atau Kursus" value="{{ request()->search }}">
                    </div>
                    <button type="submit" class="btn btn-secondary ml-2">Cari</button>
                </form>
                @if($materi->isEmpty())
                    <p>Tidak ada materi ditemukan.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Materi</th>
                                    <th>Deskripsi</th>
                                    <th>Kursus</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($materi as $material)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $material->nama }}</td>
                                        <td>{{ Str::limit($material->deskripsi, 50) }}</td>
                                        <td>{{ $material->kursus->nama }}</td>
                                        <td>
                                            <a href="{{ route('admin.materi.show', $material->id) }}" class="btn btn-info btn-sm">Lihat</a>
                                            <a href="{{ route('admin.materi.edit', $material->id) }}" class="btn btn-warning btn-sm">Ubah</a>
                                            <form action="{{ route('admin.materi.destroy', $material->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $materi->appends(['search' => request()->search])->links() }}
                @endif
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('title', 'Kategori Kursus')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Kategori Kursus</h3>
            <a href="{{ route('admin.kategoriKursus.create') }}" class="btn btn-primary float-right">Tambah Kategori</a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form method="GET" action="{{ route('admin.kategoriKursus.index') }}" class="form-inline mb-3">
                <div class="form-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan nama" value="{{ request()->search }}">
                </div>
                <button type="submit" class="btn btn-secondary ml-2">Cari</button>
                <button type="button" class="btn btn-secondary ml-2" onclick="window.print()">Print</button>
            </form>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kategoriKursus as $kategori)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $kategori->nama }}</td>
                                <td>
                                    <a href="{{ route('admin.kategoriKursus.show', $kategori->id) }}" class="btn btn-info">Lihat</a>
                                    <a href="{{ route('admin.kategoriKursus.edit', $kategori->id) }}" class="btn btn-warning">Ubah</a>
                                    <form action="{{ route('admin.kategoriKursus.destroy', $kategori->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $kategoriKursus->links() }} <!-- Menambahkan navigasi paginasi -->
        </div>
    </div>
@endsection

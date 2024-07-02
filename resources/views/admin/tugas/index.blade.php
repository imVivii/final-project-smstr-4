@extends('layouts.app')

@section('title', 'Daftar Tugas')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Tugas</h3>
            <a href="{{ route('admin.tugas.create') }}" class="btn btn-primary float-right">Tambah Tugas</a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form method="GET" action="{{ route('admin.tugas.index') }}" class="form-inline mb-3">
                <div class="form-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan judul atau kursus" value="{{ request()->search }}">
                </div>
                <button type="submit" class="btn btn-secondary ml-2">Cari</button>
                <button type="button" class="btn btn-secondary ml-2" onclick="window.print()">Print</button>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Tanggal Deadline</th>
                            <th>Kursus</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tugas as $t)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $t->judul }}</td>
                                <td>{{ $t->tanggal_deadline }}</td>
                                <td>{{ $t->kursus->nama }}</td>
                                <td>
                                    <a href="{{ route('admin.tugas.show', $t->id) }}" class="btn btn-info">Lihat</a>
                                    <a href="{{ route('admin.tugas.edit', $t->id) }}" class="btn btn-warning">Ubah</a>
                                    <form action="{{ route('admin.tugas.destroy', $t->id) }}" method="POST" style="display:inline;">
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
            {{ $tugas->links() }} <!-- Menambahkan navigasi paginasi -->
        </div>
    </div>
@endsection

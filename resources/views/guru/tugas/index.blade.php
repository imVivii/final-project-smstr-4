@extends('layouts.app')

@section('title', 'Daftar Tugas')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Tugas</h3>
                <a href="{{ route('guru.tugas.create') }}" class="btn btn-primary float-right">Tambah Tugas</a>
            </div>
            <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
                <form method="GET" action="{{ route('guru.tugas.index') }}" class="form-inline mb-3">
                    <div class="form-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari Tugas" value="{{ request()->search }}">
                    </div>
                    <button type="submit" class="btn btn-secondary ml-2">Cari</button>
                </form>
                @if($tugas->isEmpty())
                    <p>Tidak ada tugas ditemukan.</p>
                @else
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
                            @foreach($tugas as $index => $t)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $t->judul }}</td>
                                    <td>{{ $t->tanggal_deadline }}</td>
                                    <td>{{ $t->kursus->nama }}</td>
                                    <td>
                                        <!-- <a href="{{ route('guru.tugas.show', $t->id) }}" class="btn btn-info btn-sm">Lihat</a> -->
                                        <a href="{{ route('guru.tugas.edit', $t->id) }}" class="btn btn-warning btn-sm">Ubah</a>
                                        <form action="{{ route('guru.tugas.destroy', $t->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $tugas->appends(['search' => request()->search])->links() }}
                @endif
            </div>
        </div>
    </div>
@endsection

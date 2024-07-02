@extends('layouts.app')

@section('title', 'Daftar Penilaian')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Penilaian</h3>
                <a href="{{ route('admin.penilaian.create') }}" class="btn btn-primary float-right">Tambah Penilaian</a>
            </div>
            <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
                <form method="GET" action="{{ route('admin.penilaian.index') }}" class="form-inline mb-3">
                    <div class="form-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari Penilaian" value="{{ request()->search }}">
                    </div>
                    <button type="submit" class="btn btn-secondary ml-2">Cari</button>
                </form>
                @if($penilaian->isEmpty())
                    <p>Tidak ada penilaian ditemukan.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tugas</th>
                                    <th>Nama Siswa</th>
                                    <th>Nilai</th>
                                    <th>Komentar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($penilaian as $p)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $p->pengumpulanTugas->tugas->judul }}</td>
                                        <td>{{ $p->pengumpulanTugas->user->nama }}</td>
                                        <td>{{ $p->nilai }}</td>
                                        <td>{{ $p->komentar }}</td>
                                        <td>
                                            <a href="{{ route('admin.penilaian.show', $p->id) }}" class="btn btn-info btn-sm">Lihat</a>
                                            <a href="{{ route('admin.penilaian.edit', $p->id) }}" class="btn btn-warning btn-sm">Ubah</a>
                                            <form action="{{ route('admin.penilaian.destroy', $p->id) }}" method="POST" style="display:inline;">
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
                    {{ $penilaian->appends(['search' => request()->search])->links() }}
                @endif
            </div>
        </div>
    </div>
@endsection

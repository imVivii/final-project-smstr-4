@extends('layouts.app')

@section('title', 'Daftar Pengumpulan Tugas')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Pengumpulan Tugas</h3>
                <a href="{{ route('admin.pengumpulanTugas.create') }}" class="btn btn-primary float-right">Tambah Pengumpulan Tugas</a>
            </div>
            <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
                <form method="GET" action="{{ route('admin.pengumpulanTugas.index') }}" class="form-inline mb-3">
                    <div class="form-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari Pengumpulan Tugas" value="{{ request()->search }}">
                    </div>
                    <button type="submit" class="btn btn-secondary ml-2">Cari</button>
                </form>
                @if($pengumpulanTugas->isEmpty())
                    <p>Tidak ada pengumpulan tugas ditemukan.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tugas</th>
                                    <th>Siswa</th>
                                    <th>File</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pengumpulanTugas as $pt)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pt->tugas->judul }}</td>
                                        <td>{{ $pt->user->nama }}</td>
                                        <td><a href="{{ asset('storage/' . $pt->file_path) }}" target="_blank">Download</a></td>
                                        <td>
                                            <a href="{{ route('admin.pengumpulanTugas.show', $pt->id) }}" class="btn btn-info btn-sm">Lihat</a>
                                            <a href="{{ route('admin.pengumpulanTugas.edit', $pt->id) }}" class="btn btn-warning btn-sm">Ubah</a>
                                            <form action="{{ route('admin.pengumpulanTugas.destroy', $pt->id) }}" method="POST" style="display:inline;">
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
                    {{ $pengumpulanTugas->appends(['search' => request()->search])->links() }}
                @endif
            </div>
        </div>
    </div>
@endsection

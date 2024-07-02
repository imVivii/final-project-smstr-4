@extends('layouts.app')

@section('title', 'Penilaian Tugas')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Penilaian Tugas</h3>
            <!-- <a href="{{ route('guru.penilaian.create') }}" class="btn btn-primary float-right">Tambah Penilaian</a> -->
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form method="GET" action="{{ route('guru.penilaian.index') }}" class="form-inline mb-3">
                <div class="form-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari Penilaian" value="{{ request()->search }}">
                </div>
                <button type="submit" class="btn btn-secondary ml-2">Cari</button>
            </form>
            @if($penilaian->isEmpty())
                <p>Tidak ada penilaian ditemukan.</p>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tugas</th>
                            <th>Nama Kursus</th>
                            <th>Nama Siswa</th>
                            <th>Nilai</th>
                            <th>Komentar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($penilaian as $index => $p)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $p->pengumpulanTugas->tugas->judul }}</td>
                                <td>{{ $p->pengumpulanTugas->tugas->kursus->nama }}</td>
                                <td>{{ $p->pengumpulanTugas->user->nama }}</td>
                                <td>{{ $p->nilai }}</td>
                                <td>{{ $p->komentar }}</td>
                                <td>
                                    <a href="{{ route('guru.penilaian.show', $p->id) }}" class="btn btn-info btn-sm">Lihat</a>
                                    <a href="{{ route('guru.penilaian.edit', $p->id) }}" class="btn btn-warning btn-sm">Ubah</a>
                                    <form action="{{ route('guru.penilaian.destroy', $p->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $penilaian->appends(['search' => request()->search])->links() }}
            @endif
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Daftar Pengumpulan Tugas')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Pengumpulan Tugas</h3>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form method="GET" action="{{ route('guru.pengumpulan_tugas.index') }}" class="form-inline mb-3">
                <div class="form-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari Pengumpulan Tugas" value="{{ request()->search }}">
                </div>
                <button type="submit" class="btn btn-secondary ml-2">Cari</button>
            </form>
            @if($pengumpulanTugas->isEmpty())
                <p>Tidak ada pengumpulan tugas ditemukan.</p>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Nama Tugas</th>
                            <th>File Tugas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pengumpulanTugas as $index => $pt)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $pt->user->nama }}</td>
                                <td>{{ $pt->tugas->judul }}</td>
                                <td><a href="{{ asset('storage/' . $pt->file_path) }}" target="_blank">Download</a></td>
                                <td>
                                    @if($pt->penilaian)
                                        <span class="badge badge-success">Sudah Dinilai</span>
                                    @else
                                        <a href="{{ route('guru.penilaian.create', ['pengumpulan_tugas_id' => $pt->id]) }}" class="btn btn-success btn-sm">Beri Penilaian</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $pengumpulanTugas->appends(['search' => request()->search])->links() }}
            @endif
        </div>
    </div>
</div>
@endsection

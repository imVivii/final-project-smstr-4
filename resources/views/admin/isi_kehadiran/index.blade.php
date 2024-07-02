@extends('layouts.app')

@section('title', 'Daftar Isi Kehadiran')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Isi Kehadiran</h3>
            <a href="{{ route('admin.isi_kehadiran.create') }}" class="btn btn-primary float-right">Tambah Kehadiran</a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form method="GET" action="{{ route('admin.isi_kehadiran.index') }}" class="form-inline mb-3">
                <div class="form-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari Kehadiran" value="{{ request()->search }}">
                </div>
                <button type="submit" class="btn btn-secondary ml-2">Cari</button>
            </form>
            @if($isiKehadiran->isEmpty())
                <p>Tidak ada data kehadiran ditemukan.</p>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Nama Kursus</th>
                            <th>Tanggal Kehadiran</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($isiKehadiran as $kehadiran)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $kehadiran->user->nama }}</td>
                                <td>{{ $kehadiran->kehadiran->kursus->nama }}</td>
                                <td>{{ $kehadiran->kehadiran->tanggal }}</td>
                                <td>{{ $kehadiran->status }}</td>
                                <td>
                                    <a href="{{ route('admin.isi_kehadiran.edit', $kehadiran->id) }}" class="btn btn-warning btn-sm">Ubah</a>
                                    <form action="{{ route('admin.isi_kehadiran.destroy', $kehadiran->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $isiKehadiran->appends(['search' => request()->search])->links() }}
            @endif
        </div>
    </div>
</div>
@endsection

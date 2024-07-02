@extends('layouts.app')

@section('title', 'Daftar Kehadiran')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Kehadiran</h3>
            <a href="{{ route('guru.kehadiran.create') }}" class="btn btn-primary float-right">Tambah Kehadiran</a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form method="GET" action="{{ route('guru.kehadiran.index') }}" class="form-inline mb-3">
                <div class="form-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari Kehadiran" value="{{ request()->search }}">
                </div>
                <button type="submit" class="btn btn-secondary ml-2">Cari</button>
            </form>
            @if($kehadiran->isEmpty())
                <p>Tidak ada kehadiran ditemukan.</p>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kursus</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kehadiran as $index => $k)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $k->kursus->nama }}</td>
                                <td>{{ $k->tanggal }}</td>
                                <td>
                                    <a href="{{ route('guru.kehadiran.show', ['kursus_id' => $k->kursus_id, 'tanggal' => $k->tanggal]) }}" class="btn btn-info btn-sm">Lihat</a>

                                    <form action="{{ route('guru.kehadiran.destroy', ['kursus_id' => $k->kursus_id, 'tanggal' => $k->tanggal]) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $kehadiran->appends(['search' => request()->search])->links() }}
            @endif
        </div>
    </div>
</div>
@endsection

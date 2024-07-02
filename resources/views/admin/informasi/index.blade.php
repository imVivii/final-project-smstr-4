@extends('layouts.app')

@section('title', 'Informasi')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Informasi</h3>
            <a href="{{ route('admin.informasi.create') }}" class="btn btn-primary float-right">Tambah Informasi</a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form method="GET" action="{{ route('admin.informasi.index') }}" class="form-inline mb-3">
                <div class="form-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari Berdasarkan Nama" value="{{ request()->search }}">
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
                            <th>Deskripsi</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($informations as $information)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $information->nama }}</td>
                                <td>{{ $information->deskripsi }}</td>
                                <td>
                                    @if($information->gambar)
                                        <img src="{{ asset('storage/' . $information->gambar) }}" alt="{{ $information->nama }}" width="50">
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.informasi.show', $information->id) }}" class="btn btn-info">Lihat</a>
                                    <a href="{{ route('admin.informasi.edit', $information->id) }}" class="btn btn-warning">Ubah</a>
                                    <form action="{{ route('admin.informasi.destroy', $information->id) }}" method="POST" style="display:inline;">
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
            {{ $informations->links() }}
        </div>
    </div>
@endsection

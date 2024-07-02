@extends('layouts.app')

@section('title', 'Pendaftaran')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Pendaftaran</h3>
            <a href="{{ route('admin.pendaftaran.create') }}" class="btn btn-primary float-right">Tambah Pendaftaran</a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form method="GET" action="{{ route('admin.pendaftaran.index') }}" class="form-inline mb-3">
                <div class="form-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari Pengguna atau Kursus" value="{{ request()->search }}">
                </div>
                <button type="submit" class="btn btn-secondary ml-2">Cari</button>
                <button type="button" class="btn btn-secondary ml-2" onclick="window.print()">Print</button>
            </form>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Pendaftaran</th>
                            <th>Pengguna</th>
                            <th>Kursus</th>
                            <th>Status Kursus</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registrations as $registration)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $registration->created_at->format('d-m-Y') }}</td>
                                <td>{{ $registration->user->nama }}</td>
                                <td>{{ $registration->kursus->nama }}</td>
                                <td>{{ $registration->status_kursus }}</td>
                                <td>
                                    <a href="{{ route('admin.pendaftaran.show', $registration->id) }}" class="btn btn-info">Lihat</a>
                                    <a href="{{ route('admin.pendaftaran.edit', $registration->id) }}" class="btn btn-warning">Ubah</a>
                                    <form action="{{ route('admin.pendaftaran.destroy', $registration->id) }}" method="POST" style="display:inline;">
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
            {{ $registrations->links() }}
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('title', 'Pengguna')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Pengguna</h3>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary float-right">Tambah Pengguna</a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form method="GET" action="{{ route('admin.users.index') }}" class="form-inline mb-3">
                <div class="form-group">
                    <input type="text" name="search" class="form-control" placeholder="Search by name or role" value="{{ request()->search }}">
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
                            <th>Role</th>
                            <th>Foto Profil</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->nama }}</td>
                                <td>{{ $user->role }}</td>
                                <td>
                                    @if($user->foto_profil)
                                        <img src="{{ asset('storage/' . $user->foto_profil) }}" alt="{{ $user->nama }}" width="50">
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-info">Lihat</a>
                                    <!-- <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning">Ubah</a> -->
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data yang ditemukan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $users->links() }} <!-- Menambahkan navigasi paginasi -->
        </div>
    </div>
@endsection

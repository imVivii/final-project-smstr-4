@extends('layouts.app')

@section('title', 'Edit Pengguna')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Pengguna</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.users.update', $user->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" value="{{ $user->nama }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
                </div>

                <div class="form-group">
                    <label for="role">Role</label>
                    <select name="role" id="role" class="form-control">
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="guru" {{ $user->role == 'guru' ? 'selected' : '' }}>Guru</option>
                        <option value="siswa" {{ $user->role == 'siswa' ? 'selected' : '' }}>Siswa</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control" required>{{ $user->deskripsi }}</textarea>
                </div>

                <div class="form-group">
                    <label for="nomor_hp">Nomor Handphone</label>
                    <input type="text" name="nomor_hp" id="nomor_hp" class="form-control" value="{{ $user->nomor_hp }}" required>
                </div>

                <div class="form-group">
                    <label for="foto_profil">Foto Profil ( jpg, jpeg, png )</label>
                    <input type="file" name="foto_profil" id="foto_profil" class="form-control-file"><br>
                    @if($user->foto_profil)
                        <img src="{{ asset('storage/' . $user->foto_profil) }}" alt="Foto Profil" width="100">
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>
@endsection

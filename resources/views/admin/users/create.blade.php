@extends('layouts.app')

@section('title', 'Buat Pengguna')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Buat Pengguna</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select name="role" id="role" class="form-control">
                        <option value="admin">Admin</option>
                        <option value="guru">Guru</option>
                        <option value="siswa">Siswa</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label for="nomor_hp">Nomor Handphone</label>
                    <input type="text" name="nomor_hp" id="nomor_hp" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="foto_profil">Foto Profil ( jpg, jpeg, png )</label>
                    <input type="file" name="foto_profil" id="foto_profil" class="form-control-file">
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection

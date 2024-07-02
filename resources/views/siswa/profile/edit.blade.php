@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Profil</h3>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form method="POST" action="{{ route('siswa.profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('POST')

                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" value="{{ $user->nama }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control">{{ $user->deskripsi }}</textarea>
                </div>

                <div class="form-group">
                    <label for="nomor_hp">Nomor Handphone</label>
                    <input type="text" name="nomor_hp" id="nomor_hp" class="form-control" value="{{ $user->nomor_hp }}" required>
                </div>

                <div class="form-group">
                    <label for="foto_profil">Foto Profil ( jpg, jpeg, png )</label>
                    <input type="file" name="foto_profil" id="foto_profil" class="form-control-file">
                    @if($user->foto_profil)
                        <img src="{{ asset('storage/' . $user->foto_profil) }}" alt="Foto Profil" width="100">
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>
@endsection
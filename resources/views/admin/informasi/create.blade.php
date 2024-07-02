@extends('layouts.app')

@section('title', 'Buat Informasi')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Buat Informasi</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.informasi.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label for="gambar">Gambar</label>
                    <input type="file" name="gambar" id="gambar" class="form-control-file">
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection

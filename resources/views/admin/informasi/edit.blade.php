@extends('layouts.app')

@section('title', 'Ubah Informasi')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Ubah Informasi</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.informasi.update', $information->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" value="{{ $information->nama }}" required>
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control" required>{{ $information->deskripsi }}</textarea>
                </div>
                <div class="form-group">
                    <label for="gambar">Gambar</label>
                    <input type="file" name="gambar" id="gambar" class="form-control-file">
                    <br>
                    @if($information->gambar)
                        <img src="{{ asset('storage/' . $information->gambar) }}" alt="{{ $information->nama }}" width="300">
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Ubah</button>
            </form>
        </div>
    </div>
@endsection

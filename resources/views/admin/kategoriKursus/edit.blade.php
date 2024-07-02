@extends('layouts.app')

@section('title', 'Edit Kategori Kursus')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Kategori Kursus</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.kategoriKursus.update', $kategori->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nama">Nama Kategori</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $kategori->nama) }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.kategoriKursus.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
@endsection

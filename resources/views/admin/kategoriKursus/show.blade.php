@extends('layouts.app')

@section('title', 'Detail Kategori Kursus')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Detail Kategori Kursus</h3>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="nama">Nama Kategori</label>
                <input type="text" class="form-control" id="nama" value="{{ $kategori->nama }}" readonly>
            </div>
            <a href="{{ route('admin.kategoriKursus.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
@endsection

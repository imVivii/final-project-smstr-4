@extends('layouts.app')

@section('title', 'Buat Kursus')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tambah Kursus</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('guru.kursus.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="nama">Nama Kursus</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" name="harga" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="gambar">Gambar</label>
                        <input type="file" name="gambar" class="form-control-file">
                    </div>

                    <div class="form-group">
                        <label for="media">Media Kursus</label>
                        <textarea name="media" id="media" class="form-control" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="kategori_kursus_id">Kategori Kursus</label>
                        <select name="kategori_kursus_id" class="form-control">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategoriKursus as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Tambah Kursus</button>
                </form>
            </div>
        </div>
    </div>
@endsection

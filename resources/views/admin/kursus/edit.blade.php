@extends('layouts.app')

@section('title', 'Edit Kursus')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Kursus</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.kursus.update', $kursus->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="nama">Nama Kursus</label>
                        <input type="text" name="nama" class="form-control" value="{{ $kursus->nama }}" required>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3" required>{{ $kursus->deskripsi }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" name="harga" class="form-control" value="{{ $kursus->harga }}" required>
                    </div>

                    <div class="form-group">
                        <label for="gambar">Gambar</label>
                        <input type="file" name="gambar" class="form-control-file"><br>
                        @if($kursus->gambar)
                            <img src="{{ asset('storage/' . $kursus->gambar) }}" alt="Gambar Kursus" width="100">
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="media">Media Kursus</label>
                        <textarea name="media" id="media" class="form-control" required>{{ $kursus->media }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="user_id">Pilih Guru</label>
                        <select name="user_id" class="form-control">
                            <option value="">-- Pilih Guru --</option>
                            @foreach($gurus as $guru)
                                <option value="{{ $guru->id }}" {{ $kursus->user_id == $guru->id ? 'selected' : '' }}>{{ $guru->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="kategori_kursus_id">Kategori Kursus</label>
                        <select name="kategori_kursus_id" class="form-control">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategoriKursus as $kategori)
                                <option value="{{ $kategori->id }}" {{ $kursus->kategori_kursus_id == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
@endsection

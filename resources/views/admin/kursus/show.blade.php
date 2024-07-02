@extends('layouts.app')

@section('title', 'Detail Kursus')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Kursus</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <table class="table table-borderless">
                            <tr>
                                <th>Nama Kursus</th>
                                <td>{{ $kursus->nama }}</td>
                            </tr>
                            <tr>
                                <th>Kategori Kursus</th>
                                <td>{{ $kursus->kategoriKursus->nama ?? 'Tidak ada kategori' }}</td>
                            </tr>
                            <tr>
                                <th>Media Kursus</th>
                                <td>
                                    @if($kursus->media)
                                        <a href="{{ $kursus->media }}" target="_blank">Link Zoom Kursus</a>
                                    @else
                                        Tidak ada media
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Guru</th>
                                <td>{{ $kursus->guru->nama ?? 'Tidak ada guru' }}</td>
                            </tr>
                            <tr>
                                <th>Harga</th>
                                <td>{{ $kursus->harga }}</td>
                            </tr>
                            <tr>
                                <th>Deskripsi</th>
                                <td>{{ $kursus->deskripsi }}</td>
                            </tr>
                        </table>
                        <a href="{{ route('admin.kursus.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="border p-2">
                            <label for="gambar">Gambar Kursus</label>
                            <br>
                            @if($kursus->gambar)
                                <img src="{{ asset('storage/' . $kursus->gambar) }}" alt="Gambar Kursus" class="img-fluid rounded" style="width: 200px; max-height: 400px; object-fit: cover;">
                            @else
                                <img src="{{ asset('path/to/default/image.jpg') }}" alt="Gambar Kursus" class="img-fluid rounded" style="width: 200px; max-height: 400px; object-fit: cover;">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

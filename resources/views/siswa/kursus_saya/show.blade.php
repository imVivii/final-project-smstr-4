@extends('layouts.app')

@section('title', 'Detail Kursus')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Kursus</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Nama Kursus</th>
                        <td>{{ $kursus->kursus->nama }}</td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td>{{ $kursus->kursus->deskripsi }}</td>
                    </tr>
                    <tr>
                        <th>Harga</th>
                        <td>{{ $kursus->kursus->harga }}</td>
                    </tr>
                    <tr>
                        <th>Status Kursus</th>
                        <td>{{ $kursus->status_kursus }}</td>
                    </tr>
                    <tr>
                        <th>Gambar</th>
                        <td>
                            @if($kursus->kursus->gambar)
                                <img src="{{ asset('storage/' . $kursus->kursus->gambar) }}" alt="Gambar Kursus" style="width: 200px; height: auto;">
                            @else
                                <p>Tidak ada gambar</p>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Media</th>
                        <td>
                            @if($kursus->kursus->media)
                                <a href="{{ $kursus->kursus->media }}" target="_blank">Klik untuk Bergabung ke Zoom Kursus</a>
                            @else
                                <p>Tidak ada media</p>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Kategori Kursus</th>
                        <td>{{ $kursus->kursus->kategoriKursus->nama ?? 'Tidak ada kategori' }}</td>
                    </tr>
                </table><br>
                <a href="{{ route('siswa.kursus_saya.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
@endsection

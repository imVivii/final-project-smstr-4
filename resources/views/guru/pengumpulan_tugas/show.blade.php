
@extends('layouts.app')

@section('title', 'Detail Pengumpulan Tugas')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Detail Pengumpulan Tugas</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Nama Siswa</th>
                    <td>{{ $pengumpulanTugas->user->nama }}</td>
                </tr>
                <tr>
                    <th>Judul Tugas</th>
                    <td>{{ $pengumpulanTugas->tugas->judul }}</td>
                </tr>
                <tr>
                    <th>Deskripsi Tugas</th>
                    <td>{{ $pengumpulanTugas->tugas->deskripsi }}</td>
                </tr>
                <tr>
                    <th>File Tugas</th>
                    <td>
                        <a href="{{ asset('storage/' . $pengumpulanTugas->file_path) }}" target="_blank">Download File</a>
                    </td>
                </tr>
                <tr>
                    <th>Tanggal Pengumpulan</th>
                    <td>{{ $pengumpulanTugas->created_at->format('d-m-Y') }}</td>
                </tr>
            </table>
            <a href="{{ route('guru.pengumpulan_tugas.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection

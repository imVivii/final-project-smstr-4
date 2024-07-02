@extends('layouts.app')

@section('title', 'Detail Tugas yang Sudah Dikirim')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Tugas yang Sudah Dikirim</h3>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
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
                    <tr>
                        <th>Tanggal Deadline</th>
                        <td>{{ \Carbon\Carbon::parse($pengumpulanTugas->tugas->tanggal_deadline)->format('d-m-Y') }}</td>
                    </tr>
                </table>
                <a href="{{ route('siswa.pengumpulan_tugas.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
@endsection

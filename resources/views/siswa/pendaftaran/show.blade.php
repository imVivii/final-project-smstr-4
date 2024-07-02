@extends('layouts.app')

@section('title', 'Detail Pendaftaran Kursus')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Pendaftaran Kursus</h3>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th>Nama Kursus</th>
                        <td>{{ $pendaftaran->kursus->nama }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Pendaftaran</th>
                        <td>{{ $pendaftaran->created_at->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <th>Status Pembayaran</th>
                        <td>{{ $pendaftaran->status_pembayaran }}</td>
                    </tr>
                    <tr>
                        <th>Status Kursus</th>
                        <td>{{ $pendaftaran->status_kursus }}</td>
                    </tr>
                </table><br>
                <a href="{{ route('siswa.pendaftaran.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
@endsection

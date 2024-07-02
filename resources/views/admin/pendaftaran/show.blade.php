@extends('layouts.app')

@section('title', 'Detail Pendaftaran')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Detail Pendaftaran</h3>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <tr>
                    <th>Tanggal Pendaftaran</th>
                    <td>{{ $registration->created_at->format('d-m-Y') }}</td>
                </tr>
                <tr>
                    <th>Pengguna</th>
                    <td>{{ $registration->user->nama }}</td>
                </tr>
                <tr>
                    <th>Nama Kursus</th>
                    <td>{{ $registration->kursus->nama }}</td>
                </tr>
                <tr>
                    <th>Status Pendaftaran</th>
                    <td>{{ $registration->status_pembayaran }}</td>
                </tr>
                <tr>
                    <th>Status Kursus</th>
                    <td>{{ $registration->status_kursus }}</td>
                </tr>
            </table><br>
            <a href="{{ route('admin.pendaftaran.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
@endsection

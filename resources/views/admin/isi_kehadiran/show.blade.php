@extends('layouts.app')

@section('title', 'Detail Kehadiran')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Detail Kehadiran</h3>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="kehadiran_id">Kehadiran</label>
                <input type="text" class="form-control" value="{{ $kehadiran->kehadiran->kursus->nama }} - {{ $kehadiran->kehadiran->tanggal }}" readonly>
            </div>
            <div class="form-group">
                <label for="user_id">Siswa</label>
                <input type="text" class="form-control" value="{{ $kehadiran->user->nama }}" readonly>
            </div>
            <div class="form-group">
                <label for="status">Status Kehadiran</label>
                <input type="text" class="form-control" value="{{ $kehadiran->status }}" readonly>
            </div>
            <a href="{{ route('admin.isi_kehadiran.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection

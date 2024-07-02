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
                    <label for="kursus">Nama Kursus</label>
                    <input type="text" class="form-control" id="kursus" value="{{ $kehadiran->kursus->nama }}" readonly>
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal Kehadiran</label>
                    <input type="date" class="form-control" id="tanggal" value="{{ $kehadiran->tanggal }}" readonly>
                </div>
                <div class="form-group">
                    <label for="status">Status Kehadiran</label>
                    <input type="text" class="form-control" id="status" value="{{ $kehadiran->isiKehadiran->where('user_id', Auth::id())->first()->status ?? 'Belum Diisi' }}" readonly>
                </div>
                <a href="{{ route('siswa.kehadiran.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
@endsection

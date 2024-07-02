@extends('layouts.app')

@section('title', 'Detail Penilaian')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Detail Penilaian</h3>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="nilai">Nilai</label>
                <input type="number" class="form-control" value="{{ $penilaian->nilai }}" readonly>
            </div>
            <div class="form-group">
                <label for="komentar">Komentar</label>
                <textarea class="form-control" rows="3" readonly>{{ $penilaian->komentar }}</textarea>
            </div>
            <a href="{{ route('guru.penilaian.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection

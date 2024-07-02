@extends('layouts.app')

@section('title', 'Detail Tugas')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Tugas</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="judul">Judul Tugas</label>
                    <input type="text" class="form-control" value="{{ $tugas->judul }}" readonly>
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi ( Link )</label>
                    <textarea class="form-control" rows="3" readonly>{{ $tugas->deskripsi }}</textarea>
                </div>

                <div class="form-group">
                    <label for="tanggal_deadline">Tanggal Deadline</label>
                    <input type="date" class="form-control" value="{{ $tugas->tanggal_deadline }}" readonly>
                </div>

                <div class="form-group">
                    <label for="kursus">Kursus</label>
                    <input type="text" class="form-control" value="{{ $tugas->kursus->nama }}" readonly>
                </div>

                <a href="{{ route('guru.tugas.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
@endsection

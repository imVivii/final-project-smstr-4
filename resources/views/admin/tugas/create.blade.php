@extends('layouts.app')

@section('title', 'Tambah Tugas')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Tugas</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.tugas.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="judul">Judul</label>
                    <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul') }}" required>
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi ( Link )</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" required>{{ old('deskripsi') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="tanggal_deadline">Tanggal Deadline</label>
                    <input type="date" class="form-control" id="tanggal_deadline" name="tanggal_deadline" value="{{ old('tanggal_deadline') }}" required>
                </div>
                <div class="form-group">
                    <label for="kursus_id">Kursus</label>
                    <select class="form-control" id="kursus_id" name="kursus_id" required>
                        @foreach($kursus as $k)
                            <option value="{{ $k->id }}">{{ $k->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.tugas.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
@endsection

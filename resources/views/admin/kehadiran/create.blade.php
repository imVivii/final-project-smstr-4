@extends('layouts.app')

@section('title', 'Tambah Kehadiran')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Kehadiran</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.kehadiran.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="kursus_id">Pilih Kursus</label>
                    <select name="kursus_id" id="kursus_id" class="form-control" required>
                        <option value="">-- Pilih Kursus --</option>
                        @foreach($kursus as $course)
                            <option value="{{ $course->id }}">{{ $course->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection

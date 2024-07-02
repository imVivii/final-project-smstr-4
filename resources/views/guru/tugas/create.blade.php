@extends('layouts.app')

@section('title', 'Buat Tugas')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tambah Tugas</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('guru.tugas.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="judul">Judul Tugas</label>
                        <input type="text" name="judul" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi ( Link )</label>
                        <textarea name="deskripsi" class="form-control" rows="3" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_deadline">Tanggal Deadline</label>
                        <input type="date" name="tanggal_deadline" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="kursus_id">Pilih Kursus</label>
                        <select name="kursus_id" class="form-control" required>
                            <option value="">-- Pilih Kursus --</option>
                            @foreach($kursus as $course)
                                <option value="{{ $course->id }}">{{ $course->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Tambah Tugas</button>
                </form>
            </div>
        </div>
    </div>
@endsection

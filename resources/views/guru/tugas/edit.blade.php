@extends('layouts.app')

@section('title', 'Ubah Tugas')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Ubah Tugas</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('guru.tugas.update', $tugas->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="judul">Judul Tugas</label>
                        <input type="text" name="judul" class="form-control" value="{{ $tugas->judul }}" required>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi ( Link )</label>
                        <textarea name="deskripsi" class="form-control" rows="3" required>{{ $tugas->deskripsi }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_deadline">Tanggal Deadline</label>
                        <input type="date" name="tanggal_deadline" class="form-control" value="{{ $tugas->tanggal_deadline }}" required>
                    </div>

                    <div class="form-group">
                        <label for="kursus_id">Pilih Kursus</label>
                        <select name="kursus_id" class="form-control" required>
                            @foreach($kursus as $course)
                                <option value="{{ $course->id }}" {{ $tugas->kursus_id == $course->id ? 'selected' : '' }}>{{ $course->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
@endsection

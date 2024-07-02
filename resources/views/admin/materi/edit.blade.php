@extends('layouts.app')

@section('title', 'Edit Materi Kursus')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Materi Kursus</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.materi.update', $material->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="nama">Nama Materi</label>
                        <input type="text" name="nama" id="nama" class="form-control" value="{{ $material->nama }}" required>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3">{{ $material->deskripsi }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="materi">Materi</label>
                        <textarea name="materi" id="materi" class="form-control" rows="3">{{ $material->materi }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="id_kursus">Kursus</label>
                        <select name="id_kursus" id="id_kursus" class="form-control" required>
                            <option value="">-- Pilih Kursus --</option>
                            @foreach($kursus as $course)
                                <option value="{{ $course->id }}" {{ $material->id_kursus == $course->id ? 'selected' : '' }}>{{ $course->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
@endsection

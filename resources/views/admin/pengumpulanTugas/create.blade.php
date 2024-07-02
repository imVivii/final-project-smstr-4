@extends('layouts.app')

@section('title', 'Tambah Pengumpulan Tugas')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tambah Pengumpulan Tugas</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.pengumpulanTugas.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="tugas_id">Tugas</label>
                        <select name="tugas_id" id="tugas_id" class="form-control" required>
                            <option value="">-- Pilih Tugas --</option>
                            @foreach($tugas as $t)
                                <option value="{{ $t->id }}">{{ $t->judul }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="user_id">Siswa</label>
                        <select name="user_id" id="user_id" class="form-control" required>
                            <option value="">-- Pilih Siswa --</option>
                            @foreach($siswa as $s)
                                <option value="{{ $s->id }}">{{ $s->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="file_path">File ( pdf,doc,docx,zip )</label>
                        <input type="file" name="file_path" id="file_path" class="form-control-file" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection

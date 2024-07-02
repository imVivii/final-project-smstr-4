@extends('layouts.app')

@section('title', 'Edit Pengumpulan Tugas')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Pengumpulan Tugas</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.pengumpulanTugas.update', $pengumpulanTugas->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="tugas_id">Tugas</label>
                        <select name="tugas_id" id="tugas_id" class="form-control" required>
                            <option value="">-- Pilih Tugas --</option>
                            @foreach($tugas as $t)
                                <option value="{{ $t->id }}" {{ $pengumpulanTugas->tugas_id == $t->id ? 'selected' : '' }}>
                                    {{ $t->judul }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="user_id">Siswa</label>
                        <select name="user_id" id="user_id" class="form-control" required>
                            <option value="">-- Pilih Siswa --</option>
                            @foreach($siswa as $s)
                                <option value="{{ $s->id }}" {{ $pengumpulanTugas->user_id == $s->id ? 'selected' : '' }}>
                                    {{ $s->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="file_path">File ( pdf,doc,docx,zip )</label>
                        <input type="file" name="file_path" id="file_path" class="form-control-file">
                        @if($pengumpulanTugas->file_path)
                            <a href="{{ asset('storage/' . $pengumpulanTugas->file_path) }}" target="_blank">Download file saat ini</a>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
@endsection

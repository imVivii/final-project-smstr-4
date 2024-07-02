@extends('layouts.app')

@section('title', 'Edit Tugas')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Tugas</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('siswa.pengumpulan_tugas.update', $pengumpulanTugas->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="tugas_id" value="{{ $tugas->id }}">
                    <div class="form-group">
                        <label for="judul">Judul Tugas</label>
                        <input type="text" id="judul" class="form-control" value="{{ $tugas->judul }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="file_path">File Tugas</label>
                        <input type="file" name="file_path" id="file_path" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Perbarui</button>
                </form>
            </div>
        </div>
    </div>
@endsection

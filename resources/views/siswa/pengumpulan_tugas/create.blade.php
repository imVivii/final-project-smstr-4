@extends('layouts.app')

@section('title', 'Kirim Tugas')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Kirim Tugas</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('siswa.pengumpulan_tugas.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="tugas_id" value="{{ $tugas->id }}">
                    <div class="form-group">
                        <label for="judul">Judul Tugas</label>
                        <input type="text" id="judul" class="form-control" value="{{ $tugas->judul }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="file_path">File Tugas ( pdf,doc,docx,zip )</label>
                        <input type="file" name="file_path" id="file_path" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </form>
            </div>
        </div>
    </div>
@endsection

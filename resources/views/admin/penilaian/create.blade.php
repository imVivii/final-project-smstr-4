@extends('layouts.app')

@section('title', 'Tambah Penilaian')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Penilaian</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('guru.penilaian.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="pengumpulan_tugas_id">Pilih Tugas</label>
                    <select name="pengumpulan_tugas_id" id="pengumpulan_tugas_id" class="form-control" required>
                        <option value="">-- Pilih Tugas --</option>
                        @foreach($pengumpulanTugas as $tugas)
                            <option value="{{ $tugas->id }}">{{ $tugas->tugas->judul }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="nilai">Nilai</label>
                    <input type="number" name="nilai" id="nilai" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="komentar">Komentar</label>
                    <textarea name="komentar" id="komentar" class="form-control" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection

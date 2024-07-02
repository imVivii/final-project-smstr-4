@extends('layouts.app')

@section('title', 'Ubah Penilaian')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Ubah Penilaian</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('guru.penilaian.update', $penilaian->id) }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="pengumpulan_tugas_id">Pengumpulan Tugas</label>
                    <select name="pengumpulan_tugas_id" id="pengumpulan_tugas_id" class="form-control" required>
                        @foreach($pengumpulanTugas as $tugas)
                            <option value="{{ $tugas->id }}" {{ $tugas->id == $penilaian->pengumpulan_tugas_id ? 'selected' : '' }}>
                                {{ $tugas->tugas->judul }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="nilai">Nilai</label>
                    <input type="number" name="nilai" id="nilai" class="form-control" value="{{ $penilaian->nilai }}" required>
                </div>
                <div class="form-group">
                    <label for="komentar">Komentar</label>
                    <textarea name="komentar" id="komentar" class="form-control" rows="3">{{ $penilaian->komentar }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>
@endsection

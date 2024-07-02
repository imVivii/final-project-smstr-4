@extends('layouts.app')

@section('title', 'Edit Penilaian')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Penilaian</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.penilaian.update', $penilaian->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="pengumpulan_tugas_id">Pengumpulan Tugas</label>
                        <select name="pengumpulan_tugas_id" id="pengumpulan_tugas_id" class="form-control" required>
                            <option value="">-- Pilih Pengumpulan Tugas --</option>
                            @foreach($pengumpulanTugas as $pt)
                                <option value="{{ $pt->id }}" {{ $penilaian->pengumpulan_tugas_id == $pt->id ? 'selected' : '' }}>
                                    {{ $pt->tugas->judul }} - {{ $pt->user->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="guru_id">Guru</label>
                        <select name="guru_id" id="guru_id" class="form-control" required>
                            <option value="">-- Pilih Guru --</option>
                            @foreach($gurus as $guru)
                                <option value="{{ $guru->id }}" {{ $penilaian->guru_id == $guru->id ? 'selected' : '' }}>
                                    {{ $guru->nama }}
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

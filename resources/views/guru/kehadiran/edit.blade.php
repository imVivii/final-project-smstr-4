@extends('layouts.app')

@section('title', 'Edit Kehadiran')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Kehadiran</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('guru.kehadiran.update', ['kursus_id' => $kehadiran->kursus_id, 'tanggal' => $kehadiran->tanggal]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="kursus_id">Pilih Kursus</label>
                    <select name="kursus_id" id="kursus_id" class="form-control" required>
                        <option value="">-- Pilih Kursus --</option>
                        @foreach($kursus as $k)
                            <option value="{{ $k->id }}" {{ $k->id == $kehadiran->kursus_id ? 'selected' : '' }}>{{ $k->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ $kehadiran->tanggal }}" required>
                </div>

                <div class="form-group">
                    <label for="siswa">Daftar Kehadiran Siswa</label>
                    <div id="siswa">
                        @foreach($siswa as $s)
                            @php
                                $status = $isiKehadiran->firstWhere('user_id', $s->id)->status ?? 'tidak hadir';
                            @endphp
                            <div class="form-check">
                                <input type="checkbox" name="siswa[{{ $loop->index }}][user_id]" value="{{ $s->id }}" class="form-check-input" id="siswa_{{ $s->id }}" {{ $status == 'hadir' ? 'checked' : '' }}>
                                <label class="form-check-label" for="siswa_{{ $s->id }}">{{ $s->nama }}</label>
                                <select name="siswa[{{ $loop->index }}][status]" class="form-control">
                                    <option value="hadir" {{ $status == 'hadir' ? 'selected' : '' }}>Hadir</option>
                                    <option value="tidak hadir" {{ $status == 'tidak hadir' ? 'selected' : '' }}>Tidak Hadir</option>
                                </select>
                            </div>
                        @endforeach
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Isi Kehadiran')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Isi Kehadiran</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('siswa.isi_kehadiran.store') }}" method="POST">
                @csrf

                <input type="hidden" name="kehadiran_id" value="{{ $kehadiran->id }}">

                <div class="form-group">
                    <label for="kursus">Kursus</label>
                    <input type="text" class="form-control" id="kursus" value="{{ $kehadiran->kursus->nama }}" readonly>
                </div>

                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="text" class="form-control" id="tanggal" value="{{ \Carbon\Carbon::parse($kehadiran->tanggal)->format('d-m-Y') }}" readonly>
                </div>

                <div class="form-group">
                    <label for="status">Status Kehadiran</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="hadir">Hadir</option>
                        <option value="tidak hadir">Tidak Hadir</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection

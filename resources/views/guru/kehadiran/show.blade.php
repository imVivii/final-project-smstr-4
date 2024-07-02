@extends('layouts.app')

@section('title', 'Detail Kehadiran')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Detail Kehadiran</h3>
        </div>
        <div class="card-body">
            <h4>Nama Kursus: {{ $kehadiran->kursus->nama }}</h4>
            <h5>Tanggal: {{ $kehadiran->tanggal }}</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Status Kehadiran</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($isiKehadiran as $index => $ik)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $ik->user->nama }}</td>
                            <td>{{ $ik->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table><br>
            <a href="{{ route('guru.kehadiran.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection

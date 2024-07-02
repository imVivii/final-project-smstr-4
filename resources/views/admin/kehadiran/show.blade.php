@extends('layouts.app')

@section('title', 'Detail Kehadiran')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Detail Kehadiran - {{ $kehadiran->kursus->nama }} ({{ $kehadiran->tanggal }})</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($isiKehadiran as $index => $isi)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $isi->user->nama }}</td>
                            <td>{{ ucfirst($isi->status) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <a href="{{ route('admin.kehadiran.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection

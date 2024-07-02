@extends('layouts.app')

@section('title', 'Detail Materi Kursus')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Materi Kursus</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <table class="table table-borderless">
                            <tr>
                                <th>Kursus</th>
                                <td>{{ $material->kursus->nama }}</td>
                            </tr>
                            <tr>
                                <th>Nama Materi</th>
                                <td>{{ $material->nama }}</td>
                            </tr>
                            <tr>
                                <th>Materi</th>
                                
                                <td><a href="{{ $material->materi }}" target="_blank">Lihat Materi</a></td>
                            </tr>
                            <tr>
                                <th>Deskripsi</th>
                                <td>{{ $material->deskripsi }}</td>
                            </tr>
                        </table>
                        <a href="{{ route('admin.materi.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('title', 'Daftar Tugas yang Sudah Dikirim')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Tugas yang Sudah Dikirim</h3>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @if($pengumpulanTugas->isEmpty())
                    <p>Belum ada tugas yang dikirim.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul Tugas</th>
                                    <th>Tanggal Pengumpulan</th>
                                    <th>Tanggal Deadline</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pengumpulanTugas as $index => $tugas)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $tugas->tugas->judul }}</td>
                                        <td>{{ $tugas->created_at->format('d-m-Y') }}</td>
                                        <td>{{ $tugas->tugas->tanggal_deadline }}</td>
                                        <td>
                                            <a href="{{ route('siswa.pengumpulan_tugas.show', $tugas->id) }}" class="btn btn-info btn-sm">Lihat</a>
                                            @if(\Carbon\Carbon::now()->lessThanOrEqualTo(\Carbon\Carbon::parse($tugas->tugas->tanggal_deadline)))
                                                <a href="{{ route('siswa.pengumpulan_tugas.edit', $tugas->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            @else
                                                <button class="btn btn-secondary btn-sm" disabled>Batas Waktu Terlewati</button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $pengumpulanTugas->links() }}
                @endif
            </div>
        </div>
    </div>
@endsection

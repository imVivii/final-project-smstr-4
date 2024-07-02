@extends('layouts.app')

@section('title', 'Detail Kursus')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Kursus</h3>
            </div>
            <div class="card-body">

                <form method="GET" action="{{ route('guru.kursus.show', $kursus->id) }}" class="form-inline mb-3">
                    <div class="form-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari Nama Siswa" value="{{ request()->search }}">
                    </div>
                    <button type="submit" class="btn btn-secondary ml-2">Cari</button>
                </form>
                <h4>Daftar Siswa Kursus : {{ $kursus->nama }}</h4>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto Profil</th>
                            <th>Nama Siswa</th>
                            <th>Nomor HP</th>
                            <th>Status Kursus</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $filteredPendaftaran = $kursus->pendaftaran->filter(function($pendaftaran) {
                                return $pendaftaran->status_kursus == 'Aktif';
                            });
                            $search = request()->search;
                            if ($search) {
                                $filteredPendaftaran = $filteredPendaftaran->filter(function($pendaftaran) use ($search) {
                                    return stripos($pendaftaran->user->nama, $search) !== false;
                                });
                            }
                        @endphp

                        @foreach($filteredPendaftaran as $index => $pendaftaran)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    @if($pendaftaran->user->foto_profil)
                                        <img src="{{ asset('storage/' . $pendaftaran->user->foto_profil) }}" alt="Foto Profil" width="50" height="50" class="img-circle">
                                    @else
                                        <img src="{{ asset('path/to/default/image.jpg') }}" alt="Foto Profil" width="50" height="50" class="img-circle">
                                    @endif
                                </td>
                                <td>{{ $pendaftaran->user->nama }}</td>
                                <td>{{ $pendaftaran->user->nomor_hp }}</td>
                                <td>{{ $pendaftaran->status_kursus }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table><br>

                <a href="{{ route('guru.kursus.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
@endsection

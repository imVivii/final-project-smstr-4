@extends('layouts.app')

@section('title', 'Daftar Tugas Saya')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Daftar Tugas Saya</h3>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('siswa.tugas.index') }}" class="form-inline mb-3">
                    <div class="form-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari Nama Kursus" value="{{ request()->search }}">
                    </div>
                    <button type="submit" class="btn btn-secondary ml-2">Cari</button>
                </form>
                @if($registrations->isEmpty())
                    <p>Tidak ada tugas ditemukan.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kursus</th>
                                    <th>Judul Tugas</th>
                                    <th>Deadline</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($registrations as $registration)
                                    @foreach($registration->kursus->tugas as $index => $tugas)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $registration->kursus->nama }}</td>
                                            <td>{{ $tugas->judul }}</td>
                                            <td>{{ $tugas->tanggal_deadline }}</td>
                                            <td>
                                                <a href="{{ route('siswa.tugas.show', $tugas->id) }}" class="btn btn-info btn-sm">Lihat Tugas</a>
                                                @php
                                                    $pengumpulan = $tugas->pengumpulanTugas->where('user_id', Auth::id())->first();
                                                @endphp
                                                @if($pengumpulan)
                                                    <button class="btn btn-secondary btn-sm" disabled>Tugas Sudah Dikirim</button>
                                                @elseif(\Carbon\Carbon::now()->lessThanOrEqualTo(\Carbon\Carbon::parse($tugas->tanggal_deadline)))
                                                    <a href="{{ route('siswa.pengumpulan_tugas.create', $tugas->id) }}" class="btn btn-primary btn-sm">Kirim Tugas</a>
                                                @else
                                                    <button class="btn btn-secondary btn-sm" disabled>Batas Waktu Terlewati</button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $registrations->links() }} <!-- Menambahkan navigasi paginasi -->
                @endif
            </div>
        </div>
    </div>
@endsection

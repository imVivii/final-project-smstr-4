@extends('layouts.app')

@section('title', 'Daftar Kehadiran')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Kehadiran</h3>
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

                <form method="GET" action="{{ route('siswa.kehadiran.index') }}" class="form-inline mb-3">
                    <div class="form-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari Nama Kursus" value="{{ request()->search }}">
                    </div>
                    <button type="submit" class="btn btn-secondary ml-2">Cari</button>
                </form>

                @if($kehadiran->isEmpty())
                    <p>Tidak ada data kehadiran ditemukan.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kursus</th>
                                    <th>Tanggal Kehadiran</th>
                                    <th>Status Kehadiran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kehadiran as $index => $data)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $data->kursus->nama }}</td>
                                        <td>{{ \Carbon\Carbon::parse($data->tanggal)->format('d-m-Y') }}</td>
                                        <td>
                                            @php
                                                $status = $data->isiKehadiran->where('user_id', Auth::id())->first()->status ?? 'Belum Diisi';
                                            @endphp
                                            {{ $status }}
                                        </td>
                                        <td>
                                            @php
                                                $isToday = \Carbon\Carbon::parse($data->tanggal)->isToday();
                                                $isTomorrow = \Carbon\Carbon::parse($data->tanggal)->isTomorrow();
                                            @endphp

                                            @if($isTomorrow)
                                                <button class="btn btn-secondary btn-sm" disabled>Belum Waktunya</button>
                                            @elseif($status === 'Belum Diisi' && $isToday)
                                                <a href="{{ route('siswa.isi_kehadiran.create', $data->id) }}" class="btn btn-info btn-sm">Isi Kehadiran</a>
                                            @elseif($status !== 'Belum Diisi')
                                                <a href="{{ route('siswa.isi_kehadiran.show', $data->id) }}" class="btn btn-secondary btn-sm">Lihat Kehadiran</a>
                                            @else
                                                <button class="btn btn-secondary btn-sm" disabled>Terlambat Isi</button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $kehadiran->links() }} <!-- Menambahkan navigasi paginasi -->
                @endif
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('title', 'Daftar Pembayaran')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Pembayaran</h3>
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

                <h4>Kursus yang Sudah Dibayar atau Sedang Diperiksa</h4>
                <div class="table-responsive mb-4">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Pembayaran</th>
                                <th>Nama Kursus</th>
                                <th>Jumlah Pembayaran</th>
                                <th>Status Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pembayaran as $index => $bayar)
                                @if($bayar->status_pembayaran != 'gagal')
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $bayar->created_at->format('d-m-Y') }}</td>
                                        <td>{{ $bayar->kursus->nama }}</td>
                                        <td>{{ $bayar->jumlah_pembayaran }}</td>
                                        <td>{{ $bayar->status_pembayaran }}</td>
                                        <td>
                                            <a href="{{ route('siswa.pembayaran.show', $bayar->id) }}" class="btn btn-info btn-sm">Lihat Detail Pembayaran</a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <h4>Kursus yang Belum Dibayar</h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kursus</th>
                                <th>Jumlah Pembayaran</th>
                                <th>Status Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendaftaran as $index => $daftar)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $daftar->kursus->nama }}</td>
                                    <td>{{ $daftar->kursus->harga }}</td>
                                    <td>Belum Dibayar</td>
                                    <td>
                                        <a href="{{ route('siswa.pembayaran.create', $daftar->id_kursus) }}" class="btn btn-warning btn-sm">Bayar</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('title', 'Detail Pembayaran')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Pembayaran</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <table class="table table-borderless">
                            <tr>
                                <th>Tanggal Pembayaran</th>
                                <td>{{ $pembayaran->created_at->format('d-m-Y') }}</td>
                            </tr>
                            <tr>
                                <th>Nama Kursus</th>
                                <td>{{ $pembayaran->kursus->nama }}</td>
                            </tr>
                            <tr>
                                <th>Jumlah Pembayaran</th>
                                <td>{{ $pembayaran->jumlah_pembayaran }}</td>
                            </tr>
                            <tr>
                                <th>Status Pembayaran</th>
                                <td>{{ $pembayaran->status_pembayaran }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="border p-2">
                            <label for="bukti_pembayaran">Bukti Pembayaran</label>
                            <br>
                            @if($pembayaran->bukti_pembayaran)
                                <a href="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" alt="Bukti Pembayaran" class="img-fluid rounded" style="width: 200px; max-height: 400px; object-fit: cover;">
                                </a>
                            @else
                                <p>Bukti Pembayaran Tidak Tersedia</p>
                            @endif
                        </div>
                    </div>
                </div>
                <a href="{{ route('siswa.pembayaran.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
@endsection

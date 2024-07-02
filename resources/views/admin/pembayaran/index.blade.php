@extends('layouts.app')

@section('title', 'Pembayaran')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Pembayaran</h3>
            <a href="{{ route('admin.pembayaran.create') }}" class="btn btn-primary float-right">Tambah Pembayaran</a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form method="GET" action="{{ route('admin.pembayaran.index') }}" class="form-inline mb-3">
                <div class="form-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari Pengguna atau Kursus" value="{{ request()->search }}">
                </div>
                <button type="submit" class="btn btn-secondary ml-2">Cari</button>
                <button type="button" class="btn btn-secondary ml-2" onclick="window.print()">Print</button>
            </form>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Pengguna</th>
                            <th>Kursus</th>
                            <th>Jumlah Pembayaran</th>
                            <th>Status Pembayaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $payment)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $payment->created_at->format('d-m-Y') }}</td>
                                <td>{{ $payment->user->nama }}</td>
                                <td>{{ $payment->kursus->nama }}</td>
                                <td>{{ $payment->jumlah_pembayaran }}</td>
                                <td>{{ $payment->status_pembayaran }}</td>
                                <td>
                                    <a href="{{ route('admin.pembayaran.show', $payment->id) }}" class="btn btn-info">Lihat</a>
                                    <a href="{{ route('admin.pembayaran.edit', $payment->id) }}" class="btn btn-warning">Ubah</a>
                                    <form action="{{ route('admin.pembayaran.destroy', $payment->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $payments->links() }}
        </div>
    </div>
@endsection

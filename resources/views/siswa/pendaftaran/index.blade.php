@extends('layouts.app')

@section('title', 'Daftar Pendaftaran Kursus')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Pendaftaran Kursus</h3>
                <a href="{{ route('siswa.kursus.index') }}" class="btn btn-primary float-right">Daftar Kursus Baru</a>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('siswa.pendaftaran.index') }}" class="form-inline mb-3">
                    <div class="form-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari Pendaftaran" value="{{ request()->search }}">
                    </div>
                    <button type="submit" class="btn btn-secondary ml-2">Cari</button>
                </form>
                @if($pendaftaran->isEmpty())
                    <p>Tidak ada pendaftaran kursus ditemukan.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Pendaftaran</th>
                                    <th>Nama Kursus</th>
                                    <th>Status Pembayaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendaftaran as $daftar)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $daftar->created_at->format('d-m-Y') }}</td>
                                        <td>{{ $daftar->kursus->nama }}</td>
                                        <td>{{ $daftar->status_pembayaran }}</td>
                                        <td>
                                            <a href="{{ route('siswa.pendaftaran.show', $daftar->id) }}" class="btn btn-info btn-sm">Lihat</a>
                                            @if($daftar->status_pembayaran != 'sedang diperiksa' && $daftar->status_pembayaran != 'berhasil')
                                                <form action="{{ route('siswa.pendaftaran.destroy', $daftar->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                </form>
                                            @else
                                                <button class="btn btn-secondary btn-sm" disabled>Hapus</button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $pendaftaran->appends(['search' => request()->search])->links() }}
                @endif
            </div>
        </div>
    </div>
@endsection

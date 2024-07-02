@extends('layouts.app')

@section('title', 'Materi Kursus')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Materi Kursus</h3>
                <a href="{{ route('guru.materi.create', ['id_kursus' => request()->id_kursus]) }}" class="btn btn-primary float-right">Tambah Materi</a>
            </div>
            <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
                <form method="GET" action="{{ route('guru.materi.index') }}" class="form-inline mb-3">
                    <div class="form-group mr-2">
                        <input type="text" name="search" class="form-control" placeholder="Cari Materi" value="{{ request()->search }}">
                    </div>
                    <div class="form-group mr-2">
                        <select name="kursus_filter" class="form-control">
                            <option value="">Semua Kursus</option>
                            @foreach($all_kursus as $kursus)
                                <option value="{{ $kursus->id }}" {{ request()->kursus_filter == $kursus->id ? 'selected' : '' }}>{{ $kursus->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-secondary">Cari</button>
                </form>
                @if($materi->isEmpty())
                    <p>Tidak ada materi ditemukan.</p>
                @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Materi</th>
                                <th>Deskripsi</th>
                                <th>Kursus</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($materi as $index => $m)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $m->nama }}</td>
                                    <td>{{ Str::limit($m->deskripsi, 50) }}</td>
                                    <td>{{ $m->kursus->nama }}</td>
                                    <td>
                                        <a href="{{ route('guru.materi.show', $m->id) }}" class="btn btn-info btn-sm">Lihat</a>
                                        <a href="{{ route('guru.materi.edit', $m->id) }}" class="btn btn-warning btn-sm">Ubah</a>
                                        <form action="{{ route('guru.materi.destroy', $m->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $materi->appends(['search' => request()->search, 'kursus_filter' => request()->kursus_filter])->links() }}
                @endif
            </div>
        </div>
    </div>
@endsection

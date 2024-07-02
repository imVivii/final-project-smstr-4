@extends('layouts.app')

@section('title', 'Informasi')

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="GET" action="{{ route('siswa.informasi.index') }}" class="form-inline mb-3">
                <div class="form-group">
                    <input type="text" name="search" class="form-control" placeholder="cari nama informasi " value="{{ request()->search }}">
                </div>
                <button type="submit" class="btn btn-secondary ml-2">Cari</button>
            </form>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($informations as $information)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $information->nama }}</td>
                                <td>
                                    <a href="{{ route('siswa.informasi.show', $information->id) }}" class="btn btn-info">Lihat</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $informations->links() }}
        </div>
    </div>
@endsection

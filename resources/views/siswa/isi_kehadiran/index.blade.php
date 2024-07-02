@extends('layouts.app')

@section('title', 'Daftar Kehadiran Saya')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Kehadiran Saya</h3>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kursus</th>
                            <th>Tanggal Kehadiran</th>
                            <th>Status Kehadiran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($isiKehadiran as $index => $kehadiran)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $kehadiran->kehadiran->kursus->nama }}</td>
                                <td>{{ \Carbon\Carbon::parse($kehadiran->kehadiran->tanggal)->format('d-m-Y') }}</td>
                                <td>{{ ucfirst($kehadiran->status) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $isiKehadiran->links() }}
        </div>
    </div>
</div>
@endsection

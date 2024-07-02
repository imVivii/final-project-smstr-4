@extends('layouts.app')

@section('title', 'Daftar Nilai')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Nilai</h3>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if($penilaian->isEmpty())
                    <p>Tidak ada nilai ditemukan.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kursus</th>
                                    <th>Nilai</th>
                                    <th>Komentar</th>
                                    <th>Status Kelulusan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($penilaian as $index => $nilai)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $nilai->pengumpulanTugas->tugas->kursus->nama }}</td>
                                        <td>{{ $nilai->nilai }}</td>
                                        <td>{{ $nilai->komentar }}</td>
                                        <td class="
                                            @if($nilai->nilai == 0) bg-danger text-white
                                            @elseif($nilai->nilai < 75) bg-warning
                                            @else bg-success text-white
                                            @endif
                                        ">
                                            @if($nilai->nilai == 0)
                                                Tidak Lulus
                                            @elseif($nilai->nilai < 75)
                                                Perbaikan
                                            @else
                                                Lulus
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $penilaian->links() }} <!-- Menambahkan navigasi paginasi -->
                @endif
            </div>
        </div>
    </div>
@endsection

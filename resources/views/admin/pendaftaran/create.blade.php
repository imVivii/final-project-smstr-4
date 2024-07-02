@extends('layouts.app')

@section('title', 'Tambah Pendaftaran')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tambah Pendaftaran</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.pendaftaran.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="id_user">Nama Pengguna</label>
                        <select class="form-control" name="id_user" required>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_kursus">Nama Kursus</label>
                        <select class="form-control" name="id_kursus" required>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.pendaftaran.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection

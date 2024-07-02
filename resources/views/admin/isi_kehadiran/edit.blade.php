@extends('layouts.app')

@section('title', 'Ubah Kehadiran')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Ubah Kehadiran</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.isi_kehadiran.update', $kehadiran->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="kehadiran_id">Pilih Kehadiran</label>
                    <select name="kehadiran_id" id="kehadiran_id" class="form-control" required>
                        @foreach($allKehadiran as $item)
                            <option value="{{ $item->id }}" {{ $kehadiran->kehadiran_id == $item->id ? 'selected' : '' }}>
                                {{ $item->kursus->nama }} - {{ $item->tanggal }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="user_id">Pilih Siswa</label>
                    <select name="user_id" id="user_id" class="form-control" required>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ $kehadiran->user_id == $user->id ? 'selected' : '' }}>
                                {{ $user->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="status">Status Kehadiran</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="hadir" {{ $kehadiran->status == 'hadir' ? 'selected' : '' }}>Hadir</option>
                        <option value="tidak hadir" {{ $kehadiran->status == 'tidak hadir' ? 'selected' : '' }}>Tidak Hadir</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection

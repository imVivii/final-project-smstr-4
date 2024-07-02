@extends('layouts.app')

@section('title', 'Edit Kehadiran')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Kehadiran</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.kehadiran.update', ['kehadiran' => $kehadiran->id]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="kursus_id">Pilih Kursus</label>
                    <select name="kursus_id" id="kursus_id" class="form-control" required>
                        @foreach($kursus as $course)
                            <option value="{{ $course->id }}" {{ $course->id == $kehadiran->kursus_id ? 'selected' : '' }}>{{ $course->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ $kehadiran->tanggal }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>
@endsection

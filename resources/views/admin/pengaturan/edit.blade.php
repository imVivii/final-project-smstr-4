@extends('layouts.app')

@section('title', 'Pengaturan')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Pengaturan</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.pengaturan.update') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="app_name">Nama Website</label>
                    <input type="text" name="app_name" id="app_name" class="form-control" value="{{ old('app_name', env('APP_NAME', 'Default App Name')) }}" required>
                </div>
                <div class="form-group">
                    <label for="app_logo">Logo Website</label>
                    <input type="file" name="app_logo" id="app_logo" class="form-control-file">
                    @if(env('APP_LOGO'))
                        @php
                            $logoPath = env('APP_LOGO', 'vendor/admin-lte/img/AdminLTELogo.png');
                            $logoUrl = Storage::url($logoPath);
                        @endphp
                        <img src="{{ url('storage/' . config('app.logo', 'vendor/admin-lte/img/AdminLTELogo.png')) }}" alt="Application Logo" class="mt-2" width="200">
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('title', 'Detail Informasi')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Detail Informasi</h3>
    </div>
    <div class="card-body">
        <div class="form-group">
            <!-- <label for="gambar">Gambar</label> -->
            @if($information->gambar)
                <img src="{{ asset('storage/' . $information->gambar) }}" alt="{{ $information->nama }}" class="img-fluid mx-auto d-block" style="max-width: 100%; height: auto; border-radius: 15px 15px 0 0;">
            @else
                <p>N/A</p>
            @endif
        </div>
        <div class="form-group">
            <!-- <label for="nama">Nama</label> -->
            <p style="font-size: 0.875rem;">"🚀 {{ $information->nama }} 🚀"</p>
        </div>
        <div class="form-group">
            <!-- <label for="deskripsi">Deskripsi</label> -->
            <p style="font-size: 0.875rem;">{!! nl2br(e($information->deskripsi)) !!}</p>
        </div>
    </div>
</div>

@endsection

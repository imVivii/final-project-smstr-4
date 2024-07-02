@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-bold" style="font-size: 1.875rem;">{{ __('Selamat Datang') }} {{ Auth::user()->nama ?? 'Guest' }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h4>{{ __('Informasi Terbaru') }}</h4>
                    @foreach($informations as $information)
                        <div class="alert alert-info" role="alert">
                            @if($information->gambar)
                                <div class="text-center mb-3">
                                    <img src="{{ asset('storage/' . $information->gambar) }}" alt="{{ $information->nama }}" class="img-fluid mx-auto d-block" style="max-width: 100%; height: auto; border-radius: 15px 15px 0 0;">
                                </div>
                            @else
                                <p class="text-center">N/A</p>
                            @endif
                            <div class="p-3" style="background-color: white; border-radius: 0 0 15px 15px; border: 1px solid #ccc;">
                                <p style="font-size: 0.875rem;"><strong>"🚀 {{ $information->nama }} 🚀"</strong></p>
                                <p style="font-size: 0.875rem;">{!! nl2br(e($information->deskripsi)) !!}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container">
    <div class="row">
        <!-- Box for total users -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card shadow-sm border text-center" style="background-color: #f8f9fa; height: 100%;">
                <div class="card-body d-flex flex-column align-items-center justify-content-center">
                    <i class="fas fa-users fa-3x mb-3" style="color: #007bff;"></i>
                    <h5 class="card-title">Total Pengguna</h5>
                    <p class="card-text" style="font-size: 2rem;">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>
        <!-- Box for total courses -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card shadow-sm border text-center" style="background-color: #e9f7ef; height: 100%;">
                <div class="card-body d-flex flex-column align-items-center justify-content-center">
                    <i class="fas fa-book-open fa-3x mb-3" style="color: #28a745;"></i>
                    <h5 class="card-title">Total Kursus</h5>
                    <p class="card-text" style="font-size: 2rem;">{{ $totalCourses }}</p>
                </div>
            </div>
        </div>
        <!-- Box for total teachers -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card shadow-sm border text-center" style="background-color: #e7f3fe; height: 100%;">
                <div class="card-body d-flex flex-column align-items-center justify-content-center">
                    <i class="fas fa-chalkboard-teacher fa-3x mb-3" style="color: #007bff;"></i>
                    <h5 class="card-title">Jumlah Guru</h5>
                    <p class="card-text" style="font-size: 2rem;">{{ $totalTeachers }}</p>
                </div>
            </div>
        </div>
         <!-- Box for total students -->
         <div class="col-lg-3 col-md-6 mb-4">
            <div class="card shadow-sm border text-center" style="background-color: #fef9e7; height: 100%;">
                <div class="card-body d-flex flex-column align-items-center justify-content-center">
                    <i class="fas fa-user-graduate fa-3x mb-3" style="color: #ffc107;"></i>
                    <h5 class="card-title">Jumlah Siswa</h5>
                    <p class="card-text" style="font-size: 2rem;">{{ $totalStudents }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card shadow-sm border" style="background-color: #f8f9fa;">
                <div class="card-header">
                    <h5 class="card-title mb-0">Kursus Terbaru</h5>
                </div>
                <div class="card-body">
                    @if($recentCourses->isEmpty())
                        <p>Tidak ada kursus terbaru.</p>
                    @else
                        <ul class="list-group">
                            @foreach($recentCourses as $course)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>{{ $course->nama }}</span>
                                    <a href="{{ route('admin.kursus.show', $course->id) }}" class="btn btn-sm btn-info">Lihat Kursus</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card shadow-sm border" style="background-color: #f8f9fa;">
                <div class="card-header">
                    <h5 class="card-title mb-0">Pengguna Terbaru</h5>
                </div>
                <div class="card-body">
                    @if($recentUsers->isEmpty())
                        <p>Tidak ada pengguna terbaru.</p>
                    @else
                        <ul class="list-group">
                            @foreach($recentUsers as $user)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>{{ $user->name ?? $user->nama }}</span>
                                    <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-sm btn-info">Lihat Pengguna</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card shadow-sm border" style="background-color: #f8f9fa;">
                <div class="card-header">
                    <h5 class="card-title mb-0">Pendaftaran Terbaru</h5>
                </div>
                <div class="card-body">
                    @if($recentRegistrations->isEmpty())
                        <p>Tidak ada pendaftaran terbaru.</p>
                    @else
                        <ul class="list-group">
                            @foreach($recentRegistrations as $registration)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>{{ $registration->user->nama }} - {{ $registration->kursus->nama }}</span>
                                    <a href="{{ route('admin.pendaftaran.show', $registration->id) }}" class="btn btn-sm btn-info">Lihat Pendaftaran</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card shadow-sm border" style="background-color: #f8f9fa;">
                <div class="card-header">
                    <h5 class="card-title mb-0">Pembayaran Terbaru</h5>
                </div>
                <div class="card-body">
                    @if($recentPayments->isEmpty())
                        <p>Tidak ada pembayaran terbaru.</p>
                    @else
                        <ul class="list-group">
                            @foreach($recentPayments as $payment)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>{{ $payment->user->nama }} - {{ $payment->kursus->nama }}</span>
                                    <a href="{{ route('admin.pembayaran.show', $payment->id) }}" class="btn btn-sm btn-info">Lihat Pembayaran</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<!-- Tambahkan FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endpush

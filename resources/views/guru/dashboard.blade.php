@extends('layouts.app')

@section('title', 'Dashboard Guru')

@section('content')
<div class="container">
    <div class="row">
        <!-- Box for total courses -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow-sm border text-center" style="background-color: #f8f9fa; height: 100%;">
                <div class="card-body d-flex flex-column align-items-center justify-content-center">
                    <i class="fas fa-book-open fa-3x mb-3" style="color: #007bff;"></i>
                    <h5 class="card-title">Total Kursus</h5>
                    <p class="card-text" style="font-size: 2rem;">{{ $totalCourses }}</p>
                </div>
            </div>
        </div>
        <!-- Box for total tasks -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow-sm border text-center" style="background-color: #e9f7ef; height: 100%;">
                <div class="card-body d-flex flex-column align-items-center justify-content-center">
                    <i class="fas fa-tasks fa-3x mb-3" style="color: #28a745;"></i>
                    <h5 class="card-title">Total Tugas</h5>
                    <p class="card-text" style="font-size: 2rem;">{{ $totalTasks }}</p>
                </div>
            </div>
        </div>
        <!-- Box for upcoming attendance -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow-sm border text-center" style="background-color: #fef9e7; height: 100%;">
                <div class="card-body d-flex flex-column align-items-center justify-content-center">
                    <i class="fas fa-calendar-alt fa-3x mb-3" style="color: #ffc107;"></i>
                    <h5 class="card-title">Kehadiran yang Akan Datang</h5>
                    <p class="card-text" style="font-size: 2rem;">{{ $upcomingAttendance }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- Box for recent courses -->
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
                                    <a href="{{ route('guru.kursus.show', $course->id) }}" class="btn btn-sm btn-info">Lihat Kursus</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
        <!-- Box for recent tasks -->
        <div class="col-md-12 mb-4">
            <div class="card shadow-sm border" style="background-color: #f8f9fa;">
                <div class="card-header">
                    <h5 class="card-title mb-0">Tugas Terbaru</h5>
                </div>
                <div class="card-body">
                    @if($recentTasks->isEmpty())
                        <p>Tidak ada tugas terbaru.</p>
                    @else
                        <ul class="list-group">
                            @foreach($recentTasks as $task)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>{{ $task->judul }}</span>
                                    <a href="{{ route('guru.tugas.show', $task->id) }}" class="btn btn-sm btn-info">Lihat Tugas</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
        <!-- Box for recent submissions -->
        <div class="col-md-12 mb-4">
            <div class="card shadow-sm border" style="background-color: #f8f9fa;">
                <div class="card-header">
                    <h5 class="card-title mb-0">Pengumpulan Tugas Terbaru</h5>
                </div>
                <div class="card-body">
                    @if($recentSubmissions->isEmpty())
                        <p>Tidak ada pengumpulan tugas terbaru.</p>
                    @else
                        <ul class="list-group">
                            @foreach($recentSubmissions as $submission)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>{{ $submission->tugas->judul }} oleh {{ $submission->user->nama }}</span>
                                    <a href="{{ route('guru.pengumpulan_tugas.show', $submission->id) }}" class="btn btn-sm btn-info">Lihat Tugas</a>
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

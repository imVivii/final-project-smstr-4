<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kursus;
use App\Models\Tugas;
use App\Models\Kehadiran;
use App\Models\PengumpulanTugas;
use Illuminate\Support\Facades\Auth;

class DashboardGuruController extends Controller
{
    public function dashboard()
    {
        $guruId = Auth::id();

        $totalCourses = Kursus::where('user_id', $guruId)->count();
        $totalTasks = Tugas::whereHas('kursus', function ($query) use ($guruId) {
            $query->where('user_id', $guruId);
        })->count();
        $upcomingAttendance = Kehadiran::whereHas('kursus', function ($query) use ($guruId) {
            $query->where('user_id', $guruId);
        })->where('tanggal', '>', now())->count();
        $recentCourses = Kursus::where('user_id', $guruId)->orderBy('created_at', 'desc')->take(5)->get();
        $recentTasks = Tugas::whereHas('kursus', function ($query) use ($guruId) {
            $query->where('user_id', $guruId);
        })->orderBy('created_at', 'desc')->take(5)->get();
        $recentSubmissions = PengumpulanTugas::whereHas('tugas.kursus', function ($query) use ($guruId) {
            $query->where('user_id', $guruId);
        })->orderBy('created_at', 'desc')->take(5)->get();

        return view('guru.dashboard', compact('totalCourses', 'totalTasks', 'upcomingAttendance', 'recentCourses', 'recentTasks', 'recentSubmissions'));
    }

}
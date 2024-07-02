<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Kursus;
use App\Models\Tugas;
use App\Models\Kehadiran;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardSiswaController extends Controller
{
    public function dashboard()
    {
        $userId = Auth::id();
        
        $totalCourses = Pendaftaran::where('id_user', $userId)
            ->where('status_kursus', 'Aktif')
            ->count();
        
        $totalTasks = Tugas::whereHas('kursus.pendaftaran', function ($query) use ($userId) {
            $query->where('id_user', $userId)
                  ->where('status_kursus', 'Aktif');
        })->count();
        
        $availableAttendance = Kehadiran::whereHas('kursus.pendaftaran', function ($query) use ($userId) {
            $query->where('id_user', $userId)
                  ->where('status_kursus', 'Aktif');
        })->whereDate('tanggal', Carbon::today())->count();
        
        $recentCourses = Pendaftaran::where('id_user', $userId)
            ->where('status_kursus', 'Aktif')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        $recentTasks = Tugas::whereHas('kursus.pendaftaran', function ($query) use ($userId) {
            $query->where('id_user', $userId)
                  ->where('status_kursus', 'Aktif');
        })->orderBy('created_at', 'desc')
          ->take(5)
          ->get();

        // Ambil kehadiran yang tersedia hari ini
        $todayAttendances = Kehadiran::whereHas('kursus.pendaftaran', function ($query) use ($userId) {
            $query->where('id_user', $userId)
                  ->where('status_kursus', 'Aktif');
        })->whereDate('tanggal', Carbon::today())->get();

        return view('siswa.dashboard', compact('totalCourses', 'totalTasks', 'availableAttendance', 'recentCourses', 'recentTasks', 'todayAttendances'));
    }
}

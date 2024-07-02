<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kursus;
use App\Models\Tugas;
use App\Models\Pendaftaran;
use App\Models\Pembayaran;

class DashboardAdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalCourses = Kursus::count();
        $totalStudents = User::where('role', 'siswa')->count();
        $totalTeachers = User::where('role', 'guru')->count();
        $totalTasks = Tugas::count();

        $recentUsers = User::orderBy('created_at', 'desc')->take(5)->get();
        $recentCourses = Kursus::orderBy('created_at', 'desc')->take(5)->get();
        $recentRegistrations = Pendaftaran::orderBy('created_at', 'desc')->take(5)->get();
        $recentPayments = Pembayaran::orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.dashboard', compact('totalUsers', 'totalCourses', 'totalStudents', 'totalTeachers', 'totalTasks', 'recentUsers', 'recentCourses', 'recentRegistrations', 'recentPayments'));
    }
}

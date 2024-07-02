<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Kursus;

class AdminDashboardController extends Controller
{
    public function getUserCount()
    {
        $userCount = User::count();
        return response()->json(['count' => $userCount]);
    }

    public function getGuruCount()
    {
        $guruCount = Guru::count();
        return response()->json(['count' => $guruCount]);
    }

    public function getSiswaCount()
    {
        $siswaCount = Siswa::count();
        return response()->json(['count' => $siswaCount]);
    }

    public function getKursusCount()
    {
        $kursusCount = Kursus::count();
        return response()->json(['count' => $kursusCount]);
    }
}

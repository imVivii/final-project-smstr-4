<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminPengaturanController extends Controller
{
    public function edit()
    {
        return view('admin.pengaturan.edit');
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'app_name' => 'required|string|max:255',
            'app_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Simpan nama aplikasi
        $appName = $validated['app_name'];

        if ($request->hasFile('app_logo')) {
            // Hapus file logo lama jika ada dan bukan file default
            $currentLogo = env('APP_LOGO', 'vendor/admin-lte/img/AdminLTELogo.png');
            if ($currentLogo && $currentLogo != 'vendor/admin-lte/img/AdminLTELogo.png') {
                Storage::disk('public')->delete($currentLogo);
            }

            // Simpan file logo baru
            $file = $request->file('app_logo');
            $path = $file->store('logos', 'public');
            $appLogo = $path;
        } else {
            $appLogo = env('APP_LOGO', 'vendor/admin-lte/img/AdminLTELogo.png');
        }

        // Simpan pengaturan ke file .env
        $envPath = base_path('.env');
        if (file_exists($envPath)) {
            file_put_contents($envPath, preg_replace(
                '/^APP_NAME=.*/m',
                'APP_NAME="'.$appName.'"',
                file_get_contents($envPath)
            ));
            file_put_contents($envPath, preg_replace(
                '/^APP_LOGO=.*/m',
                'APP_LOGO="'.$appLogo.'"',
                file_get_contents($envPath)
            ));
        }

        return redirect()->route('admin.dashboard')->with('success', 'Settings updated successfully!');
    }

}
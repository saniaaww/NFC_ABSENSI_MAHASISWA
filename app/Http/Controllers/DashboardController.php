<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Absensi;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMahasiswa = Mahasiswa::count();

        $hadirHariIni = Absensi::whereDate(
            'waktu_absen',
            today()
        )->count();

        $belumHadir =
            $totalMahasiswa -
            $hadirHariIni;

        $riwayat = Absensi::with('mahasiswa')
                    ->latest()
                    ->take(10)
                    ->get();

                    
        return view(
            'dashboard',
            compact(
                'totalMahasiswa',
                'hadirHariIni',
                'belumHadir',
                'riwayat'
            )
        );
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Absensi;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
     public function index()
    {
        $absensi = Absensi::with('mahasiswa')
                    ->latest()
                    ->get();

        return view(
            'absensi.index',
            compact('absensi')
        );
    }
    public function dashboard()
    {
        $mahasiswa = Mahasiswa::count();

        $absensiHariIni = Absensi::whereDate(
            'waktu_absen',
            now()
        )->count();

        $riwayat = Absensi::with('mahasiswa')
                    ->latest()
                    ->take(10)
                    ->get();

        return view(
            'dashboard',
            compact(
                'mahasiswa',
                'absensiHariIni',
                'riwayat'
            )
        );
    }

    public function stream()
    {
        return response()->stream(

            function () {

                while (true) {

                    if (connection_aborted()) {
                        break;
                    }

                    $data = \App\Models\Absensi::with(
                                'mahasiswa'
                            )
                            ->latest()
                            ->take(10)
                            ->get();

                    echo "data: " .
                        json_encode($data)
                        . "\n\n";

                    ob_flush();
                    flush();

                    sleep(2);
                }

            },

            200,

            [

                'Cache-Control' => 'no-cache',

                'Content-Type' => 'text/event-stream',

                'X-Accel-Buffering' => 'no'

            ]

        );
    }
}
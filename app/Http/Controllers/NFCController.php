<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Absensi;

class NFCController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HALAMAN SCAN ABSENSI
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        return view('scan');
    }

    /*
    |--------------------------------------------------------------------------
    | PROSES SCAN ABSENSI
    |--------------------------------------------------------------------------
    */

    public function scan(Request $request)
    {
        $serial = trim($request->serial);

        $mahasiswa = Mahasiswa::where(
            'serial_nfc',
            $serial
        )->first();

        if (!$mahasiswa) {

            return response()->json([
                'status' => false,
                'message' => 'Kartu tidak dikenal',
                'serial' => $serial
            ]);
        }

        Absensi::create([
            'mahasiswa_id' => $mahasiswa->id,
            'waktu_absen' => now()
        ]);

        return response()->json([
            'status' => true,
            'nama' => $mahasiswa->nama,
            'nim' => $mahasiswa->nim
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | HALAMAN REGISTRASI NFC
    |--------------------------------------------------------------------------
    */

    public function register()
    {
        return view('register-nfc');
    }

    /*
    |--------------------------------------------------------------------------
    | SIMPAN KARTU NFC
    |--------------------------------------------------------------------------
    */

    public function storeRegister(Request $request)
    {
        $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'serial_nfc' => 'required'
        ]);

        Mahasiswa::create([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'serial_nfc' => trim($request->serial_nfc)
        ]);

        return redirect()
            ->back()
            ->with(
                'success',
                'Mahasiswa berhasil didaftarkan'
            );
    }
}
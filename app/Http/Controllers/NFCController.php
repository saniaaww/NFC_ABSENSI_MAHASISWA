<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Absensi;

class NFCController extends Controller
{

    public function index()
    {

        return view('scan');

    }

    public function scan(Request $request)
    {

        $serial = $request->serial;

        $mahasiswa = Mahasiswa::where(
                            'serial_nfc',
                            $serial
                        )->first();

        if(!$mahasiswa){

            return response()->json([
                'status' => false,
                'message' => 'Kartu tidak dikenal'
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

    public function register()
{
    return view('register-nfc');
}

public function storeRegister(Request $request)
{
    Mahasiswa::create([

        'nim' => $request->nim,

        'nama' => $request->nama,

        'serial_nfc' => $request->serial_nfc

    ]);

    return redirect()
            ->back()
            ->with(
                'success',
                'Mahasiswa berhasil didaftarkan'
            );
}

}
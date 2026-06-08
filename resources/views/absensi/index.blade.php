@extends('layouts.app')

@section('content')

<h2 class="mb-4">

    Riwayat Absensi

</h2>

<table class="table table-bordered">

    <thead>

        <tr>

            <th>Nama</th>
            <th>NIM</th>
            <th>Waktu Absen</th>

        </tr>

    </thead>

    <tbody>

        @forelse($absensi as $item)

        <tr>

            <td>

                {{ $item->mahasiswa->nama }}

            </td>

            <td>

                {{ $item->mahasiswa->nim }}

            </td>

            <td>

                {{ $item->waktu_absen }}

            </td>

        </tr>

        @empty

        <tr>

            <td colspan="3">

                Belum ada data

            </td>

        </tr>

        @endforelse

    </tbody>

</table>

@endsection
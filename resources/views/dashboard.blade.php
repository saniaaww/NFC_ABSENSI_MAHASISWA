@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- Header -->

    <div class="row mb-4">

        <div class="col-md-8">

            <h2 class="fw-bold text-primary">

                Dashboard Absensi NFC

            </h2>

            <p class="text-muted">

                Monitoring Kehadiran Mahasiswa Universitas Airlangga

            </p>

        </div>

        <div class="col-md-4">

            <div class="card border-0 shadow-sm">

                <div class="card-body text-center">

                    <h5 class="mb-0" id="jam"></h5>

                </div>

            </div>

        </div>

    </div>

    <!-- Statistik -->

    <div class="row">

        <div class="col-lg-4 mb-4">

            <div class="card border-0 shadow h-100 bg-primary text-white">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <small>Total Mahasiswa</small>

                            <h1 class="fw-bold">

                                {{ $totalMahasiswa }}

                            </h1>

                        </div>

                        <i class="fa-solid fa-users fa-3x"></i>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-lg-4 mb-4">

            <div class="card border-0 shadow h-100 bg-warning text-white">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <small>Hadir Hari Ini</small>

                            <h1 class="fw-bold">

                                {{ $hadirHariIni }}

                            </h1>

                        </div>

                        <i class="fa-solid fa-user-check fa-3x"></i>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-lg-4 mb-4">

            <div class="card border-0 shadow h-100 bg-info text-white">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <small>Belum Hadir</small>

                            <h1 class="fw-bold">

                                {{ $belumHadir }}

                            </h1>

                        </div>

                        <i class="fa-solid fa-user-clock fa-3x"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Riwayat Absensi -->

    <div class="card border-0 shadow">

        <div class="card-header bg-white">

            <h5 class="mb-0">

                Riwayat Absensi Terbaru

            </h5>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>

                        <tr>

                            <th>Nama</th>

                            <th>NIM</th>

                            <th>Waktu Absen</th>

                        </tr>

                    </thead>

                    <tbody id="absensi-body">

                        @forelse($riwayat as $item)

                        <tr>

                            <td>

                                {{ $item->mahasiswa->nama }}

                            </td>

                            <td>

                                {{ $item->mahasiswa->nim }}

                            </td>

                            <td>

                                {{ date('d-m-Y H:i', strtotime($item->waktu_absen)) }}

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="3"
                                class="text-center text-muted">

                                Belum ada data absensi

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<!-- Jam realtime -->

<script>

function updateJam()
{
    const now = new Date();

    document.getElementById('jam').innerHTML =
        now.toLocaleString('id-ID');
}

setInterval(updateJam,1000);

updateJam();

</script>

<script>

const source =
    new EventSource(
        '/stream-absensi'
    );

source.onmessage =
function(event)
{
    let data =
        JSON.parse(
            event.data
        );

    let html = '';

    data.forEach(item => {

        html += `

        <tr>

            <td>

                ${item.mahasiswa.nama}

            </td>

            <td>

                ${item.mahasiswa.nim}

            </td>

            <td>

                ${item.waktu_absen}

            </td>

        </tr>

        `;

    });

    document
        .getElementById(
            'absensi-body'
        )
        .innerHTML = html;

};

</script>

@endsection
@extends('layouts.app')

@section('content')

<div class="row justify-content-center">

    <div class="col-md-8">

        <div class="card shadow border-0">

            <div class="card-body text-center p-5">

                <h2>Scan KTM NFC</h2>

                <p class="text-muted">
                    Tempel kartu mahasiswa
                </p>

                <div id="hasil" class="alert alert-secondary">
                    Belum scan
                </div>

                <button
                    class="btn btn-primary"
                    onclick="startNfc()">

                    Aktifkan NFC

                </button>

            </div>

        </div>

    </div>

</div>

<script>

async function startNfc()
{
    const hasil =
        document.getElementById('hasil');

    hasil.innerHTML =
        'Memeriksa browser...';

    if (!window.isSecureContext)
    {
        hasil.innerHTML =
        `
        <div class="alert alert-danger">
            Website harus HTTPS
        </div>
        `;
        return;
    }

    if (!('NDEFReader' in window))
    {
        hasil.innerHTML =
        `
        <div class="alert alert-warning">
            Browser tidak mendukung Web NFC
        </div>
        `;
        return;
    }

    try
    {
        const ndef = new NDEFReader();

        await ndef.scan();

        hasil.innerHTML =
        `
        <div class="alert alert-success">
            NFC Aktif<br>
            Tempel kartu sekarang
        </div>
        `;

        ndef.onreading = async ({ serialNumber }) =>
{
    hasil.innerHTML =
    `
    <div class="alert alert-info">
        Mengirim absensi...
    </div>
    `;

    const response = await fetch('/scan', {

        method: 'POST',

        headers: {

            'Content-Type': 'application/json',

            'X-CSRF-TOKEN':
                '{{ csrf_token() }}'

        },

        body: JSON.stringify({

            serial: serialNumber

        })

    });

    const data = await response.json();

    if(data.status)
    {
        hasil.innerHTML =
        `
        <div class="alert alert-success">

            Absensi Berhasil<br>

            <strong>${data.nama}</strong><br>

            ${data.nim}

        </div>
        `;
    }
    else
    {
        hasil.innerHTML =
        `
        <div class="alert alert-danger">

            ${data.message}

        </div>
        `;
    }
};

    }
    catch(error)
    {
        hasil.innerHTML =
        `
        <div class="alert alert-danger">
            ${error.message}
        </div>
        `;
    }
}

</script>

@endsection
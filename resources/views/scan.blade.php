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

        ndef.onreading = ({ serialNumber }) =>
        {
            hasil.innerHTML =
            `
            <div class="alert alert-success">
                UID Kartu:<br>
                <strong>${serialNumber}</strong>
            </div>
            `;
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
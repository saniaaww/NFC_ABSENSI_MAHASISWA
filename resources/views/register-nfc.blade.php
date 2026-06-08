@extends('layouts.app')

@section('content')

<div class="container">

    <div class="card shadow border-0">

        <div class="card-header bg-primary text-white">

            <h4>

                Registrasi Kartu NFC

            </h4>

        </div>

        <div class="card-body">

            @if(session('success'))

            <div class="alert alert-success">

                {{ session('success') }}

            </div>

            @endif

            <form action="/register-nfc"
                  method="POST">

                @csrf

                <div class="mb-3">

                    <label>

                        UID NFC

                    </label>

                    <input
                        type="text"
                        id="serial_nfc"
                        name="serial_nfc"
                        class="form-control"
                        readonly
                        required>

                </div>

                <div class="mb-3">

                    <label>

                        NIM

                    </label>

                    <input
                        type="text"
                        name="nim"
                        class="form-control"
                        required>

                </div>

                <div class="mb-3">

                    <label>

                        Nama Mahasiswa

                    </label>

                    <input
                        type="text"
                        name="nama"
                        class="form-control"
                        required>

                </div>

                <button
                    class="btn btn-primary">

                    Simpan

                </button>

            </form>

        </div>

    </div>

</div>

<script>

async function startNFC()
{
    if ('NDEFReader' in window)
    {
        try {

            const ndef =
                new NDEFReader();

            await ndef.scan();

            console.log(
                'NFC Aktif'
            );

            ndef.onreading =
            ({ serialNumber }) =>
            {

                document
                .getElementById(
                    'serial_nfc'
                )
                .value =
                serialNumber;

            };

        }
        catch(err)
        {
            console.log(err);
        }
    }
}

startNFC();

</script>

@endsection
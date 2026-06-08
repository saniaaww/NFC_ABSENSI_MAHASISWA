@extends('layouts.app')

@section('content')

<h2 class="mb-4">

    Edit Mahasiswa

</h2>

<form action="/mahasiswa/{{ $mahasiswa->id }}"
      method="POST">

    @csrf

    @method('PUT')

    <div class="mb-3">

        <label>NIM</label>

        <input
            type="text"
            name="nim"
            value="{{ $mahasiswa->nim }}"
            class="form-control">

    </div>

    <div class="mb-3">

        <label>Nama</label>

        <input
            type="text"
            name="nama"
            value="{{ $mahasiswa->nama }}"
            class="form-control">

    </div>

    <div class="mb-3">

        <label>Serial NFC</label>

        <input
            type="text"
            name="serial_nfc"
            value="{{ $mahasiswa->serial_nfc }}"
            class="form-control">

    </div>

    <button
        class="btn btn-primary">

        Update

    </button>

</form>

@endsection
@extends('layouts.app')

@section('content')

<h2 class="mb-4">

    Tambah Mahasiswa

</h2>

<form action="/mahasiswa"
      method="POST">

    @csrf

    <div class="mb-3">

        <label>NIM</label>

        <input type="text"
               name="nim"
               class="form-control">

    </div>

    <div class="mb-3">

        <label>Nama</label>

        <input type="text"
               name="nama"
               class="form-control">

    </div>

    <div class="mb-3">

        <label>Serial NFC</label>

        <input type="text"
               name="serial_nfc"
               class="form-control">

    </div>

    <button
        class="btn btn-success">

        Simpan

    </button>

</form>

@endsection
@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between mb-3">

    <h2>Data Mahasiswa</h2>

    <a href="/mahasiswa/create"
       class="btn btn-primary">

        Tambah Mahasiswa

    </a>

</div>

<div class="card shadow">

    <div class="card-body">

        <table class="table">

            <thead>

                <tr>

                    <th>NIM</th>

                    <th>Nama</th>

                    <th>Serial NFC</th>

                    <th>Aksi</th>

                </tr>

            </thead>

            <tbody>

                @foreach($mahasiswa as $m)

                <tr>

                    <td>

                        {{ $m->nim }}

                    </td>

                    <td>

                        {{ $m->nama }}

                    </td>

                    <td>

                        {{ $m->serial_nfc }}

                    </td>

                    <td>

                        <a href="/mahasiswa/{{ $m->id }}/edit"
                           class="btn btn-warning btn-sm">

                            Edit

                        </a>

                        <form
                            action="/mahasiswa/{{ $m->id }}"
                            method="POST"
                            style="display:inline;">

                            @csrf
                            @method('DELETE')

                            <button
                                class="btn btn-danger btn-sm">

                                Hapus

                            </button>

                        </form>

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection
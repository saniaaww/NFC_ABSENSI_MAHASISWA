<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1">

<title>Absensi NFC UNAIR</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

:root{

    --unair-blue:#003f88;
    --unair-yellow:#f4b400;
}

body{

    background:#f5f7fa;
    overflow-x:hidden;
}

.sidebar{

    width:260px;
    min-height:100vh;

    background:var(--unair-blue);

    transition:.3s;
}

.sidebar.collapsed{

    width:80px;
}

.sidebar .logo{

    color:white;

    font-size:22px;

    font-weight:bold;
}

.sidebar a{

    color:white;

    text-decoration:none;

    display:block;

    padding:14px;

    border-radius:10px;

    margin-bottom:8px;
}

.sidebar a:hover{

    background:rgba(255,255,255,.15);
}

.sidebar.collapsed .menu-text{

    display:none;
}

.content{

    flex:1;
}

.topbar{

    background:white;

    border-radius:15px;

    padding:15px;

    box-shadow:0 2px 10px rgba(0,0,0,.08);
}

.card-stat{

    border:none;

    border-radius:20px;

    color:white;

    overflow:hidden;
}

.card-blue{

    background:var(--unair-blue);
}

.card-yellow{

    background:var(--unair-yellow);
}

.card-lightblue{

    background:#3b82f6;
}

.table-card{

    background:white;

    border-radius:20px;

    box-shadow:0 2px 10px rgba(0,0,0,.08);
}

</style>

</head>

<body>

<div class="d-flex">

    <div class="sidebar p-3"
         id="sidebar">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div class="logo">

                🎓 <span class="menu-text">ABSENSI NFC</span>

            </div>

        </div>

        <a href="/">

            <i class="fa-solid fa-gauge"></i>

            <span class="menu-text">

                Dashboard

            </span>

        </a>

        <a href="/mahasiswa">

            <i class="fa-solid fa-users"></i>

            <span class="menu-text">

                Mahasiswa

            </span>

        </a>

        <a href="/scan">

            <i class="fa-solid fa-id-card"></i>

            <span class="menu-text">

                Scan NFC

            </span>

        </a>

        <a href="/absensi">

            <i class="fa-solid fa-list"></i>

            <span class="menu-text">

                Riwayat

            </span>

        </a>

            <a href="/register-nfc">
                <i class="fa-solid fa-address-card"></i>
                <span class="menu-text">
                    Registrasi NFC
                </span>
            </a>

    </div>

    <div class="content p-4">

        <div class="topbar mb-4 d-flex justify-content-between">

            <button
                class="btn btn-warning"
                onclick="toggleSidebar()">

                <i class="fa-solid fa-bars"></i>

            </button>

            <h5 class="m-0">

                Sistem Absensi NFC Universitas Airlangga

            </h5>

        </div>

        @yield('content')

    </div>

</div>

<script>

function toggleSidebar(){

    document
        .getElementById('sidebar')
        .classList
        .toggle('collapsed');
}

</script>

</body>

</html>
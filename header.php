<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['login'])) {
    echo "<script>
            alert('Silahkan login terlebih dahulu!');
            window.location.href = 'index.php';
          </script>";
    exit;
}

$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Penggajian - Annisa 026</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .navbar {
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .navbar-nav .nav-link.active {
            font-weight: bold;
            color: #fff !important;
            background-color: #0d6efd; /* Warna biru primer */
            border-radius: 5px;
        }

        .navbar-brand {
            font-weight: 800;
            letter-spacing: 1px;
        }

        .container.main-content {
            margin-top: 40px;
            min-height: 75vh;
        }

    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container">
        
        <a class="navbar-brand text-info" href="home.php">
            Annisa_026
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMain">
           
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?= $current_page == 'home.php' ? 'active' : '' ?>" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($current_page == 'tampil_pengguna.php' || $current_page == 'form_pengguna.php') ? 'active' : '' ?>" href="tampil_pengguna.php">Pengguna</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($current_page == 'tampil_jabatan.php' || $current_page == 'form_jabatan.php') ? 'active' : '' ?>" href="tampil_jabatan.php">Jabatan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($current_page == 'tampil_karyawan.php' || $current_page == 'form_karyawan.php') ? 'active' : '' ?>" href="tampil_karyawan.php">Karyawan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $current_page == 'form_transaksi.php' ? 'active' : '' ?>" href="form_transaksi.php">Transaksi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $current_page == 'laporan_penggajian.php' ? 'active' : '' ?>" href="laporan_penggajian.php">Laporan</a>
                </li>
            </ul>
            
           
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="btn btn-outline-danger btn-sm px-3" href="logout.php" onclick="return confirm('Anda yakin ingin keluar dari aplikasi?')">
                        <i class="bi bi-box-arrow-right"></i> Keluar
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container main-content">
<?php
require 'koneksi.php'; 

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $stmt = mysqli_prepare($koneksi, "DELETE FROM tbl_jabatan_annisa WHERE id_jabatan = ?");
    mysqli_stmt_bind_param($stmt, "s", $id);
    
    if(mysqli_stmt_execute($stmt)){
        echo "<script>alert('Data Jabatan Berhasil Dihapus!'); window.location='tampil_jabatan.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus! Data mungkin masih digunakan di tabel karyawan.'); window.location='tampil_jabatan.php';</script>";
    }
} else {
    header("Location: tampil_jabatan.php");
}
?>

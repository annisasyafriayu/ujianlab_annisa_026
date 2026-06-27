<?php
require 'koneksi.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    
    $stmt = mysqli_prepare($koneksi, "DELETE FROM tbl_karyawan_annisa WHERE id_karyawan = ?");
    mysqli_stmt_bind_param($stmt, "s", $id);
    
    if(mysqli_stmt_execute($stmt)){
        echo "<script>alert('Karyawan Berhasil Dihapus!'); window.location='tampil_karyawan.php';</script>";
    } else {
        echo "<script>alert('Gagal Hapus: ".mysqli_error($koneksi)."'); window.location='tampil_karyawan.php';</script>";
    }
} else {
    header("Location: tampil_karyawan.php");
}
?>

<?php
require 'koneksi.php';
if(isset($_GET['id_karyawan'])) {
    $id = $_GET['id_karyawan'];
    $query = "SELECT k.*, j.nama_jabatan, j.gaji_pokok, j.tunjangan_jabatan 
              FROM tbl_karyawan_annisa k 
              JOIN tbl_jabatan_annisa j ON k.id_jabatan = j.id_jabatan 
              WHERE k.id_karyawan = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    echo json_encode(mysqli_fetch_assoc($result));
}
?>

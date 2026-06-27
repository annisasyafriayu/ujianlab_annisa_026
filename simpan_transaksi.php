<?php
include 'koneksi.php';


$id_transaksi = $_POST['id_transaksi'];
$tanggal = $_POST['tanggal'];
$id_karyawan = $_POST['id_karyawan'];
$tunj_anak = $_POST['tunjangan_anak'];
$bpjs = $_POST['bpjs'];
$total = $_POST['total_pendapatan'];


$query = "INSERT INTO tbl_transaksi_annisa (id_transaksi, tanggal, id_karyawan, tunjangan_anak, bpjs, total_pendapatan) 
          VALUES ('$id_transaksi', '$tanggal', '$id_karyawan', '$tunj_anak', '$bpjs', '$total')";

if(mysqli_query($conn, $query)){
    echo "<script>alert('Transaksi Berhasil Disimpan!'); window.location='home.php';</script>";
} else {
    echo "Gagal menyimpan transaksi: " . mysqli_error($conn);
}
?>

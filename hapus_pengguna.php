<?php
include 'koneksi.php';


$id = $_GET['id'];

$query = "DELETE FROM tbl_user_annisa WHERE id_user = '$id'";

if (mysqli_query($conn, $query)) {
    echo "<script>alert('Data Berhasil Dihapus!'); window.location='tampil_pengguna.php';</script>";
} else {
    echo "Gagal menghapus: " . mysqli_error($conn);
}
?>

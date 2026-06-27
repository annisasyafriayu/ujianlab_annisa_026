<?php
include 'koneksi.php';

if (isset($_POST['btn_simpan'])) {
    $id_jabatan = mysqli_real_escape_string($conn, $_POST['id_jabatan']);
    $nama_jabatan = mysqli_real_escape_string($conn, $_POST['nama_jabatan']);
    $gaji_pokok = $_POST['gaji_pokok'];
    $tunjangan_jabatan = $_POST['tunjangan_jabatan'];

    $cek = mysqli_query($conn, "SELECT * FROM tbl_jabatan_annisa WHERE id_jabatan = '$id_jabatan' OR nama_jabatan = '$nama_jabatan'");

    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Error: ID atau Nama Jabatan sudah ada! Gunakan data lain.'); window.history.back();</script>";
    } else {
        $sql = "INSERT INTO tbl_jabatan_annisa (id_jabatan, nama_jabatan, gaji_pokok, tunjangan_jabatan) 
                VALUES ('$id_jabatan', '$nama_jabatan', '$gaji_pokok', '$tunjangan_jabatan')";
        
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Berhasil! Jabatan baru telah ditambahkan.'); window.location='tampil_jabatan.php';</script>";
        } else {
            echo "Gagal menyimpan: " . mysqli_error($conn);
        }
    }
} else {
    header("location:form_jabatan.php");
}
?>

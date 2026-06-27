<?php
include 'koneksi.php';

if (isset($_POST['btn_simpan'])) {
    
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $id_jabatan = $_POST['id_jabatan'];
    $status = $_POST['status'];
    $anak = $_POST['jumlah_anak'];

    $cek_data = mysqli_query($conn, "SELECT * FROM tbl_karyawan_annisa WHERE nama = '$nama'");

    if (mysqli_num_rows($cek_data) > 0) {
        echo "<script>
                alert('Gagal! Nama Karyawan [$nama] sudah ada di database.');
                window.location='form_karyawan.php';
              </script>";
    } else {
        $insert = mysqli_query($conn, "INSERT INTO tbl_karyawan_annisa (nama, id_jabatan, status, jumlah_anak) 
                                       VALUES ('$nama', '$id_jabatan', '$status', '$anak')");
        
        if ($insert) {
            echo "<script>
                    alert('Berhasil! Data karyawan baru telah disimpan.');
                    window.location='tampil_karyawan.php';
                  </script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
} else {
    header("location:form_karyawan.php");
}
?>

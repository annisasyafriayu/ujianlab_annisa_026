<?php
include 'koneksi.php';

if (isset($_POST['simpan'])) {

    $user = $_POST['user_name'];
    $mail = $_POST['email'];
    $pass = $_POST['password'];

    $query = "INSERT INTO tbl_user_annisa (user_name, email, password) 
              VALUES ('$user', '$mail', '$pass')";

    if (mysqli_query($conn, $query)) {

        echo "<script>alert('Data Berhasil Disimpan!'); window.location='tampil_pengguna.php';</script>";
    } else {

        echo "Error: " . mysqli_error($conn);
    }
}
?>

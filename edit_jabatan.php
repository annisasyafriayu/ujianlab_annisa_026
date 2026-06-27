<?php 
include 'koneksi.php';
$id = $_GET['id'];
$data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tbl_jabatan_annisa WHERE id_jabatan='$id'"));
?>
<!DOCTYPE html>
<html>
<head><title>Edit Jabatan</title></head>
<body>
    <h3>Edit Jabatan</h3>
    <form method="POST">
        Nama Jabatan: <input type="text" name="nama_jabatan" value="<?php echo $data['nama_jabatan']; ?>" required><br>
        Gaji Pokok: <input type="number" name="gaji_pokok" value="<?php echo $data['gaji_pokok']; ?>" required><br>
        Tunjangan: <input type="number" name="tunjangan_jabatan" value="<?php echo $data['tunjangan_jabatan']; ?>" required><br>
        <button type="submit" name="update">Update</button>
    </form>
    <?php
    if(isset($_POST['update'])){
        $nama = $_POST['nama_jabatan'];
        $gaji = $_POST['gaji_pokok'];
        $tunj = $_POST['tunjangan_jabatan'];
        mysqli_query($conn, "UPDATE tbl_jabatan_annisa SET nama_jabatan='$nama', gaji_pokok='$gaji', tunjangan_jabatan='$tunj' WHERE id_jabatan='$id'");
        echo "<script>alert('Data Diupdate'); window.location='tampil_jabatan.php';</script>";
    }
    ?>
</body>
</html>

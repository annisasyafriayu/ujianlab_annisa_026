<?php 
include 'koneksi.php';
$id = $_GET['id']; 
$tampil = mysqli_query($conn, "SELECT * FROM tbl_karyawan_annisa WHERE id_karyawan='$id'");
$data = mysqli_fetch_array($tampil);
?>

<form method="POST">
    Nama: <input type="text" name="nama" value="<?php echo $data['nama']; ?>" required><br>
    <button type="submit" name="update">Simpan Perubahan</button>
</form>

<?php
if(isset($_POST['update'])){
    $nama_baru = $_POST['nama'];
    
    $update = mysqli_query($conn, "UPDATE tbl_karyawan_annisa SET nama='$nama_baru' WHERE id_karyawan='$id'");
    
    if($update){
        echo "<script>alert('Data Diupdate'); window.location='tampil_karyawan.php';</script>";
    }
}
?>

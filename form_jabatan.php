<?php 
include 'header.php'; 
require 'koneksi.php'; 

$id = ""; $nama = ""; $gaji = ""; $tunj = ""; $is_edit = false;

if(isset($_GET['id'])){
    $is_edit = true;
    $stmt = mysqli_prepare($koneksi, "SELECT * FROM tbl_jabatan_annisa WHERE id_jabatan = ?");
    mysqli_stmt_bind_param($stmt, "s", $_GET['id']);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    if($data = mysqli_fetch_assoc($res)){
        $id = $data['id_jabatan']; $nama = $data['nama_jabatan']; $gaji = $data['gaji_pokok']; $tunj = $data['tunjangan_jabatan'];
    }
}

if(isset($_POST['save'])){
    $id_jbt = $_POST['id_jabatan'];
    $nama_jbt = $_POST['nama_jabatan'];
    $gapok = $_POST['gaji_pokok'];
    $tunj_jbt = $_POST['tunjangan_jabatan'];

    if($_POST['mode'] == "edit"){
        $sql = "UPDATE tbl_jabatan_annisa SET nama_jabatan=?, gaji_pokok=?, tunjangan_jabatan=? WHERE id_jabatan=?";
        $stmt = mysqli_prepare($koneksi, $sql);
        mysqli_stmt_bind_param($stmt, "siis", $nama_jbt, $gapok, $tunj_jbt, $id_jbt);
    } else {
        $sql = "INSERT INTO tbl_jabatan_annisa VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($koneksi, $sql);
        mysqli_stmt_bind_param($stmt, "ssii", $id_jbt, $nama_jbt, $gapok, $tunj_jbt);
    }
    
    if(mysqli_stmt_execute($stmt)){
        echo "<script>alert('Data Berhasil Disimpan'); window.location='tampil_jabatan.php';</script>";
    }
}
?>
<div class="card shadow-sm mx-auto" style="max-width: 500px;">
    <div class="card-header bg-primary text-white"><h5>Form Jabatan</h5></div>
    <div class="card-body">
        <form method="POST">
            <input type="hidden" name="mode" value="<?= $is_edit ? 'edit' : 'add' ?>">
            <div class="mb-3">
                <label>ID Jabatan</label>
                <input type="text" name="id_jabatan" class="form-control" value="<?= $id ?>" <?= $is_edit ? 'readonly' : '' ?> required placeholder="Contoh: JBT-01">
            </div>
            <div class="mb-3">
                <label>Nama Jabatan</label>
                <input type="text" name="nama_jabatan" class="form-control" value="<?= $nama ?>" required>
            </div>
            <div class="mb-3">
                <label>Gaji Pokok</label>
                <input type="number" name="gaji_pokok" class="form-control" value="<?= $gaji ?>" required>
            </div>
            <div class="mb-3">
                <label>Tunjangan Jabatan</label>
                <input type="number" name="tunjangan_jabatan" class="form-control" value="<?= $tunj ?>" required>
            </div>
            <button type="submit" name="save" class="btn btn-success">Simpan Jabatan</button>
            <a href="tampil_jabatan.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
<?php include 'footer.php'; ?>

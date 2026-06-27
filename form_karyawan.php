<?php 
include 'header.php'; 
require 'koneksi.php'; 

$id_karyawan = ""; $nama = ""; $id_jabatan = ""; $status = ""; $jumlah_anak = 0;
$is_edit = false;

if(isset($_GET['id'])){
    $is_edit = true;
    $stmt = mysqli_prepare($koneksi, "SELECT * FROM tbl_karyawan_annisa WHERE id_karyawan = ?");
    mysqli_stmt_bind_param($stmt, "s", $_GET['id']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if($data = mysqli_fetch_assoc($result)){
        $id_karyawan = $data['id_karyawan'];
        $nama = $data['nama'];
        $id_jabatan = $data['id_jabatan'];
        $status = $data['status'];
        $jumlah_anak = $data['jumlah_anak'];
    }
}

if(isset($_POST['simpan'])){
    $id_kry = $_POST['id_karyawan'];
    $nm = $_POST['nama'];
    $jbt = $_POST['id_jabatan'];
    $st = $_POST['status'];
    $anak = $_POST['jumlah_anak'];

    if($_POST['mode'] == "edit"){
        $query = "UPDATE tbl_karyawan_annisa SET nama=?, id_jabatan=?, status=?, jumlah_anak=? WHERE id_karyawan=?";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, "sssis", $nm, $jbt, $st, $anak, $_POST['id_lama']);
    } else {
        $query = "INSERT INTO tbl_karyawan_annisa VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, "ssssi", $id_kry, $nm, $jbt, $st, $anak);
    }

    if(mysqli_stmt_execute($stmt)){
        echo "<script>alert('Data Berhasil Disimpan'); window.location='tampil_karyawan.php';</script>";
    }
}
?>

<div class="card mx-auto border-dark" style="max-width: 600px; border: 1px solid #000;">
    <div class="card-header bg-white border-bottom border-dark">
        <h6 class="mb-0"><?= $is_edit ? 'Edit Data Karyawan' : 'Tambah Data Karyawan' ?></h6>
    </div>
    <div class="card-body">
        <form method="POST">
            <input type="hidden" name="mode" value="<?= $is_edit ? 'edit' : 'add' ?>">
            <input type="hidden" name="id_lama" value="<?= $id_karyawan ?>">
->
            <div class="row mb-3">
                <label class="col-sm-4 col-form-label">id_karyawan</label>
                <div class="col-sm-8">
                    <input type="text" name="id_karyawan" class="form-control border-dark" value="<?= $id_karyawan ?>" required>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-4 col-form-label">nama</label>
                <div class="col-sm-8">
                    <input type="text" name="nama" class="form-control border-dark" value="<?= $nama ?>" required>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-4 col-form-label">id_jabatan</label>
                <div class="col-sm-8">
                    <select name="id_jabatan" class="form-select border-dark" required>
                        <option value="">-- Pilih Jabatan --</option>
                        <?php 
                        $q_jbt = mysqli_query($koneksi, "SELECT * FROM tbl_jabatan_annisa");
                        while($rj = mysqli_fetch_array($q_jbt)){
                            $sel = ($rj['id_jabatan'] == $id_jabatan) ? "selected" : "";
                            echo "<option value='$rj[id_jabatan]' $sel>$rj[nama_jabatan]</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-4 col-form-label">status</label>
                <div class="col-sm-8">
                    <select name="status" class="form-select border-dark" required>
                        <option value="Kawin" <?= $status == 'Kawin' ? 'selected' : '' ?>>Kawin</option>
                        <option value="Belum Kawin" <?= $status == 'Belum Kawin' ? 'selected' : '' ?>>Belum Kawin</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-4 col-form-label">jumlah_anak</label>
                <div class="col-sm-8">
                    <input type="number" name="jumlah_anak" class="form-control border-dark" value="<?= $jumlah_anak ?>" min="0">
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" name="simpan" class="btn btn-outline-dark px-4 rounded-pill">Simpan</button>
                <a href="tampil_karyawan.php" class="btn btn-outline-dark px-4 rounded-pill">Batal</a>
            </div>
        </form>
    </div>

</div>

<?php include 'footer.php'; ?>
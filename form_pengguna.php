<?php 
include 'header.php'; 
require 'koneksi.php'; 

$id_p = ""; $un = ""; $ps = ""; $lvl = ""; $is_edit = false;

if(isset($_GET['id'])){
    $is_edit = true;
    $stmt = mysqli_prepare($koneksi, "SELECT * FROM tbl_user_annisa WHERE id_user = ?");
    mysqli_stmt_bind_param($stmt, "s", $_GET['id']);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    if($data = mysqli_fetch_assoc($res)){
        $id_p = $data['id_user'];
        $un = $data['username'];
        $lvl = $data['level'];
    }
}

if(isset($_POST['simpan'])){
    $id_input = $_POST['id_pengguna'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level    = $_POST['level'];
    $email    = $username . "@yahoo.com"; // Email otomatis agar tidak error unique

    if($_POST['mode'] == "edit"){
        if(!empty($password)){
            $stmt = mysqli_prepare($koneksi, "UPDATE tbl_user_annisa SET username=?, password=?, level=? WHERE id_user=?");
            mysqli_stmt_bind_param($stmt, "ssss", $username, $password, $level, $_POST['id_lama']);
        } else {
            $stmt = mysqli_prepare($koneksi, "UPDATE tbl_user_annisa SET username=?, level=? WHERE id_user=?");
            mysqli_stmt_bind_param($stmt, "sss", $username, $level, $_POST['id_lama']);
        }
    } else {

        $stmt = mysqli_prepare($koneksi, "INSERT INTO tbl_user_annisa (id_user, username, email, password, level) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sssss", $id_input, $username, $email, $password, $level);
    }

    if(mysqli_stmt_execute($stmt)){
        echo "<script>alert('Data Berhasil Disimpan!'); window.location='tampil_pengguna.php';</script>";
    } else {
        echo "<div class='alert alert-danger'>Gagal menyimpan: " . mysqli_error($koneksi) . "</div>";
    }
}
?>

<div class="card shadow-sm mx-auto" style="max-width: 500px; border: 1px solid #000;">
    <div class="card-header bg-white border-bottom">
        <h6 class="mb-0">Tambah Data Pengguna</h6>
    </div>
    <div class="card-body">
        <form method="POST">
            <input type="hidden" name="mode" value="<?= $is_edit ? 'edit' : 'add' ?>">
            <input type="hidden" name="id_lama" value="<?= $id_p ?>">

            <div class="row mb-3">
                <label class="col-sm-4 col-form-label">id_pengguna</label>
                <div class="col-sm-8">
                    <!-- id_pengguna sekarang bisa diisi manual -->
                    <input type="text" name="id_pengguna" class="form-control" value="<?= $id_p ?>" required>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-4 col-form-label">username</label>
                <div class="col-sm-8">
                    <input type="text" name="username" class="form-control" value="<?= $un ?>" required>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-4 col-form-label">password</label>
                <div class="col-sm-8">
                    <input type="password" name="password" class="form-control" <?= $is_edit ? '' : 'required' ?>>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-4 col-form-label">level</label>
                <div class="col-sm-8">
                    <select name="level" class="form-select" required>
                        <option value="">-- Pilih Level --</option>
                        <option value="Admin" <?= $lvl == 'Admin' ? 'selected' : '' ?>>Admin</option>
                        <option value="Operator" <?= $lvl == 'Operator' ? 'selected' : '' ?>>Operator</option>
                    </select>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" name="simpan" class="btn btn-light border px-4">Simpan</button>
                <a href="tampil_pengguna.php" class="btn btn-light border px-4">Batal</a>
            </div>
        </form>
    </div>

</div>

<?php include 'footer.php'; ?>
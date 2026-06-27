<?php 
include 'header.php'; 
require 'koneksi.php'; 

if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];
    $stmt = mysqli_prepare($koneksi, "DELETE FROM tbl_user_annisa WHERE id_user = ?");
    mysqli_stmt_bind_param($stmt, "s", $id);
    
    if(mysqli_stmt_execute($stmt)){
        echo "<script>alert('Data Berhasil Dihapus'); window.location='tampil_pengguna.php';</script>";
    }
}
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold">List Data Pengguna</h5>

        <a href="form_pengguna.php" class="btn btn-outline-dark px-4 rounded-pill">Tambah</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered border-dark align-middle">
            <thead class="text-center fw-bold">
                <tr>
                    <th style="width: 50px;">No</th>
                    <th>id_pengguna</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Level</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;

                $query = "SELECT * FROM tbl_user_annisa ORDER BY id_user ASC";
                $sql = mysqli_query($koneksi, $query);

                if(mysqli_num_rows($sql) > 0) {
                    while($d = mysqli_fetch_array($sql)){
                        echo "<tr>
                            <td class='text-center'>$no.</td>
                            <td>$d[id_user]</td>
                            <td>$d[username]</td>
                            <td>$d[password]</td>
                            <td>$d[level]</td>
                            <td class='text-center'>
                                <a href='form_pengguna.php?id=$d[id_user]' class='text-decoration-none text-dark'>Edit</a> 
                                | 
                                <a href='tampil_pengguna.php?hapus=$d[id_user]' class='text-decoration-none text-dark' onclick=\"return confirm('Yakin ingin menghapus?')\">Hapus</a>
                            </td>
                        </tr>";
                        $no++;
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>Data tidak ditemukan.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</div>

<?php include 'footer.php'; ?>
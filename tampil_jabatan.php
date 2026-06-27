<?php 
include 'header.php'; 
require 'koneksi.php'; 

if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];

    $stmt = mysqli_prepare($koneksi, "DELETE FROM tbl_jabatan_annisa WHERE id_jabatan = ?");
    mysqli_stmt_bind_param($stmt, "s", $id);
    
    if(mysqli_stmt_execute($stmt)){
        echo "<script>alert('Data Jabatan Berhasil Dihapus'); window.location='tampil_jabatan.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus! Data ini mungkin masih digunakan di tabel karyawan.'); window.location='tampil_jabatan.php';</script>";
    }
}
?>

<div class="container mt-4">
ar -->
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h5 class="fw-normal">List Data Jabatan</h5>
        <a href="form_jabatan.php" class="btn btn-outline-dark px-4 rounded-pill btn-sm">Tambah</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered border-dark align-middle">
            <thead class="text-center">
                <tr>
                    <th style="width: 50px;">No</th>
                    <th>id_jabatan</th>
                    <th>Nama Jabatan^</th>
                    <th>Gaji</th>
                    <th>Tunjangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;

                $query = "SELECT * FROM tbl_jabatan_annisa ORDER BY id_jabatan ASC";
                $sql = mysqli_query($koneksi, $query);

                if(mysqli_num_rows($sql) > 0) {
                    while($d = mysqli_fetch_array($sql)){
                        echo "<tr>
                            <td class='text-center'>$no.</td>
                            <td>$d[id_jabatan]</td>
                            <td>$d[nama_jabatan]</td>
                            <td class='text-start'>".number_format($d['gaji_pokok'], 0, '', '')."</td>
                            <td class='text-start'>".number_format($d['tunjangan_jabatan'], 0, '', '')."</td>
                            <td class='text-center'>
                                <a href='form_jabatan.php?id=$d[id_jabatan]' class='text-decoration-none text-dark small'>Edit</a> 
                                <span class='mx-1'>|</span> 
                                <a href='tampil_jabatan.php?hapus=$d[id_jabatan]' class='text-decoration-none text-dark small' onclick=\"return confirm('Yakin ingin menghapus data jabatan ini?')\">Hapus</a>
                            </td>
                        </tr>";
                        $no++;
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>Data jabatan kosong.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</div>

<?php include 'footer.php'; ?>
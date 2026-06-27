<?php 
include 'header.php'; 
require 'koneksi.php'; 

if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];
    $stmt = mysqli_prepare($koneksi, "DELETE FROM tbl_karyawan_annisa WHERE id_karyawan = ?");
    mysqli_stmt_bind_param($stmt, "s", $id);
    
    if(mysqli_stmt_execute($stmt)){
        echo "<script>alert('Data Karyawan Berhasil Dihapus'); window.location='tampil_karyawan.php';</script>";
    }
}
?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-2">
        <h5 class="fw-normal">List Data Karyawan</h5>
        <a href="form_karyawan.php" class="btn btn-outline-dark px-4 rounded-pill btn-sm">Tambah</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered border-dark align-middle">
            <thead class="text-center">
                <tr>
                    <th style="width: 40px;">No</th>
                    <th>id_karyawan</th>
                    <th>Nama Karyawan^</th>
                    <th>Jabatan</th>
                    <th>Gaji</th>
                    <th>Tunjangan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;

                $query = "SELECT k.*, j.nama_jabatan, j.gaji_pokok, j.tunjangan_jabatan 
                          FROM tbl_karyawan_annisa k 
                          JOIN tbl_jabatan_annisa j ON k.id_jabatan = j.id_jabatan 
                          ORDER BY k.id_karyawan ASC";
                
                $sql = mysqli_query($koneksi, $query);

                if(mysqli_num_rows($sql) > 0) {
                    while($d = mysqli_fetch_array($sql)){
                        echo "<tr>
                            <td class='text-center'>$no.</td>
                            <td>$d[id_karyawan]</td>
                            <td>$d[nama]</td>
                            <td>$d[nama_jabatan]</td>
                            <td class='text-start'>".number_format($d['gaji_pokok'], 0, ',', '.')."</td>
                            <td class='text-start'>".number_format($d['tunjangan_jabatan'], 0, ',', '.')."</td>
                            <td>$d[status]</td>
                            <td class='text-center'>
                                <a href='form_karyawan.php?id=$d[id_karyawan]' class='text-decoration-none text-dark small'>Edit</a> 
                                <span class='mx-1'>|</span> 
                                <a href='tampil_karyawan.php?hapus=$d[id_karyawan]' class='text-decoration-none text-dark small' onclick=\"return confirm('Yakin hapus data karyawan ini?')\">Hapus</a>
                            </td>
                        </tr>";
                        $no++;
                    }
                } else {
                    echo "<tr><td colspan='8' class='text-center'>Data karyawan tidak tersedia.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</div>

<?php include 'footer.php'; ?>
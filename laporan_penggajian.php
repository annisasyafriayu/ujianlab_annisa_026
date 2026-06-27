<?php 
include 'header.php'; 
require 'koneksi.php'; // Pastikan file ini ada dan variabelnya $koneksi
?>

<div class="text-center mb-4">
    <h3 class="fw-bold">LAPORAN PENGGAJIAN KARYAWAN</h3>
    <button onclick="window.print()" class="btn btn-secondary d-print-none">Cetak Laporan</button>
</div>

<table class="table table-bordered border-dark">
    <thead class="text-center fw-bold bg-light">
        <tr>
            <th>No</th>
            <th>ID Transaksi</th>
            <th>Tanggal</th>
            <th>Nama Karyawan</th>
            <th>Tunjangan Anak</th>
            <th>BPJS (4%)</th>
            <th>Total Diterima</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;

        $query = "SELECT t.*, k.nama FROM tbl_transaksi_annisa t 
                  JOIN tbl_karyawan_annisa k ON t.id_karyawan = k.id_karyawan 
                  ORDER BY t.id_transaksi ASC";
        
        $sql = mysqli_query($koneksi, $query);

        if(mysqli_num_rows($sql) > 0) {
            while($d = mysqli_fetch_array($sql)){
                echo "<tr class='text-center'>
                    <td>$no</td>
                    <td>$d[id_transaksi]</td>
                    <td>".date('d-m-Y', strtotime($d['tanggal']))."</td>
                    <td class='text-start'>$d[nama]</td>
                    <td class='text-end'>".number_format($d['tunjangan_anak'])."</td>
                    <td class='text-end'>".number_format($d['bpjs'])."</td>
                    <td class='text-end fw-bold'>".number_format($d['total_pendapatan'])."</td>
                </tr>";
                $no++;
            }
        } else {
            echo "<tr><td colspan='7' class='text-center'>Belum ada data transaksi.</td></tr>";
        }
        ?>
    </tbody>
</table>

<style>
@media print {
    .d-print-none, .navbar, footer { display: none !important; }
    table { width: 100%; border-collapse: collapse; }
}
</style>

<?php include 'footer.php'; ?>

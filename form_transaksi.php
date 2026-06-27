<?php 
include 'header.php'; 
require 'koneksi.php';

$res = mysqli_query($koneksi, "SELECT id_transaksi FROM tbl_transaksi_annisa ORDER BY id_transaksi DESC LIMIT 1");
$row = mysqli_fetch_assoc($res);
$last_id = $row ? (int)substr($row['id_transaksi'], 4) : 0;
$new_id = "TRS-" . str_pad($last_id + 1, 2, "0", STR_PAD_LEFT);

if(isset($_POST['save'])) {
    $stmt = mysqli_prepare($koneksi, "INSERT INTO tbl_transaksi_annisa VALUES (?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sssiis", $_POST['id_transaksi'], $_POST['tanggal'], $_POST['id_karyawan'], $_POST['tunjangan_anak'], $_POST['bpjs'], $_POST['total_pendapatan']);
    
    if(mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Data Berhasil Disimpan!'); window.location='laporan_penggajian.php';</script>";
    }
}
?>

<div class="card mx-auto border-dark" style="max-width: 900px; border: 1px solid #000;">

    <div class="card-header bg-white border-bottom border-dark">
        <h5 class="mb-0 fw-bold text-uppercase">Formulir Transaksi Penggajian</h5>
    </div>
    
    <div class="card-body">
        <form method="POST">
            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="fw-bold small">ID Transaksi</label>
                    <input type="text" name="id_transaksi" class="form-control border-dark bg-light" value="<?= $new_id ?>" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="fw-bold small">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control border-dark" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="fw-bold small">Nama Karyawan</label>
                    <select name="id_karyawan" id="id_karyawan" class="form-select border-dark" onchange="fetchData(this.value)" required>
                        <option value="">-- Pilih Karyawan --</option>
                        <?php 
                        $karyawan = mysqli_query($koneksi, "SELECT * FROM tbl_karyawan_annisa");
                        while($k = mysqli_fetch_assoc($karyawan)) echo "<option value='$k[id_karyawan]'>$k[nama]</option>";
                        ?>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="fw-bold small">Jabatan</label>
                    <input type="text" id="jabatan" class="form-control border-dark bg-light" readonly>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="fw-bold small">Gaji Pokok</label>
                    <input type="number" id="gaji_pokok" class="form-control border-dark bg-light" readonly>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="fw-bold small">Tunjangan Jabatan</label>
                    <input type="number" id="tunjangan_jabatan" class="form-control border-dark bg-light" readonly>
                </div>
                <div class="col-md-2 mb-3">
                    <label class="fw-bold small">Status</label>
                    <input type="text" id="status" class="form-control border-dark bg-light" readonly>
                </div>
                <div class="col-md-2 mb-3">
                    <label class="fw-bold small">Anak</label>
                    <input type="number" id="jumlah_anak" class="form-control border-dark bg-light" readonly>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="fw-bold small">Tunjangan Anak (10% * Gaji * Anak)</label>
                    <input type="number" name="tunjangan_anak" id="tunjangan_anak" class="form-control border-dark bg-light" readonly>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="fw-bold small">BPJS (4% dari Gaji)</label>
                    <input type="number" name="bpjs" id="bpjs" class="form-control border-dark bg-light" readonly>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="fw-bold small">Total Pendapatan</label>
                    <input type="number" name="total_pendapatan" id="total_pendapatan" class="form-control border-dark fw-bold bg-white" readonly>
                </div>
            </div>


            <div class="mt-4">
                <button type="submit" name="save" class="btn btn-outline-dark px-4 rounded-pill">Save</button>
                <a href="home.php" class="btn btn-outline-dark px-4 rounded-pill">Close</a>
            </div>
        </form>
    </div>


</div>

<script>

function fetchData(id) {
    if(!id) return;
    fetch('get_karyawan.php?id_karyawan=' + id)
        .then(response => response.json())
        .then(data => {

            document.getElementById('jabatan').value = data.nama_jabatan;
            document.getElementById('gaji_pokok').value = data.gaji_pokok;
            document.getElementById('tunjangan_jabatan').value = data.tunjangan_jabatan;
            document.getElementById('status').value = data.status;
            document.getElementById('jumlah_anak').value = data.jumlah_anak;

            let gaji = parseInt(data.gaji_pokok);
            let tunj_jab = parseInt(data.tunjangan_jabatan);
            let anak = parseInt(data.jumlah_anak);
            
            let tunj_anak = (data.status === 'Kawin') ? (gaji * 0.1 * anak) : 0;
            let bpjs = gaji * 0.04;
            let total = (gaji + tunj_jab + tunj_anak) - bpjs;

            document.getElementById('tunjangan_anak').value = Math.round(tunj_anak);
            document.getElementById('bpjs').value = Math.round(bpjs);
            document.getElementById('total_pendapatan').value = Math.round(total);
        });
}
</script>

<?php include 'footer.php'; ?>
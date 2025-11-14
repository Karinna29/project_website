<?php
include "koneksi.php";
if (isset($_POST['simpan'])) {
    $nama_siswa = $_POST['nama_siswa'];
    $no_absen    = $_POST['no_absen'];
    $tgl_lahir  = $_POST['tgl_lahir'];
    $alamat    = $_POST['alamat'];
    $telp    = $_POST['telp'];
    $nis    = $_POST['nis'];
    $nisn    = $_POST['nisn'];
    $id_kelas    = $_POST['id_kelas'];

    mysqli_query($koneksi, "INSERT INTO siswa (nama_siswa, no_absen, tgl_lahir, alamat, telp, nis, nisn, id_kelas) VALUES ('$nama_siswa','$no_absen','$tgl_lahir','$alamat','$telp','$nis','$nisn','$id_kelas')");
    header("Location: index.php?page=siswa&pesan=tambah");
    exit;
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <h2 class="mb-4">Tambah Siswa</h2>
    <form method="post">
        <div class="mb-3">
            <label class="form-label">Nama Siswa</label>
            <input type="text" name="nama_siswa" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">No Absen</label>
            <input type="int" name="no_absen" class="form-control" required>
        </div>
         <div class="mb-3">
            <label class="form-label">Tgl Lahir</label>
            <input type="date" name="tgl_lahir" class="form-control" required>
        </div>
         <div class="mb-3">
            <label class="form-label">Alamat</label>
            <input type="text" name="alamat" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Telepon</label>
            <input type="text" name="telp" class="form-control" required>
        </div>
         <div class="mb-3">
            <label class="form-label">NIS</label>
            <input type="int" name="nis" class="form-control" required>
        </div>
         <div class="mb-3">
            <label class="form-label">NISN</label>
            <input type="text" name="nisn" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Kelas</label>
            <select name="id_kelas" class="form-select" required>
                <option value="">-- Pilih Kelas --</option>
                <?php 
                    $kelas = mysqli_query($koneksi, "SELECT * FROM kelas ORDER BY nama_kelas ASC");
                    while ($row = mysqli_fetch_assoc($kelas)) { ?>
                    <option value="<?= $row['id_kelas']; ?>">
                        <?= $row['nama_kelas']; ?> 
                    </option>
                <?php } ?>
            </select>
        </div>

        <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
        <a href="index.php?page=jurusan" class="btn btn-secondary">Kembali</a>
    </form>
</div>

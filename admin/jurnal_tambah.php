<?php
include "koneksi.php";
if (isset($_POST['simpan'])) {
    $id_guru = $_POST['id_guru'];
    $tgl_mengajar  = $_POST['tgl_mengajar'];
    $id_kelas    = $_POST['id_kelas'];
    $materi    = $_POST['materi'];
    $ket    = $_POST['ket'];

    mysqli_query($koneksi, "INSERT INTO jurnal (id_guru, tgl_mengajar, id_kelas, materi, ket) VALUES ('$id_guru','$tgl_mengajar','$id_kelas','$materi','$ket')");
    header("Location: index.php?page=jurnal&pesan=tambah");
    exit;
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <h2 class="mb-4">Tambah Jurnal</h2>
    <form method="post">
       <div class="mb-3">
            <label class="form-label">Guru</label>
            <select name="id_guru" class="form-select" required>
                <option value="">-- Pilih Guru --</option>
                <?php 
                    $guru = mysqli_query($koneksi, "SELECT * FROM guru ORDER BY nama_guru ASC");
                    while ($row = mysqli_fetch_assoc($guru)) { ?>
                    <option value="<?= $row['id_guru']; ?>">
                        <?= $row['nama_guru']; ?> 
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Tanggal Mengajar</label>
            <input type="date" name="tgl_mengajar" class="form-control" required>
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
         <div class="mb-3">
            <label class="form-label">Materi</label>
            <input type="text" name="materi" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Keterangan</label>
            <input type="text" name="ket" class="form-control" required>
        </div>

        <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
        <a href="index.php?page=jurusan" class="btn btn-secondary">Kembali</a>
    </form>
</div>

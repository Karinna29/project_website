<?php
include "../koneksi.php";
if (!isset($_GET['id'])) {
    header("Location: index.php?page=absensi");
    exit;
}

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM absensi WHERE id_absensi=$id"));

if (isset($_POST['update'])) {
    $id_siswa  = $_POST['id_siswa'];
    $tgl_absensi = $_POST['tgl_absensi'];
    $keterangan   = $_POST['keterangan'];

    mysqli_query($koneksi, "UPDATE absensi SET id_siswa='$id_siswa', tgl_absensi='$tgl_absensi', keterangan='$keterangan'WHERE id_absensi=$id");
    header("Location: index.php?page=absensi&pesan=edit");
    exit;
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <h2 class="mb-4">Edit Absensi</h2>
    <form method="post">
        <div class="mb-3">
            <label class="form-label">Siswa</label>
            <select name="id_siswa" class="form-select" required>
                <option value="">-- Pilih Siswa --</option>
                <?php 
                    $siswa = mysqli_query($koneksi, "SELECT * FROM siswa ORDER BY nama_siswa ASC");
                    while ($row = mysqli_fetch_assoc($siswa)) { ?>
                    <option value="<?= $row['id_siswa']; ?>">
                        <?= $row['nama_siswa']; ?> 
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Tanggal Absensi</label>
            <input type="date" name="tgl_absensi" class="form-control" required>
        </div>
         <div class="mb-3">
            <label class="form-label">Keterangan</label>
            <input type="text" name="keterangan" class="form-control" required>
        </div>

        <button type="submit" name="update" class="btn btn-success">Update</button>
        <a href="index.php?page=absensi" class="btn btn-secondary">Kembali</a>
    </form>
</div>

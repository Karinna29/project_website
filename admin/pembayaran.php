<?php
include "koneksi.php";

$cari = "";
if (isset($_GET['cari']) && $_GET['cari'] != "") {
    $cari = $_GET['cari'];
    $result = mysqli_query($koneksi, "
        SELECT pembayaran.*, siswa.nama_siswa, pegawai.nama_pegawai
        FROM pembayaran
        JOIN siswa ON pembayaran.id_siswa = siswa.id_siswa
        JOIN pegawai ON pembayaran.id_pegawai = pegawai.id_pegawai
        WHERE siswa.nama_siswa LIKE '%$cari%'
           OR pegawai.nama_pegawai LIKE '%$cari%'
           OR pembayaran.metode LIKE '%$cari%'
        ORDER BY id_pembayaran DESC
    ");
} else {
    $result = mysqli_query($koneksi, "
        SELECT pembayaran.*, siswa.nama_siswa, pegawai.nama_pegawai
        FROM pembayaran
        JOIN siswa ON pembayaran.id_siswa = siswa.id_siswa
        JOIN pegawai ON pembayaran.id_pegawai = pegawai.id_pegawai
        ORDER BY id_pembayaran DESC
    ");
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-2">
    <h2 class="mb-2 text-center">📚 Data Pembayaran</h2>

    <!-- Notifikasi -->
    <?php if (isset($_GET['pesan'])): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?php 
            if ($_GET['pesan'] == 'tambah') echo "✅ Data pembayaran berhasil ditambahkan!";
            if ($_GET['pesan'] == 'edit') echo "✅ Data pembayaran berhasil diperbarui!";
            if ($_GET['pesan'] == 'hapus') echo "✅ Data pembayaran berhasil dihapus!";
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Pencarian + Tambah -->
    <div class="d-flex justify-content-between mb-3">
        <form class="d-flex" method="get" action="">
            <input type="hidden" name="page" value="pembayaran">
            <input class="form-control me-2" type="search" name="cari" placeholder="Cari siswa, pegawai, atau metode..." value="<?= $cari ?>">
            <button class="btn btn-outline-primary" type="submit">Cari</button>
        </form>
        <a href="pembayaran_tambah.php" class="btn btn-primary">+ Tambah Pembayaran</a>
    </div>

    <!-- Tabel Data -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Siswa</th>
                    <th>Tgl Pembayaran</th>
                    <th>Bulan</th>
                    <th>Nominal</th>
                    <th>Metode</th>
                    <th>Pegawai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $no = 1; 
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row['nama_siswa'] ?></td>
                        <td><?= $row['tgl_pembayaran'] ?></td>
                        <td><?= $row['bulan'] ?></td>
                        <td><?= $row['nominal'] ?></td>
                        <td><?= $row['metode'] ?></td>
                        <td><?= $row['nama_pegawai'] ?></td>
                        <td>
                            <a href="pembayaran_edit.php?id=<?= $row['id_pembayaran'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="pembayaran_hapus.php?id=<?= $row['id_pembayaran'] ?>" 
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('Yakin ingin menghapus pembayaran ini?')">Hapus</a>
                        </td>
                    </tr>
            <?php } 
            } else { ?>
                <tr>
                    <td colspan="8" class="text-center text-muted">⚠ Data tidak ditemukan</td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
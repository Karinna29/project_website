<?php
// Cek apakah ada pencarian
include "koneksi.php";
$cari = "";
if (isset($_GET['cari']) && $_GET['cari'] != "") {
    $cari = $_GET['cari'];
    $result = mysqli_query($koneksi, "SELECT * FROM siswa,kelas
                                      WHERE siswa.id_kelas=kelas.id_kelas
                                      AND nama_siswa LIKE '%$cari%' 
                                      ORDER BY id_siswa DESC");
} else {
    $result = mysqli_query($koneksi, "SELECT * FROM siswa,kelas
     WHERE siswa.id_kelas=kelas.id_kelas 
     ORDER BY id_siswa DESC");
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-2">
    <h2 class="mb-2 text-center">📚 Data Siswa</h2>

    <!-- Notifikasi -->
    <?php if (isset($_GET['pesan'])): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?php 
            if ($_GET['pesan'] == 'tambah') echo "✅ Data siswa berhasil ditambahkan!";
            if ($_GET['pesan'] == 'edit') echo "✅ Data siswa berhasil diperbaharui!";
            if ($_GET['pesan'] == 'hapus') echo "✅ Data siswa berhasil dihapus!";
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Pencarian + Tombol Tambah -->
    <div class="d-flex justify-content-between mb-3">
        <form class="d-flex" method="get" action="">
            <input type="hidden" name="page" value="siswa">
            <input class="form-control me-2" type="search" name="cari" placeholder="Cari siswa..." value="<?= htmlspecialchars($cari) ?>">
            <button class="btn btn-outline-primary" type="submit">Cari</button>
        </form>
        <a href="siswa_tambah.php" class="btn btn-primary">+ Tambah Siswa</a>
    </div>

    <!-- Tabel Data -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>No absen</th>
                    <th>Tgl Lahir</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th>NIS</th>
                    <th>NISN</th>
                    <th>Kelas</th>
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
                        <td><?= $row['no_absen'] ?></td>
                        <td><?= $row['tgl_lahir'] ?></td>
                        <td><?= $row['alamat'] ?></td>
                        <td><?= $row['telp'] ?></td>
                        <td><?= $row['nis'] ?></td>
                        <td><?= $row['nisn'] ?></td>
                        <td><?= $row['id_kelas'] ?></td>
                        <td>
                            <a href="siswa_edit.php?id=<?= $row['id_siswa'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="siswa_hapus.php?id=<?= $row['id_siswa'] ?>" 
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('Yakin ingin menghapus siswa ini?')">Hapus</a>
                        </td>
                    </tr>
            <?php } 
            } else { ?>
                <tr>
                    <td colspan="9" class="text-center text-muted">⚠ Data tidak ditemukan</td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
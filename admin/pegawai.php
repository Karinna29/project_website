<?php
// Cek apakah ada pencarian
include "koneksi.php";
$cari = "";
if (isset($_GET['cari']) && $_GET['cari'] != "") {
    $cari = $_GET['cari'];
    $result = mysqli_query($koneksi, "SELECT * FROM pegawai 
                                      WHERE nama_pegawai LIKE '%$cari%' 
                                      ORDER BY id_pegawai DESC");
} else {
    $result = mysqli_query($koneksi, "SELECT * FROM pegawai ORDER BY id_pegawai DESC");
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-2">
    <h2 class="mb-2 text-center">📚 Data Pegawai</h2>

    <!-- Notifikasi -->
    <?php if (isset($_GET['pesan'])): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?php 
            if ($_GET['pesan'] == 'tambah') echo "✅ Data pegawai berhasil ditambahkan!";
            if ($_GET['pesan'] == 'edit') echo "✅ Data pegawai berhasil diperbaharui!";
            if ($_GET['pesan'] == 'hapus') echo "✅ Data pegawai berhasil dihapus!";
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Pencarian + Tombol Tambah -->
    <div class="d-flex justify-content-between mb-3">
        <form class="d-flex" method="get" action="">
            <input type="hidden" name="page" value="pegawai">
            <input class="form-control me-2" type="search" name="cari" placeholder="Cari pegawai..." value="<?= htmlspecialchars($cari) ?>">
            <button class="btn btn-outline-primary" type="submit">Cari</button>
        </form>
        <a href="pegawai_tambah.php" class="btn btn-primary">+ Tambah pegawai</a>
    </div>

    <!-- Tabel Data -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Pegawai</th>
                    <th>Tanggal Lahir</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th>Username</th>
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
                        <td><?= $row['nama_pegawai'] ?></td>
                        <td><?= $row['tgl_lahir'] ?></td>
                        <td><?= $row['alamat'] ?></td>
                        <td><?= $row['telp'] ?></td>
                        <td><?= $row['username'] ?></td>
                        <td>
                            <a href="pegawai_edit.php?id=<?= $row['id_pegawai'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="pegawai_hapus.php?id=<?= $row['id_pegawai'] ?>" 
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('Yakin ingin menghapus data pegawai ini?')">Hapus</a>
                        </td>
                    </tr>
            <?php } 
            } else { ?>
                <tr>
                    <td colspan="4" class="text-center text-muted">⚠ Data tidak ditemukan</td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
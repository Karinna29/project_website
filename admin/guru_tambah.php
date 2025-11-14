<?php
include "koneksi.php";
if (isset($_POST['simpan'])) {
    $nama_guru = $_POST['nama_guru'];
    $tgl_lahir    = $_POST['tgl_lahir'];
    $alamat    = $_POST['alamat'];
    $telp    = $_POST['telp'];
    $username    = $_POST['username'];
    $password    = md5($_POST['password']);

    mysqli_query($koneksi, "INSERT INTO guru (nama_guru, tgl_lahir, alamat, telp, username, password) VALUES ('$nama_guru','$tgl_lahir','$alamat','$telp','$username','$password')");
    header("Location: index.php?page=guru&pesan=tambah");
    exit;
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <h2 class="mb-4">Tambah Guru</h2>
    <form method="post">
        <div class="mb-3">
            <label class="form-label">Nama Guru</label>
            <input type="text" name="nama_guru" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Tanggal Lahir</label>
            <input type="date" name="tgl_lahir" class="form-control" required>
        </div>
         <div class="mb-3">
            <label class="form-label">Alamat</label>
            <input type="text" name="alamat" class="form-control" required>
        </div>
         <div class="mb-3">
            <label class="form-label">Telepon</label>
            <input type="number" name="telp" class="form-control" required>
        </div>
         <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
         <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="text" name="password" class="form-control" required>
        </div>

        <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
        <a href="index.php?page=jurusan" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?php
session_start();

// Koneksi ke database
$host = "localhost";
$username = "root";
$password = "";
$database = "srinfo";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

$error = "";
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Query untuk mencari pegawai berdasarkan username dan password
    $query = "SELECT * FROM pegawai WHERE username = '$username' AND password = MD5('$password')";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) == 1) {
        $pegawai = mysqli_fetch_assoc($result);
        
        // Simpan data pegawai ke session
        $_SESSION['id_pegawai'] = $pegawai['id_pegawai'];
        $_SESSION['nama_pegawai'] = $pegawai['nama_pegawai'];
        $_SESSION['username'] = $pegawai['username'];
        $_SESSION['role'] = 'pegawai';
        $_SESSION['logged_in'] = true;
        
        // Redirect ke halaman admin
        header("Location: admin.php");
        exit();
    } else {
        $error = "Username atau password salah!";
    }
    
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="login.css">
    <style>
        /* Tambahkan CSS untuk notifikasi error */
        .error-message {
            background-color: #fee;
            color: #c33;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            text-align: center;
            border: 1px solid #fcc;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-left">
            <a href="index.php" class="back-home">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <div class="login-left-content">
                <div class="login-day"></div>
                <br><br>
                <h1>Login</h1>
                <p>Masuk ke akun Anda untuk mengakses sistem pembayaran SPP.</p>
            </div>
        </div>
        
        <div class="login-right">
            <div class="login-form-container">
                <div class="login-header">
                    <h2>Login Pegawai</h2>
                    <p>Masuk ke sistem pembayaran SPP</p>
                </div>
                
                <?php if (!empty($error)): ?>
                    <div class="error-message">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>
                
                <form class="login-form" method="post">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="Masukkan username Anda" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Masukkan password Anda" required>
                    </div>
                    
                    <input type="submit" name="login" value="Login" class="login-btn">
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

// Cek role user
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'pegawai') {
    header("Location: login.php");
    exit();
}

// Koneksi ke database
$host = "localhost";
$username = "root";
$password = "";
$database = "srinfo";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Ambil data siswa dari database
$query_siswa = "SELECT s.id_siswa, s.nama_siswa, k.nama_kelas 
              FROM siswa s 
              JOIN kelas k ON s.id_kelas = k.id_kelas";
$result_siswa = mysqli_query($conn, $query_siswa);

// Simpan data siswa dengan kelas untuk digunakan di JavaScript
$siswa_data = array();
while ($row = mysqli_fetch_assoc($result_siswa)) {
    $siswa_data[$row['id_siswa']] = $row['nama_kelas'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran SPP - Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* CSS tetap sama seperti sebelumnya */
        :root {
            --primary: #2563eb;
            --primary-light: #93c5fd;
            --secondary: #10b981;
            --dark: #1e293b;
            --light: #f8fafc;
            --gray: #94a3b8;
            --border: #e2e8f0;
            --danger: #ef4444;
            --danger-light: #fecaca;
            --warning: #f59e0b;
            --success: #10b981;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            color: var(--dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
        }

        .logout-container {
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 100;
        }

        .logout-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            background-color: var(--danger);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(239, 68, 68, 0.2);
        }

        .logout-btn:hover {
            background-color: #dc2626;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(239, 68, 68, 0.25);
        }

        .container {
            width: 100%;
            max-width: 600px;
            background-color: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .header {
            background: linear-gradient(to right, #2563eb, #3b82f6);
            color: white;
            padding: 25px;
            text-align: center;
            position: relative;
        }

        .header h1 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 1rem;
            opacity: 0.9;
        }

        .form-container {
            padding: 30px;
        }

        .input-group {
            margin-bottom: 22px;
            position: relative;
        }

        .input-group label {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
            color: var(--dark);
            font-size: 15px;
        }

        .input-group input, .input-group select {
            width: 100%;
            padding: 15px 18px;
            border: 2px solid var(--border);
            border-radius: 10px;
            font-size: 16px;
            transition: all 0.3s ease;
            background-color: #f8fafc;
        }

        .input-group input:focus, .input-group select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.15);
            background-color: white;
        }

        .input-group i {
            position: absolute;
            right: 18px;
            top: 45px;
            color: var(--gray);
        }

        .payment-info {
            background-color: rgba(16, 185, 129, 0.1);
            border-radius: 10px;
            padding: 15px;
            margin: 20px 0;
            border-left: 4px solid var(--success);
        }

        .payment-info p {
            margin: 5px 0;
            font-size: 14px;
        }

        .payment-info .nominal {
            font-weight: bold;
            color: var(--success);
            font-size: 18px;
        }

        .bulan-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            margin-top: 10px;
        }

        .bulan-option {
            padding: 12px 5px;
            border: 2px solid var(--border);
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background-color: #f8fafc;
        }

        .bulan-option:hover {
            border-color: var(--primary-light);
        }

        .bulan-option.selected {
            border-color: var(--primary);
            background-color: rgba(37, 99, 235, 0.08);
        }

        .bulan-option.disabled {
            background-color: #f1f5f9;
            color: var(--gray);
            cursor: not-allowed;
            border-color: var(--border);
        }

        .jumlah-bulan {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 15px;
        }

        .jumlah-bulan label {
            font-weight: 600;
            color: var(--dark);
            white-space: nowrap;
        }

        .jumlah-bulan input {
            width: 80px;
            padding: 10px;
            border: 2px solid var(--border);
            border-radius: 8px;
            text-align: center;
            font-size: 16px;
        }

        .btn-submit {
            width: 100%;
            padding: 18px;
            background: linear-gradient(to right, #10b981, #34d399);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 17px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
            box-shadow: 0 4px 6px rgba(16, 185, 129, 0.2);
        }

        .btn-submit:hover {
            background: linear-gradient(to right, #0da271, #2eb67c);
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(16, 185, 129, 0.25);
        }

        .btn-submit:disabled {
            background: var(--gray);
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .footer {
            text-align: center;
            margin-top: 25px;
            color: var(--gray);
            font-size: 14px;
        }

        .notification {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            padding: 15px 25px;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            z-index: 1000;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .notification.show {
            opacity: 1;
        }

        .notification.success {
            background-color: var(--success);
        }

        .notification.error {
            background-color: var(--danger);
        }

        .user-info {
            position: absolute;
            top: 20px;
            left: 20px;
            background: rgba(255, 255, 255, 0.9);
            padding: 10px 15px;
            border-radius: 8px;
            font-weight: 600;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .welcome-message {
            background: linear-gradient(135deg, #10b981, #34d399);
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 600;
        }
    </style>
</head>
<body>
    
    <div class="user-info">
        <i class="fas fa-user-shield"></i> 
        <?php echo htmlspecialchars($_SESSION['nama_pegawai']); ?> (Pegawai)
    </div>

    <div class="logout-container">
        <a href="logout.php" class="logout-btn">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </div>

    <div class="container">
        <div class="header">
            <h1>Pembayaran SPP</h1>
            <p>Sistem Pembayaran SPP Digital</p>
        </div>
        
        <div class="form-container">
            <!-- Tambahkan welcome message -->
            <div class="welcome-message">
                <i class="fas fa-user-circle"></i> 
                Selamat datang, <?php echo htmlspecialchars($_SESSION['nama_pegawai']); ?>
            </div>

            <form id="paymentForm" method="POST" action="">
                <div class="input-group">
                    <label for="pegawai">Nama Pegawai</label>
                    <input type="text" id="pegawai" name="pegawai" value="<?php echo htmlspecialchars($_SESSION['nama_pegawai']); ?>" readonly style="background-color: #e8f4fd; color: #2563eb; font-weight: 600;">
                    <input type="hidden" name="id_pegawai" value="<?php echo $_SESSION['id_pegawai']; ?>">
                    <i class="fas fa-user-tie" style="color: #2563eb;"></i>
                </div>
                
                <div class="input-group">
                    <label for="siswa">Nama Siswa</label>
                    <select id="siswa" name="siswa" required>
                        <option value="" disabled selected>Pilih Siswa</option>
                        <?php
                        // Reset pointer result siswa
                        mysqli_data_seek($result_siswa, 0);
                        while ($row = mysqli_fetch_assoc($result_siswa)) {
                            echo "<option value='" . $row['id_siswa'] . "' data-kelas='" . $row['nama_kelas'] . "'>" . $row['nama_siswa'] . " - " . $row['nama_kelas'] . "</option>";
                        }
                        ?>
                    </select>
                    <i class="fas fa-user-graduate"></i>
                </div>
                
                <div class="input-group">
                    <label for="kelas">Kelas</label>
                    <input type="text" id="kelas" name="kelas" readonly>
                    <i class="fas fa-graduation-cap"></i>
                </div>
                
                <div class="input-group">
                    <label>Pilih Bulan</label>
                    <div class="bulan-container" id="bulanContainer">
                        <!-- Opsi bulan akan diisi secara dinamis -->
                    </div>
                    <input type="hidden" id="selectedMonthsInput" name="selected_months">
                </div>
                
                <div class="input-group">
                    <div class="jumlah-bulan">
                        <label for="jumlahBulan">Jumlah Bulan:</label>
                        <input type="number" id="jumlahBulan" name="jumlahBulan" min="1" max="12" value="0" readonly>
                        <span>bulan</span>
                    </div>
                </div>
                
                <div class="payment-info">
                    <p>Biaya SPP per bulan: <span class="nominal">Rp 150.000</span></p>
                    <p>Total yang harus dibayar: <span id="totalNominal" class="nominal">Rp 0</span></p>
                    <p>Bulan yang dipilih: <span id="selectedMonthsDisplay">-</span></p>
                </div>
                
                <div class="input-group">
                    <label for="nominal">Nominal (Rp)</label>
                    <input type="number" id="nominal" name="nominal" placeholder="Nominal pembayaran" readonly>
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                
                <div class="input-group">
                    <label for="metode">Metode Pembayaran</label>
                    <select id="metode" name="metode" required>
                        <option value="" disabled selected>Pilih Metode</option>
                        <option value="Cash">Cash</option>
                        <option value="Transfer Bank">Transfer Bank</option>
                        <option value="Qris">Qris</option>
                    </select>
                    <i class="fas fa-credit-card"></i>
                </div>
                
                <button type="submit" class="btn-submit" id="submitBtn" name="submit">
                    <i class="fas fa-paper-plane"></i> Kirim Pembayaran
                </button>
            </form>
        </div>
    </div>

    <div class="footer">
        &copy; 2025 Sistem Pembayaran SPP | Sekolah Terbaik
    </div>

    <div id="notification" class="notification"></div>

    <script>
        // Data bulan
        const months = [
            { value: 1, name: 'Januari' },
            { value: 2, name: 'Februari' },
            { value: 3, name: 'Maret' },
            { value: 4, name: 'April' },
            { value: 5, name: 'Mei' },
            { value: 6, name: 'Juni' },
            { value: 7, name: 'Juli' },
            { value: 8, name: 'Agustus' },
            { value: 9, name: 'September' },
            { value: 10, name: 'Oktober' },
            { value: 11, name: 'November' },
            { value: 12, name: 'Desember' }
        ];

        // Biaya SPP per bulan
        const sppPerMonth = 150000;
        
        // Variabel untuk menyimpan bulan yang dipilih
        let selectedMonths = [];

        // Data siswa dengan kelas (diambil dari PHP)
        const siswaData = <?php echo json_encode($siswa_data); ?>;

        // Inisialisasi halaman
        document.addEventListener('DOMContentLoaded', function() {
            // Isi container bulan
            renderMonthOptions();
            
            // Event listener untuk perubahan siswa
            document.getElementById('siswa').addEventListener('change', function() {
                updateKelasInfo(this.value);
                updateMonthOptions(this.value);
            });
            
            // Inisialisasi nominal
            updateNominal();

            // Tampilkan notifikasi welcome
            showNotification('Selamat datang, <?php echo $_SESSION['nama_pegawai']; ?>!', 'success');
        });

        // Fungsi untuk merender opsi bulan
        function renderMonthOptions() {
            const bulanContainer = document.getElementById('bulanContainer');
            bulanContainer.innerHTML = '';
            
            months.forEach(month => {
                const bulanOption = document.createElement('div');
                bulanOption.className = 'bulan-option';
                bulanOption.dataset.value = month.value;
                bulanOption.innerHTML = `
                    <div>${month.value}</div>
                    <div style="font-size: 12px;">${month.name}</div>
                `;
                
                bulanOption.addEventListener('click', function() {
                    if (!this.classList.contains('disabled')) {
                        toggleMonthSelection(month.value);
                    }
                });
                
                bulanContainer.appendChild(bulanOption);
            });
        }

        // Fungsi untuk toggle pemilihan bulan
        function toggleMonthSelection(monthValue) {
            const bulanOption = document.querySelector(`.bulan-option[data-value="${monthValue}"]`);
            
            if (selectedMonths.includes(monthValue)) {
                // Hapus dari selected
                selectedMonths = selectedMonths.filter(m => m !== monthValue);
                bulanOption.classList.remove('selected');
            } else {
                // Tambahkan ke selected
                selectedMonths.push(monthValue);
                bulanOption.classList.add('selected');
            }
            
            // Urutkan bulan yang dipilih
            selectedMonths.sort((a, b) => a - b);
            
            // Update jumlah bulan dan nominal
            updateJumlahBulan();
            updateSelectedMonthsDisplay();
            updateNominal();
            updateHiddenMonthInput();
        }

        // Fungsi untuk memperbarui jumlah bulan
        function updateJumlahBulan() {
            document.getElementById('jumlahBulan').value = selectedMonths.length;
        }

        // Fungsi untuk memperbarui tampilan bulan yang dipilih
        function updateSelectedMonthsDisplay() {
            const selectedMonthsElement = document.getElementById('selectedMonthsDisplay');
            
            if (selectedMonths.length === 0) {
                selectedMonthsElement.textContent = '-';
            } else {
                const monthNames = selectedMonths.map(monthValue => {
                    const month = months.find(m => m.value == monthValue);
                    return month ? month.name : monthValue;
                });
                selectedMonthsElement.textContent = monthNames.join(', ');
            }
        }

        // Fungsi untuk memperbarui informasi kelas berdasarkan siswa yang dipilih
        function updateKelasInfo(siswaId) {
            const kelasInput = document.getElementById('kelas');
            if (siswaData[siswaId]) {
                kelasInput.value = siswaData[siswaId];
            } else {
                kelasInput.value = '';
            }
        }

        // Fungsi untuk memperbarui opsi bulan berdasarkan siswa yang dipilih
        function updateMonthOptions(siswaId) {
            // Reset pilihan bulan
            selectedMonths = [];
            document.querySelectorAll('.bulan-option').forEach(option => {
                option.classList.remove('selected', 'disabled');
            });
            
            // Menggunakan AJAX untuk mengambil data bulan yang sudah dibayar
            if (siswaId) {
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'get_paid_months.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        try {
                            const paidMonths = JSON.parse(xhr.responseText);
                            
                            // Nonaktifkan bulan yang sudah dibayar
                            paidMonths.forEach(monthValue => {
                                const bulanOption = document.querySelector(`.bulan-option[data-value="${monthValue}"]`);
                                if (bulanOption) {
                                    bulanOption.classList.add('disabled');
                                }
                            });
                        } catch (e) {
                            console.error('Error parsing JSON:', e);
                        }
                        
                        // Reset tampilan
                        updateJumlahBulan();
                        updateSelectedMonthsDisplay();
                        updateNominal();
                        updateHiddenMonthInput();
                    }
                };
                
                xhr.send('siswa_id=' + siswaId);
            }
        }

        // Fungsi untuk memperbarui nominal berdasarkan bulan yang dipilih
        function updateNominal() {
            const jumlahBulan = selectedMonths.length;
            const nominal = jumlahBulan > 0 ? sppPerMonth * jumlahBulan : 0;
            
            document.getElementById('nominal').value = nominal;
            document.getElementById('totalNominal').textContent = formatRupiah(nominal);
        }

        // Fungsi untuk memperbarui input tersembunyi untuk bulan yang dipilih
        function updateHiddenMonthInput() {
            document.getElementById('selectedMonthsInput').value = selectedMonths.join(',');
        }

        // Fungsi untuk menampilkan notifikasi
        function showNotification(message, type) {
            const notification = document.getElementById('notification');
            notification.textContent = message;
            notification.className = `notification ${type} show`;
            
            setTimeout(() => {
                notification.classList.remove('show');
            }, 3000);
        }

        // Fungsi untuk memformat angka ke format Rupiah
        function formatRupiah(angka) {
            return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
    </script>
</body>
</html>

<?php
// Proses form jika disubmit
if (isset($_POST['submit'])) {
    // Ambil data dari form
    $id_pegawai = $_SESSION['id_pegawai']; // Ambil dari session
    $id_siswa = mysqli_real_escape_string($conn, $_POST['siswa']);
    $selected_months = $_POST['selected_months'];
    $total_nominal = mysqli_real_escape_string($conn, $_POST['nominal']);
    $metode = mysqli_real_escape_string($conn, $_POST['metode']);
    $tgl_pembayaran = date('Y-m-d');
    
    // Pisahkan bulan yang dipilih
    $bulan_array = explode(',', $selected_months);
    $bulan_count = count(array_filter($bulan_array));
    
    // Hitung nominal per bulan
    $nominal_per_bulan = ($bulan_count > 0) ? ($total_nominal / $bulan_count) : 0;
    
    if (!empty($id_siswa) && $bulan_count > 0) {
        $inserted = false;
        foreach ($bulan_array as $bulan_dipilih) {
            if (!empty($bulan_dipilih)) {
                $bulan_dipilih = mysqli_real_escape_string($conn, trim($bulan_dipilih));
                
                // Cek apakah bulan ini sudah dibayar untuk siswa ini
                $check_query = "SELECT id_pembayaran FROM pembayaran WHERE id_siswa = '$id_siswa' AND bulan = '$bulan_dipilih'";
                $check_result = mysqli_query($conn, $check_query);
                
                if (mysqli_num_rows($check_result) == 0) {
                    $query = "INSERT INTO pembayaran (id_siswa, tgl_pembayaran, bulan, nominal, metode, id_pegawai) 
                              VALUES ('$id_siswa', '$tgl_pembayaran', '$bulan_dipilih', '$nominal_per_bulan', '$metode', '$id_pegawai')";
                    
                    if (mysqli_query($conn, $query)) {
                        $inserted = true;
                    } else {
                        echo "<script>showNotification('Error: " . mysqli_error($conn) . "', 'error');</script>";
                    }
                }
            }
        }
        
        if ($inserted) {
            echo "<script>showNotification('Pembayaran SPP untuk " . $bulan_count . " bulan berhasil disimpan!', 'success');</script>";
        } else {
            echo "<script>showNotification('Tidak ada pembayaran baru yang disimpan (mungkin bulan sudah dibayar).', 'warning');</script>";
        }
    } else {
        echo "<script>showNotification('Data siswa atau bulan tidak valid.', 'error');</script>";
    }
    
    // Tutup koneksi
    mysqli_close($conn);
    
    // Redirect untuk menghindari resubmission
    echo "<script>setTimeout(function() { window.location.href = window.location.href; }, 2000);</script>";
}
?>
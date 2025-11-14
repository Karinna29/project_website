<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RPL - SMK Negeri 1 Sukawati</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <!-- Sidebar Navigation -->
    <nav class="sidebar">
        <div class="sidebar-header">
            <h1>RPL</h1>
            <p>SMK Negeri 1 Sukawati</p>
        </div>
        
        <div class="sidebar-menu">
            <ul>
                <li><a href="index.php?page=home" class="<?php echo (!isset($_GET['page']) || $_GET['page'] == 'home') ? 'active' : ''; ?>"><i class="fas fa-home"></i> <span>HOME</span></a></li>
                <li><a href="index.php?page=guru" class="<?php echo (isset($_GET['page']) && $_GET['page'] == 'guru') ? 'active' : ''; ?>"><i class="fas fa-chalkboard-teacher"></i> <span>GURU</span></a></li>
                <li><a href="index.php?page=pegawai" class="<?php echo (isset($_GET['page']) && $_GET['page'] == 'pegawai') ? 'active' : ''; ?>"><i class="fas fa-user-tie"></i> <span>PEGAWAI</span></a></li>
                <li><a href="index.php?page=jurusan" class="<?php echo (isset($_GET['page']) && $_GET['page'] == 'jurusan') ? 'active' : ''; ?>"><i class="fas fa-graduation-cap"></i> <span>JURUSAN</span></a></li>
                <li><a href="index.php?page=kelas" class="<?php echo (isset($_GET['page']) && $_GET['page'] == 'kelas') ? 'active' : ''; ?>"><i class="fas fa-door-open"></i> <span>KELAS</span></a></li>
                <li><a href="index.php?page=siswa" class="<?php echo (isset($_GET['page']) && $_GET['page'] == 'siswa') ? 'active' : ''; ?>"><i class="fas fa-user-graduate"></i> <span>SISWA</span></a></li>
                <li><a href="index.php?page=mpk" class="<?php echo (isset($_GET['page']) && $_GET['page'] == 'mpk') ? 'active' : ''; ?>"><i class="fas fa-users"></i> <span>MPK</span></a></li>
                <li><a href="index.php?page=jurnal" class="<?php echo (isset($_GET['page']) && $_GET['page'] == 'jurnal') ? 'active' : ''; ?>"><i class="fas fa-book"></i> <span>JURNAL</span></a></li>
                <li><a href="index.php?page=pembayaran" class="<?php echo (isset($_GET['page']) && $_GET['page'] == 'pembayaran') ? 'active' : ''; ?>"><i class="fas fa-money-bill-wave"></i> <span>PEMBAYARAN</span></a></li>
                <li><a href="index.php?page=absensi" class="<?php echo (isset($_GET['page']) && $_GET['page'] == 'absensi') ? 'active' : ''; ?>"><i class="fas fa-user-check"></i> <span>ABSENSI</span></a></li>
            </ul>
        </div>
        
        <div class="sidebar-footer">
            <p>&copy; 2025 RPL - SMK Negeri 1 Sukawati</p>
        </div>
    </nav>
    
    <!-- Main Content -->
    <div class="main-content">
        <button class="menu-toggle">
            <i class="fas fa-bars"></i>
        </button>
        
        <div class="content-header">
            <h1>RPL - SMK Negeri 1 Sukawati</h1>
            <p>Halaman Web Dinamis</p>
        </div>
        
        <div class="badan">
            <?php
            if (isset($_GET['page'])){
                $page = $_GET['page'];
                switch ($page){
                    case'home':
                        include "home.php";
                        break;
                    case'guru':
                        include "guru2.php";
                        break;
                    case'pegawai':
                        include "pegawai.php";
                        break;
                    case'jurusan':
                        include "jurusan1.php";
                        break;
                    case'kelas':
                        include "kelas.php";
                        break;
                    case'siswa':
                        include "siswa.php";
                        break;
                    case'mpk':
                        include "mpk.php";
                        break;
                    case'jurnal':
                        include "jurnal.php";
                        break;
                    case'pembayaran':
                        include "pembayaran.php";
                        break;
                    case'absensi':
                        include "absensi.php";
                        break;
                    default:
                    echo "<center><h3>Maaf, halaman tidak ditemukan</h3><center>";          
                }
            }else{
                include "home.php";
            }
            ?>
        </div>
        
        <footer>
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Tentang Kami</h3>
                    <p>Program Keahlian Rekayasa Perangkat Lunak di SMK Negeri 1 Sukawati.</p>
                </div>
                
                <div class="footer-section">
                    <h3>Kontak</h3>
                    <p><i class="fas fa-map-marker-alt"></i> Jl. Smki Pegambangan, Batubulan, Sukawati, Gianyar, Bali.</p>
                    <p><i class="fas fa-phone"></i> 0361 298134</p>
                    <p><i class="fas fa-envelope"></i> info@rpl-smknegeri1sukawati.sch.id</p>
                </div>
                
                <div class="footer-section">
                    <h3>Ikuti Kami</h3>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; 2025 RPL - SMK Negeri 1 Sukawati. Semua Hak Dilindungi.</p>
            </div>
        </footer>
    </div>

    <script>
        // Toggle menu for mobile
        document.querySelector('.menu-toggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
        });
        
        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.querySelector('.sidebar');
            const menuToggle = document.querySelector('.menu-toggle');
            
            if (window.innerWidth <= 768 && 
                !sidebar.contains(event.target) && 
                !menuToggle.contains(event.target) && 
                sidebar.classList.contains('active')) {
                sidebar.classList.remove('active');
            }
        });
        
        // Add active class to current page
        document.addEventListener('DOMContentLoaded', function() {
            const currentPage = window.location.href;
            const menuItems = document.querySelectorAll('.sidebar-menu a');
            
            menuItems.forEach(item => {
                if (item.href === currentPage) {
                    item.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>
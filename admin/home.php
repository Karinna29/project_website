<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panduan Sistem Pembayaran SPP - SMK Negeri 1 Sukawati</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #3498db;
            --secondary: #2c3e50;
            --accent: #e74c3c;
            --success: #2ecc71;
            --warning: #f39c12;
            --light: #ecf0f1;
            --dark: #34495e;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8eb 100%);
            color: #333;
            line-height: 1.6;
            min-height: 100vh;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        /* Header Styles */
        .header {
            text-align: center;
            padding: 30px 0;
            margin-bottom: 30px;
            background: white;
            border-radius: 15px;
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
        }
        
        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(to right, var(--primary), var(--secondary));
        }
        
        .school-name {
            color: var(--secondary);
            font-size: 2.2rem;
            margin-bottom: 10px;
            font-weight: 700;
        }
        
        .school-name span {
            color: var(--primary);
        }
        
        .system-name {
            color: var(--dark);
            font-size: 1.5rem;
            margin-bottom: 15px;
            font-weight: 600;
        }
        
        .school-info {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-top: 15px;
            flex-wrap: wrap;
        }
        
        .info-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #7f8c8d;
            font-size: 0.9rem;
        }
        
        /* Welcome Section */
        .welcome-section {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border-radius: 15px;
            padding: 40px;
            margin-bottom: 40px;
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
        }
        
        .welcome-section::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }
        
        .welcome-section::after {
            content: '';
            position: absolute;
            bottom: -80px;
            left: -80px;
            width: 250px;
            height: 250px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }
        
        .welcome-content {
            position: relative;
            z-index: 1;
            max-width: 800px;
        }
        
        .welcome-section h2 {
            font-size: 2rem;
            margin-bottom: 15px;
        }
        
        .welcome-section p {
            font-size: 1.1rem;
            opacity: 0.9;
            max-width: 700px;
        }
        
        /* Guide Section */
        .guide-section {
            background: white;
            border-radius: 15px;
            box-shadow: var(--shadow);
            padding: 35px;
            margin-bottom: 40px;
        }
        
        .section-title {
            color: var(--secondary);
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--light);
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 1.8rem;
        }
        
        .section-title i {
            color: var(--primary);
        }
        
        .guide-steps {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 25px;
        }
        
        .step {
            display: flex;
            align-items: flex-start;
            gap: 20px;
            padding: 25px;
            background: #f8f9fa;
            border-radius: 12px;
            transition: all 0.3s ease;
            border-left: 4px solid var(--primary);
        }
        
        .step:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        
        .step-number {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.2rem;
            flex-shrink: 0;
        }
        
        .step-content h3 {
            margin-bottom: 12px;
            color: var(--secondary);
            font-size: 1.3rem;
        }
        
        .step-content p {
            color: #7f8c8d;
            font-size: 1rem;
            line-height: 1.7;
        }
        
        /* Features Section */
        .features-section {
            background: white;
            border-radius: 15px;
            box-shadow: var(--shadow);
            padding: 35px;
            margin-bottom: 40px;
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
        }
        
        .feature-card {
            padding: 25px;
            background: #f8f9fa;
            border-radius: 12px;
            text-align: center;
            transition: all 0.3s ease;
            border-top: 4px solid var(--primary);
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        
        .feature-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin: 0 auto 20px;
        }
        
        .feature-card h3 {
            margin-bottom: 15px;
            color: var(--secondary);
            font-size: 1.3rem;
        }
        
        .feature-card p {
            color: #7f8c8d;
            font-size: 0.95rem;
            line-height: 1.6;
        }
        
        /* Info Section */
        .info-section {
            background: white;
            border-radius: 15px;
            box-shadow: var(--shadow);
            padding: 35px;
            margin-bottom: 40px;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
        }
        
        .info-card {
            padding: 25px;
            background: #f8f9fa;
            border-radius: 12px;
            border-left: 4px solid var(--accent);
        }
        
        .info-card h3 {
            margin-bottom: 15px;
            color: var(--secondary);
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .info-card h3 i {
            color: var(--accent);
        }
        
        .info-card p {
            color: #7f8c8d;
            font-size: 0.95rem;
            line-height: 1.7;
        }
        
        /* Contact Section */
        .contact-section {
            background: linear-gradient(135deg, var(--secondary), var(--dark));
            color: white;
            border-radius: 15px;
            box-shadow: var(--shadow);
            padding: 40px;
            text-align: center;
        }
        
        .contact-section h2 {
            margin-bottom: 25px;
            font-size: 1.8rem;
        }
        
        .contact-info {
            display: flex;
            justify-content: center;
            gap: 40px;
            flex-wrap: wrap;
        }
        
        .contact-item {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 1.1rem;
        }
        
        .contact-item i {
            font-size: 1.3rem;
            color: var(--primary);
        }
        
        /* Footer */
        .footer {
            text-align: center;
            padding: 25px 0;
            color: #7f8c8d;
            font-size: 0.9rem;
            margin-top: 30px;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .school-name {
                font-size: 1.8rem;
            }
            
            .system-name {
                font-size: 1.3rem;
            }
            
            .school-info {
                flex-direction: column;
                gap: 10px;
            }
            
            .guide-steps, .features-grid, .info-grid {
                grid-template-columns: 1fr;
            }
            
            .welcome-section, .guide-section, .features-section, .info-section {
                padding: 25px;
            }
            
            .section-title {
                font-size: 1.5rem;
            }
            
            .contact-info {
                flex-direction: column;
                gap: 20px;
            }
        }
        
        @media (max-width: 480px) {
            .container {
                padding: 15px;
            }
            
            .step {
                flex-direction: column;
                text-align: center;
            }
            
            .step-number {
                margin: 0 auto;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <header class="header">
            <h1 class="school-name">SMK NEGERI 1 <span>SUKAWATI</span></h1>
            <h2 class="system-name">Sistem Pembayaran SPP Digital</h2>
            <div class="school-info">
                <div class="info-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Jl. Smki Pegambangan, Batubulan, Sukawati, Gianyar, Bali.</span>
                </div>
                <div class="info-item">
                    <i class="fas fa-phone"></i>
                    <span>0361 298134</span>
                </div>
                <div class="info-item">
                    <i class="fas fa-envelope"></i>
                    <span>info@smknegeri1sukawati.sch.id</span>
                </div>
            </div>
        </header>
        
        <!-- Welcome Section -->
        <section class="welcome-section">
            <div class="welcome-content">
                <h2>Selamat Datang di Sistem Pembayaran SPP</h2>
                <p>Sistem Pembayaran SPP Digital SMK Negeri 1 Sukawati dirancang khusus untuk memudahkan admin dalam mengelola pembayaran SPP siswa secara efisien dan terorganisir. Di bawah ini adalah panduan lengkap penggunaan sistem.</p>
            </div>
        </section>
        
        <!-- Guide Section -->
        <section class="guide-section">
            <h2 class="section-title"><i class="fas fa-info-circle"></i> Panduan Penggunaan Sistem</h2>
            <div class="guide-steps">
                <div class="step">
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <h3>Akses Menu Pembayaran</h3>
                        <p>Setelah login, Anda akan diarahkan ke dashboard. Untuk mengelola pembayaran SPP, klik menu <strong>Pembayaran SPP</strong> yang terdapat pada sidebar navigasi.</p>
                    </div>
                </div>
                <div class="step">
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <h3>Mencari Data Siswa</h3>
                        <p>Gunakan fitur pencarian di bagian atas halaman untuk menemukan data siswa tertentu. Anda dapat mencari berdasarkan nama, NIS, atau kelas siswa.</p>
                    </div>
                </div>
                <div class="step">
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <h3>Verifikasi Pembayaran</h3>
                        <p>Untuk pembayaran yang masuk, klik tombol <strong>Verifikasi</strong> pada data yang sesuai. Sistem akan mengubah status pembayaran menjadi "Lunas" setelah diverifikasi.</p>
                    </div>
                </div>
                <div class="step">
                    <div class="step-number">4</div>
                    <div class="step-content">
                        <h3>Cetak Bukti Pembayaran</h3>
                        <p>Setelah pembayaran diverifikasi, gunakan tombol <strong>Cetak</strong> untuk menghasilkan bukti pembayaran resmi yang dapat diberikan kepada siswa atau wali.</p>
                    </div>
                </div>
                <div class="step">
                    <div class="step-number">5</div>
                    <div class="step-content">
                        <h3>Kirim Pengingat</h3>
                        <p>Untuk siswa yang belum melunasi pembayaran, gunakan tombol <strong>Kirim Pengingat</strong> untuk mengirim notifikasi melalui email atau SMS.</p>
                    </div>
                </div>
                <div class="step">
                    <div class="step-number">6</div>
                    <div class="step-content">
                        <h3>Buat Laporan Keuangan</h3>
                        <p>Akses menu <strong>Laporan Keuangan</strong> untuk membuat laporan periodik. Pilih rentang tanggal dan sistem akan menghasilkan laporan secara otomatis.</p>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Features Section -->
        <section class="features-section">
            <h2 class="section-title"><i class="fas fa-star"></i> Fitur Unggulan Sistem</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h3>Proses Cepat</h3>
                    <p>Verifikasi pembayaran dan pencetakan bukti dapat dilakukan dalam hitungan detik, meningkatkan efisiensi kerja admin.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Keamanan Data</h3>
                    <p>Sistem dilengkapi dengan enkripsi data dan kontrol akses untuk memastikan keamanan informasi keuangan sekolah.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3>Notifikasi Otomatis</h3>
                    <p>Sistem dapat mengirim pengingat otomatis kepada siswa yang belum melunasi pembayaran sesuai jadwal.</p>
                </div>
            </div>
        </section>
        
        <!-- Info Section -->
        <section class="info-section">
            <h2 class="section-title"><i class="fas fa-school"></i> Informasi SMK Negeri 1 Sukawati</h2>
            <div class="info-grid">
                <div class="info-card">
                    <h3><i class="fas fa-eye"></i> Visi Sekolah</h3>
                    <p>Terwujudnya siswa yang mandiri, terampil, kompeten, santun dan unggul dalam berbagai bidang menuju daya saing global</p>
                </div>
                <div class="info-card">
                    <h3><i class="fas fa-bullseye"></i> Misi Sekolah</h3>
                    <p>Membentuk siswa yang memiliki kemandirian dalam belajar dan bekerja melalui pembelajaran berbasis praktik, problem-solving, dan proyek nyata.</p>
                </div>
                <div class="info-card">
                    <h3><i class="fas fa-graduation-cap"></i> Program Keahlian</h3>
                    <p>Teknik Komputer dan Jaringan, Rekayasa Perangkat Lunak, DKV, DITF, Seni Rupa, Animasi, dan Kriya.</p>
                </div>
            </div>
        </section>

    <script>
        // Simple animation on scroll
        document.addEventListener('DOMContentLoaded', function() {
            const steps = document.querySelectorAll('.step');
            const features = document.querySelectorAll('.feature-card');
            
            // Add animation on scroll
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };
            
            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);
            
            // Set initial state for animated elements
            steps.forEach(step => {
                step.style.opacity = '0';
                step.style.transform = 'translateY(20px)';
                step.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                observer.observe(step);
            });
            
            features.forEach(feature => {
                feature.style.opacity = '0';
                feature.style.transform = 'translateY(20px)';
                feature.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                observer.observe(feature);
            });
        });
    </script>
</body>
</html>
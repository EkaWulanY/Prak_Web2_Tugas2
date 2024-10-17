<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8"> <!-- Mengatur encoding dokumen menjadi UTF-8 agar mendukung berbagai karakter. -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Menjadikan halaman web responsif agar tampil dengan baik di berbagai ukuran layar. -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> <!-- Mengimpor CSS Bootstrap dari CDN untuk menggunakan komponen styling Bootstrap. -->
    <title>Data Izin Ketidakhadiran Pegawai</title> <!-- Judul halaman yang akan tampil di tab browser. -->

    <style>
        /* Menyembunyikan semua konten div dengan class 'content-section' secara default */
        .content-section {
            display: none;
        }

        /* Tampilkan div yang memiliki class 'active' */
        .active {
            display: block;
        }
    </style>
</head>

<body>
    <!-- Bagian navbar menggunakan komponen Bootstrap -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Sistem Izin Dosen</a> <!-- Teks yang akan tampil di bagian kiri navbar sebagai brand aplikasi. -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span> <!-- Tombol hamburger untuk membuka atau menutup navbar pada layar kecil. -->
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <!-- Item navbar dengan fungsi onclick untuk memanggil fungsi showSection() yang menampilkan konten sesuai dengan pilihan -->
                <li class="nav-item">
                    <a class="nav-link" href="Tugas.php" onclick="showSection('beranda')">Beranda</a> <!-- Tautan untuk menuju halaman Beranda. -->
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Tugas.php" onclick="showSection('izin-cuti')">Izin Cuti</a> <!-- Tautan untuk menuju halaman Izin Cuti. -->
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Tugas.php" onclick="showSection('izin-tugas')">Lainnya</a> <!-- Tautan untuk menuju halaman Izin Tugas Lainnya. -->
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Tugas.php" onclick="showSection('tentang')">Tentang</a> <!-- Tautan untuk menuju halaman Tentang. -->
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <!-- Konten untuk halaman Beranda -->
        <div id="beranda" class="content-section active">
            <div class="jumbotron">
                <h1 class="display-4">Selamat Datang di Website Data Izin Ketidakhadiran Pegawai</h1> <!-- Judul besar di bagian Beranda. -->
                <p class="lead">Silahkan Pilih Sesuai Kepentingan Anda</p> <!-- Deskripsi singkat di bawah judul. -->
                <hr class="my-4"> <!-- Garis pemisah. -->
                <p>Gunakan navigasi di atas untuk mengakses halaman yang Anda butuhkan, seperti Izin Cuti, Izin Tugas, dan informasi lainnya.</p> <!-- Paragraf penjelasan. -->
            </div>
        </div>

        <!-- Konten untuk halaman Izin Cuti -->
        <div id="izin-cuti" class="content-section">
            <h2>Data Izin Cuti</h2> <!-- Judul halaman Izin Cuti. -->
            <p>Berikut adalah daftar izin cuti pegawai</p> <!-- Deskripsi singkat mengenai data izin cuti. -->
            <!-- Tabel atau data izin cuti akan ditempatkan di sini. -->
        </div>

        <!-- Konten untuk halaman Izin Tugas -->
        <div id="izin-tugas" class="content-section">
            <h2>Data Lainnya</h2> <!-- Judul halaman Izin Tugas Lainnya. -->
            <p>Berikut adalah daftar keterangan lain pegawai</p> <!-- Deskripsi singkat mengenai data izin tugas lainnya. -->
            <!-- Tabel atau data izin tugas lainnya akan ditempatkan di sini. -->
        </div>

        <!-- Konten untuk halaman Tentang -->
        <div id="tentang" class="content-section">
            <h2>Tentang Sistem Izin Dosen</h2> <!-- Judul halaman Tentang. -->
            <p>Website ini dibuat untuk mempermudah proses pengajuan dan manajemen izin ketidakhadiran pegawai...</p> <!-- Deskripsi tentang website dan tujuannya. -->
        </div>
    </div>

    <!-- Menyertakan file JavaScript eksternal untuk Bootstrap dan jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> <!-- Mengimpor jQuery versi slim untuk mempermudah manipulasi elemen HTML. -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script> <!-- Mengimpor Popper.js untuk mendukung fitur dropdown di Bootstrap. -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> <!-- Mengimpor JavaScript Bootstrap untuk mendukung komponen interaktif Bootstrap. -->

    <!-- JavaScript untuk mengontrol penampilan konten berdasarkan klik di navbar -->
    <script>
        // Fungsi untuk menampilkan bagian konten berdasarkan id yang diterima
        function showSection(sectionId) {
            // Menyembunyikan semua div yang memiliki class 'content-section'
            var sections = document.getElementsByClassName('content-section');
            for (var i = 0; i < sections.length; i++) {
                sections[i].classList.remove('active'); // Menghapus class 'active' dari semua div
            }

            // Menambahkan class 'active' ke div yang dipilih berdasarkan id
            document.getElementById(sectionId).classList.add('active');
        }
    </script>
</body>

</html>
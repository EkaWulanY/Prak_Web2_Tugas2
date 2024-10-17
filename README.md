# Prak_Web2_Tugas2

## Tugas untuk dikerjakan:

    1. Membuat tampilan berbasis OOP dengan mengambil data dari database MySQL.
    
    2. Menggunakan metode _construct untuk koneksi database.
    
    3. Menerapkan enkapsulasi sesuai logika studi kasus.
    
    4. Membuat kelas turunan menggunakan konsep pewarisan (inheritance).
    
    5. Menerapkan polimorfisme untuk minimal dua peran sesuai studi kasus.

Studi Kasus yang di dapatkan berupa izin ketidakhadiran pegawai

## Langkah langkah

1. membuat database dengan mana persuratan_dosen yang didalamnya terdapat tabel izin_ketidakhadiran_pegawai

   a. ERD izin ketidakhadiran pegawai
   
![image](https://github.com/user-attachments/assets/746a78f7-0ccb-4d4d-a55f-da2994b34267)
    
    b. Tabel izin_ketidakhadiran_pegawai
   
**Tabel: `izin_ketidakhadiran_pegawai`**

- **id_izin**: Kolom ini adalah *Primary Key*, dengan tipe data `int`, tidak boleh bernilai `NULL`, dan menggunakan fitur `AUTO_INCREMENT`, yang berarti nilainya akan bertambah otomatis setiap kali ada data baru.

- **keperluan**: Tipe data `varchar(255)` untuk menyimpan informasi tentang keperluan izin, dengan karakter maksimal 255, tidak boleh bernilai `NULL`.

- **finger_print_id**: Tipe data `varchar(20)` untuk menyimpan ID dari fingerprint pegawai, dengan panjang maksimal 20 karakter, tidak boleh bernilai `NULL`.

- **tgl_mulai_izin**: Tipe data `date` untuk menyimpan tanggal mulai izin, tidak boleh bernilai `NULL`.

- **durasi_izin_hari**: Tipe data `varchar(20)` untuk menyimpan durasi izin dalam hari, dengan panjang maksimal 20 karakter, tidak boleh bernilai `NULL`.

- **durasi_izin_jam**: Tipe data `varchar(20)` untuk menyimpan durasi izin dalam jam, dengan panjang maksimal 20 karakter, tidak boleh bernilai `NULL`.

- **durasi_izin_menit**: Tipe data `varchar(20)` untuk menyimpan durasi izin dalam menit, dengan panjang maksimal 20 karakter, tidak boleh bernilai `NULL`.

- **nama_pengusul**: Tipe data `varchar(255)` untuk menyimpan nama pengusul izin, dengan panjang maksimal 255 karakter, tidak boleh bernilai `NULL`.

- **tgl_usul**: Tipe data `date` untuk menyimpan tanggal pengajuan izin, tidak boleh bernilai `NULL`.

- **ttd_pengusul**: Tipe data `varchar(255)` untuk menyimpan tanda tangan pengusul dalam bentuk teks (kemungkinan berupa path file atau string base64), tidak boleh bernilai `NULL`.
- **putusan**: Tipe data `varchar(50)` untuk menyimpan putusan atau keputusan terkait izin (misalnya "disetujui" atau "ditolak"), dengan panjang maksimal 50 karakter, tidak boleh bernilai `NULL`.

- **tgl_disetujui**: Tipe data `date` untuk menyimpan tanggal persetujuan izin, tidak boleh bernilai `NULL`.

- **ttd_atasan**: Tipe data `varchar(255)` untuk menyimpan tanda tangan atasan yang menyetujui, tidak boleh bernilai `NULL`.

- **catatan**: Tipe data `varchar(255)` untuk menyimpan catatan tambahan terkait izin, tidak boleh bernilai `NULL`.

- **dosen**: Tipe data `varchar(255)` untuk menyimpan nama dosen yang terkait dengan izin, tidak boleh bernilai `NULL`.

2. Membuat view untuk tampilan awal saat dibuka

   ```php
   <!DOCTYPE html>
   <html lang="id">
   <head>
   <meta charset="UTF-8"> <!-- Mengatur encoding dokumen -->
   <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsive meta tag -->
   <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> <!-- Mengimpor CSS Bootstrap -->
   <title>Data Izin Ketidakhadiran Pegawai</title> <!-- Judul halaman -->
    
    <style>
   
        /* Sembunyikan semua konten div secara default */
        
        .content-section {
            display: none;
        }
        
        /* Tampilkan div yang aktif */
        
        .active {
            display: block;
        }
    </style>
</head>
<body>
    <!-- Navbar Bootstrap -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Sistem Izin Dosen</a> <!-- Nama aplikasi di navbar -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span> <!-- Tombol navbar di layar kecil -->
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="Tugas.php" onclick="showSection('beranda')">Beranda</a> <!-- Link ke halaman beranda -->
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Tugas.php" onclick="showSection('izin-cuti')">Izin Cuti</a> <!-- Link ke halaman izin cuti -->
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Tugas.php" onclick="showSection('izin-tugas')">Lainnya</a> <!-- Link ke halaman izin tugas -->
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Tugas.php" onclick="showSection('tentang')">Tentang</a> <!-- Link ke halaman tentang -->
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-5">
        <!-- Konten Beranda -->
        <div id="beranda" class="content-section active">
            <div class="jumbotron">
                <h1 class="display-4">Selamat Datang di Website Data Izin Ketidakhadiran Pegawai</h1>
                <p class="lead">Silahkan Pilih Sesuai Kepentingan Anda</p>
                <hr class="my-4">
                <p>Gunakan navigasi di atas untuk mengakses halaman yang Anda butuhkan, seperti Izin Cuti, Izin Tugas, dan informasi lainnya.</p>
            </div>
        </div>
        <!-- Konten Izin Cuti -->
        
        <div id="izin-cuti" class="content-section">
            <h2>Data Izin Cuti</h2>
            <p>Berikut adalah daftar izin cuti pegawai</p>
            
            <!-- Isi tabel atau data izin cuti -->
        </div>
        <!-- Konten Izin Tugas -->
        
        <div id="izin-tugas" class="content-section">
            <h2>Data Lainnya</h2>
            <p>Berikut adalah daftar keterangan lain pegawai</p>
            
            <!-- Isi tabel atau data izin tugas -->
            
        </div>
        <!-- Konten Tentang -->
        
        <div id="tentang" class="content-section">
        
            <h2>Tentang Sistem Izin Dosen</h2>
            <p>Website ini dibuat untuk mempermudah proses pengajuan dan manajemen izin ketidakhadiran pegawai</p>
            
        </div>
    </div>
    
    <!-- Menyertakan file JavaScript eksternal untuk Bootstrap dan jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- JavaScript untuk mengontrol penampilan konten -->
    <script>
    
        // Fungsi untuk menampilkan bagian yang diinginkan berdasarkan id
        
        function showSection(sectionId) {
            // Sembunyikan semua div dengan class 'content-section'
            
            var sections = document.getElementsByClassName('content-section');
            for (var i = 0; i < sections.length; i++) {
                sections[i].classList.remove('active');
            }

            // Tampilkan div yang sesuai dengan id
            
            document.getElementById(sectionId).classList.add('active');
        }
    </script>
</body>

</html>


   ```

3. Memulai sesi dalam coding php menggunakan session_start();
session start sendiri berfungsi untuk menampung data sementara

   ```php

   <?php
   session_start();

   ```

4. membuat class database untuk mengkonekan pada database

 ```php

// Kelas untuk koneksi database

class Database
{
    private $host = 'localhost';
    private $db_name = 'persuratan_dosen';
    private $username = 'root';
    private $password = '';
    public $conn;

    public function __construct()
    {
        $this->connect();
    }

    public function connect()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
    }
}

```

Kelas Database bertanggung jawab untuk mengatur koneksi ke database MySQL menggunakan PDO. Parameter seperti host, db_name, username, dan password digunakan untuk konfigurasi koneksi. Metode connect() mencoba untuk membuat koneksi ke database dan menangani kesalahan yang mungkin terjadi dengan blok try-catch.

5. Membuat class izin ketidakhadiran
   kelas ini digunakan untuk melakukan operasi terkait ketidakhadiran pegawai. untuk membaca data gunakan metode read, dalam mengambil data tertentu atau membaca data yang dijadikan sub class dalam hal ini adalah izin cuti dan izin tugas dapat menambahkan where untuk mengambil data yang akan ditampilkan.

```php

class IzinKetidakhadiran
{
    private $conn;
    public $table_name = "izin_ketidakhadiran_pegawai";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readIzinCuti()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE keperluan = 'Cuti'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readIzinTugasLuarKota()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE keperluan = 'Izin Tugas Luar Kota'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readIzinTugasLainnya()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE keperluan = 'Tanpa Keterangan'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}

```

6. Membuat objek Database untuk menghubungkan aplikasi dengan database, dan kemudian objek IzinKetidakhadiran dibuat dengan memanfaatkan koneksi tersebut.
   ```php
   
   $database = new Database();
   $db = $database->conn;
   $izin = new IzinKetidakhadiran($db);


   ```
7. Melakukan Pemeriksaan Parameter hal ini dilakukan untuk memeriksa apakah parameter tersebut sudah ada atau belum
```php

// Mengecek parameter izin cuti, izin tugas luar kota, izin tugas lainnya, atau tentang ada di URL

$izin_cuti = isset($_GET['izin_cuti']) ? true : false;
$izin_tugas_luar_kota = isset($_GET['izin_tugas_luar_kota']) ? true : false;
$izin_tugas_lainnya = isset($_GET['izin_tugas_lainnya']) ? true : false;
$tentang = isset($_GET['tentang']) ? true : false;
?>

```
8. Menampilkan tampilan navigasi untuk menampilkan halaman beranda, izin cuti, izin lainnya, tentang dengan menggunakan bootstrap
   
   ```php

   <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Sistem Izin Dosen</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="?">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?izin_cuti=true">Izin Cuti</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?izin_tugas_luar_kota=true">Izin Tugas Luar Kota</a> <!-- Link baru untuk Izin Tugas Luar Kota -->
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?izin_tugas_lainnya=true">Tanpa Keterangan</a> <!-- Link baru untuk Izin Tugas Tanpa Keterangan -->
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?tentang=true">Tentang</a>
                </li>
            </ul>
        </div>
    </nav>
   
   ```
9. Menampilkan semua data yang telah diinputkan kedalam bentuk sebuah tabel
   data yang diambil berdasarkan data isin cuti, izin lainya, dan tentang. pada navbar tentang hanya akan menampilkan id izin serta keperluan dari izin tersebut, selain itu maka tidak akan ditampilkan.

   ```php
   
   <div class="container mt-5">
        <h2>Data Izin Ketidakhadiran Pegawai</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID Izin</th>
                    <th>Keperluan</th>
                    <?php if (!$tentang): ?>
                        <th>Finger Print ID</th>
                        <th>Tanggal Mulai Izin</th>
                        <th>Durasi Izin (Hari)</th>
                        <th>Durasi Izin (Jam)</th>
                        <th>Durasi Izin (Menit)</th>
                        <th>Nama Pengusul</th>
                        <th>Tanggal Usul</th>
                        <th>Putusan</th>
                        <th>Tanggal Putusan</th>
                        <th>Catatan</th>
                        <th>Dosen</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($izin_cuti) {
                    $stmt = $izin->readIzinCuti();
                } elseif ($izin_tugas_luar_kota) {
                    $stmt = $izin->readIzinTugasLuarKota();  // Menampilkan data Izin Tugas Luar Kota
                } elseif ($izin_tugas_lainnya) {
                    $stmt = $izin->readIzinTugasLainnya();  // Menampilkan data Izin Tugas Tanpa Keterangan
                } elseif ($tentang) {
                    $query = "SELECT id_izin, keperluan, finger_print_id FROM " . $izin->table_name;
                    $stmt = $db->prepare($query);
                    $stmt->execute();
                } else {
                    $stmt = $izin->read();
                }

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>
                        <td>{$row['id_izin']}</td>
                        <td>{$row['keperluan']}</td>";
                    if (!$tentang) {
                        echo "<td>{$row['finger_print_id']}</td>
                              <td>{$row['tgl_mulai_izin']}</td>
                              <td>{$row['durasi_izin_hari']}</td>
                              <td>{$row['durasi_izin_jam']}</td>
                              <td>{$row['durasi_izin_menit']}</td>
                              <td>{$row['nama_pengusul']}</td>
                              <td>{$row['tgl_usul']}</td>
                              <td>{$row['putusan']}</td>
                              <td>{$row['tgl_putusan']}</td>
                              <td>{$row['catatan']}</td>
                              <td>{$row['dosen']}</td>";
                    }
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    
   ```

10. Menambahkan script js bootstrap untuk fitur tampilan pada output

``php

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

```

## Coding Tugas 2

```php

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8"> <!-- Mengatur encoding dokumen -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsive meta tag -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> <!-- Mengimpor CSS Bootstrap -->
    <title>Data Izin Ketidakhadiran Pegawai</title> <!-- Judul halaman -->
    
    <style>
        /* Sembunyikan semua konten div secara default */
        .content-section {
            display: none;
        }
        
        /* Tampilkan div yang aktif */
        .active {
            display: block;
        }
    </style>
</head>

<body>
    <!-- Navbar Bootstrap -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Sistem Izin Dosen</a> <!-- Nama aplikasi di navbar -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span> <!-- Tombol navbar di layar kecil -->
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="Tugas.php" onclick="showSection('beranda')">Beranda</a> <!-- Link ke halaman beranda -->
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Tugas.php" onclick="showSection('izin-cuti')">Izin Cuti</a> <!-- Link ke halaman izin cuti -->
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Tugas.php" onclick="showSection('izin-tugas')">Lainnya</a> <!-- Link ke halaman izin tugas -->
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Tugas.php" onclick="showSection('tentang')">Tentang</a> <!-- Link ke halaman tentang -->
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <!-- Konten Beranda -->
        <div id="beranda" class="content-section active">
            <div class="jumbotron">
                <h1 class="display-4">Selamat Datang di Website Data Izin Ketidakhadiran Pegawai</h1>
                <p class="lead">Silahkan Pilih Sesuai Kepentingan Anda</p>
                <hr class="my-4">
                <p>Gunakan navigasi di atas untuk mengakses halaman yang Anda butuhkan, seperti Izin Cuti, Izin Tugas, dan informasi lainnya.</p>
            </div>
        </div>

        <!-- Konten Izin Cuti -->
        <div id="izin-cuti" class="content-section">
            <h2>Data Izin Cuti</h2>
            <p>Berikut adalah daftar izin cuti pegawai</p>
            <!-- Isi tabel atau data izin cuti -->
        </div>

        <!-- Konten Izin Tugas -->
        <div id="izin-tugas" class="content-section">
            <h2>Data Lainnya</h2>
            <p>Berikut adalah daftar keterangan lain pegawai</p>
            <!-- Isi tabel atau data izin tugas -->
        </div>

        <!-- Konten Tentang -->
        <div id="tentang" class="content-section">
            <h2>Tentang Sistem Izin Dosen</h2>
            <p>Website ini dibuat untuk mempermudah proses pengajuan dan manajemen izin ketidakhadiran pegawai...</p>
        </div>
    </div>

    <!-- Menyertakan file JavaScript eksternal untuk Bootstrap dan jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- JavaScript untuk mengontrol penampilan konten -->
    <script>
        // Fungsi untuk menampilkan bagian yang diinginkan berdasarkan id
        function showSection(sectionId) {
            // Sembunyikan semua div dengan class 'content-section'
            var sections = document.getElementsByClassName('content-section');
            for (var i = 0; i < sections.length; i++) {
                sections[i].classList.remove('active');
            }

            // Tampilkan div yang sesuai dengan id
            document.getElementById(sectionId).classList.add('active');
        }
    </script>
</body>

</html>

<?php
session_start();

// Kelas untuk koneksi database
class Database
{
    private $host = 'localhost';
    private $db_name = 'persuratan_dosen';
    private $username = 'root';
    private $password = '';
    public $conn;

    public function __construct()
    {
        $this->connect();
    }

    public function connect()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
    }
}

// Kelas model untuk mengelola data izin ketidakhadiran pegawai
class IzinKetidakhadiran
{
    private $conn;
    public $table_name = "izin_ketidakhadiran_pegawai";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readIzinCuti()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE keperluan = 'Cuti'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readIzinTugasLuarKota()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE keperluan = 'Izin Tugas Luar Kota'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readIzinTugasLainnya()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE keperluan = 'Tanpa Keterangan'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}

$database = new Database();
$db = $database->conn;
$izin = new IzinKetidakhadiran($db);

// Mengecek parameter izin cuti, izin tugas luar kota, izin tugas lainnya, atau tentang ada di URL
$izin_cuti = isset($_GET['izin_cuti']) ? true : false;
$izin_tugas_luar_kota = isset($_GET['izin_tugas_luar_kota']) ? true : false;
$izin_tugas_lainnya = isset($_GET['izin_tugas_lainnya']) ? true : false;
$tentang = isset($_GET['tentang']) ? true : false;
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <center>
        <title>Data Izin Ketidakhadiran Pegawai</title>
    </center>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Sistem Izin Dosen</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="?">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?izin_cuti=true">Izin Cuti</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?izin_tugas_luar_kota=true">Izin Tugas Luar Kota</a> <!-- Link baru untuk Izin Tugas Luar Kota -->
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?izin_tugas_lainnya=true">Tanpa Keterangan</a> <!-- Link baru untuk Izin Tugas Tanpa Keterangan -->
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?tentang=true">Tentang</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h2>Data Izin Ketidakhadiran Pegawai</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID Izin</th>
                    <th>Keperluan</th>
                    <?php if (!$tentang): ?>
                        <th>Finger Print ID</th>
                        <th>Tanggal Mulai Izin</th>
                        <th>Durasi Izin (Hari)</th>
                        <th>Durasi Izin (Jam)</th>
                        <th>Durasi Izin (Menit)</th>
                        <th>Nama Pengusul</th>
                        <th>Tanggal Usul</th>
                        <th>Putusan</th>
                        <th>Tanggal Putusan</th>
                        <th>Catatan</th>
                        <th>Dosen</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($izin_cuti) {
                    $stmt = $izin->readIzinCuti();
                } elseif ($izin_tugas_luar_kota) {
                    $stmt = $izin->readIzinTugasLuarKota();  // Menampilkan data Izin Tugas Luar Kota
                } elseif ($izin_tugas_lainnya) {
                    $stmt = $izin->readIzinTugasLainnya();  // Menampilkan data Izin Tugas Tanpa Keterangan
                } elseif ($tentang) {
                    $query = "SELECT id_izin, keperluan, finger_print_id FROM " . $izin->table_name;
                    $stmt = $db->prepare($query);
                    $stmt->execute();
                } else {
                    $stmt = $izin->read();
                }

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>
                        <td>{$row['id_izin']}</td>
                        <td>{$row['keperluan']}</td>";
                    if (!$tentang) {
                        echo "<td>{$row['finger_print_id']}</td>
                              <td>{$row['tgl_mulai_izin']}</td>
                              <td>{$row['durasi_izin_hari']}</td>
                              <td>{$row['durasi_izin_jam']}</td>
                              <td>{$row['durasi_izin_menit']}</td>
                              <td>{$row['nama_pengusul']}</td>
                              <td>{$row['tgl_usul']}</td>
                              <td>{$row['putusan']}</td>
                              <td>{$row['tgl_putusan']}</td>
                              <td>{$row['catatan']}</td>
                              <td>{$row['dosen']}</td>";
                    }
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

```
### Output index
![image](https://github.com/user-attachments/assets/f8c4b842-e9ee-4b20-aeaa-84d20234146e)

### Output tampilan beranda
![image](https://github.com/user-attachments/assets/b9b669ed-dfc8-4110-9388-961ca468a543)

### Output  izin cuti
![image](https://github.com/user-attachments/assets/a61c1d21-4deb-4b45-ba52-1ae9e27a764a)

### Output izin tugas luar kota 
![image](https://github.com/user-attachments/assets/ac508d3f-a8f8-47a3-8be2-7a6885483a36)

### Output tanpa keterangan
![image](https://github.com/user-attachments/assets/1428a4dd-ae23-4c54-92bc-03b564ea7446)

### Output tentang
![image](https://github.com/user-attachments/assets/af3ea586-9b4a-4466-a29e-71b85acf7245)





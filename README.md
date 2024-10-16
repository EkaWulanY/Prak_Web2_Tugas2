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

2. Memulai sesi dalam coding php menggunakan session_start();
session start sendiri berfungsi untuk menampung data sementara

   ```php
   <?php
   session_start();
   
   ```

3. membuat class database untuk mengkonekan pada database

 ```php

// Kelas untuk koneksi database

class Database {
    private $host = 'localhost';  // Nama host server database
    private $db_name = 'persuratan_dosen';  // Nama database yang digunakan
    private $username = 'root';  // Nama pengguna untuk mengakses database
    private $password = '';  // Kata sandi untuk pengguna database
    public $conn;  // Variabel untuk menyimpan koneksi database

    // Constructor untuk menginisialisasi koneksi saat objek dibuat
    public function __construct() {
        $this->connect();  // Memanggil metode koneksi database
    }

    // Metode untuk melakukan koneksi ke database menggunakan PDO

    public function connect() {
        $this->conn = null;  // Menginisialisasi variabel koneksi menjadi null

    // melakukan uji coba untuk mengetahui apakah terjadi error atau tidak

        try {
            // Mencoba membuat koneksi ke database dengan PDO
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
            // Mengatur mode error pada PDO menjadi exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            // Menampilkan pesan kesalahan jika koneksi gagal
            echo "Connection error: " . $exception->getMessage();
        }
    }
}

```

Kelas Database bertanggung jawab untuk mengatur koneksi ke database MySQL menggunakan PDO. Parameter seperti host, db_name, username, dan password digunakan untuk konfigurasi koneksi. Metode connect() mencoba untuk membuat koneksi ke database dan menangani kesalahan yang mungkin terjadi dengan blok try-catch.

4. Membuat class izin ketidakhadiran
   kelas ini digunakan untuk melakukan operasi terkait ketidakhadiran pegawai. untuk membaca data gunakan metode read, dalam mengambil data tertentu atau membaca data yang dijadikan sub class dalam hal ini adalah izin cuti dan izin tugas dapat menambahkan where untuk mengambil data yang akan ditampilkan.

```php

// Metode untuk mengambil semua data izin ketidakhadiran dari tabel

    public function read() {
        $query = "SELECT * FROM " . $this->table_name;  // Query untuk mengambil semua data
        $stmt = $this->conn->prepare($query);  // Menyiapkan query
        $stmt->execute();  // Menjalankan query
        return $stmt;  // Mengembalikan hasil query
    }

    // Metode untuk mengambil data izin cuti saja

    public function readIzinCuti() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE keperluan = 'Cuti'";  // Query untuk mengambil data izin cuti
        $stmt = $this->conn->prepare($query);  // Menyiapkan query
        $stmt->execute();  // Menjalankan query
        return $stmt;  // Mengembalikan hasil query
    }

    // Metode untuk mengambil data izin tugas (luar kota dan lainnya)

    public function readIzinTugas() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE keperluan = 'Izin Tugas Luar Kota' OR keperluan = 'Tanpa Keterangan'";  // Query untuk mengambil data izin tugas
        $stmt = $this->conn->prepare($query);  // Menyiapkan query
        $stmt->execute();  // Menjalankan query
        return $stmt;  // Mengembalikan hasil query
    }
// Metode untuk mengambil data izin tugas luar kota saja

    public function readIzinTugasLuarKota() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE keperluan = 'Izin Tugas Luar Kota'";  // Query untuk mengambil data izin tugas luar kota
        $stmt = $this->conn->prepare($query);  // Menyiapkan query
        $stmt->execute();  // Menjalankan query
        return $stmt;  // Mengembalikan hasil query
    }

    // Metode untuk mengambil data izin tugas lainnya (selain luar kota)

    public function readIzinTugasLainnya() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE keperluan = 'Tanpa Keterangan'";  // Query untuk mengambil data lainya
        $stmt = $this->conn->prepare($query);  // Menyiapkan query
        $stmt->execute();  // Menjalankan query
        return $stmt;  // Mengembalikan hasil query
    }
}

```

5. Membuat objek Database untuk menghubungkan aplikasi dengan database, dan kemudian objek IzinKetidakhadiran dibuat dengan memanfaatkan koneksi tersebut.
   ```php

   // Inisialisasi koneksi database dan objek model izin
   $database = new Database();  // Membuat objek koneksi database
   $db = $database->conn;  // Mendapatkan koneksi yang sudah terhubung
   $izin = new IzinKetidakhadiran($db);  // Membuat objek model izin ketidakhadiran

   ```
6. Melakukan Pemeriksaan Parameter hal ini dilakukan untuk memeriksa apakah parameter tersebut sudah ada atau belum
```php

// Mengecek parameter izin cuti, izin tugas, atau tentang ada di URL

$izin_cuti = isset($_GET['izin_cuti']) ? true : false;  // Mengecek apakah parameter izin cuti ada di URL
$izin_tugas = isset($_GET['izin_tugas']) ? true : false;  // Mengecek apakah parameter izin tugas ada di URL
$tentang = isset($_GET['tentang']) ? true : false;  // Mengecek apakah parameter tentang ada di URL

?>

```
7. Menampilkan tampilan navigasi untuk menampilkan halaman beranda, izin cuti, izin lainnya, tentang dengan menggunakan bootstrap
   
   ```php

   <nav class="navbar navbar-expand-lg navbar-light bg-light">  <!-- Navbar Bootstrap -->
        <a class="navbar-brand" href="#">Sistem Izin Dosen</a>  <!-- Nama aplikasi di navbar -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>  <!-- Tombol navbar di layar kecil -->
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="?">Beranda</a>  <!-- Link ke halaman beranda -->
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?izin_cuti=true">Izin Cuti</a>  <!-- Link ke halaman izin cuti -->
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?izin_tugas=true">Izin Tugas</a>  <!-- Link ke halaman izin tugas -->
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?tentang=true">Tentang</a>  <!-- Link ke halaman tentang -->
                </li>
            </ul>
        </div>
    </nav>
   
   ```
8. Menampilkan semua data yang telah diinputkan kedalam bentuk sebuah tabel
   data yang diambil berdasarkan data isin cuti, izin lainya, dan tentang. pada navbar tentang hanya akan menampilkan id izin serta keperluan dari izin tersebut, selain itu maka tidak akan ditampilkan.

   ```php

   <div class="container mt-5"> <!-- Membuat container untuk konten utama -->
        <h2>Data Izin Ketidakhadiran Pegawai</h2> <!-- Judul konten -->
        <table class="table table-striped"> <!-- Tabel dengan gaya Bootstrap -->
            <thead>
                <tr>
                    <th>ID Izin</th>
                    <th>Keperluan</th>
                    <?php if (!$tentang): ?> <!-- Menampilkan kolom tambahan jika bukan halaman "tentang" -->
                        <th>Finger Print ID</th>
                        <th>Tanggal Mulai Izin</th>
                        <th>Durasi Izin (Hari)</th>
                        <th>Durasi Izin (Jam)</th>
                        <th>Durasi Izin (Menit)</th>
                        <th>Nama Pengusul</th>
                        <th>Tanggal Usul</th>
                        <th>Tanda Tangan Pengusul</th>
                        <th>Putusan</th>
                        <th>Tanggal Putusan</th>
                        <th>Tanda Tangan Atasan</th>
                        <th>Catatan</th>
                        <th>Dosen</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
   
                <?php
                // Mengambil data izin berdasarkan pilihan (izin cuti, izin tugas, atau data umum)
   
                if ($izin_cuti) {
                    $stmt = $izin->readIzinCuti();  // Mengambil data izin cuti jika URL berisi parameter izin_cuti
                } elseif ($izin_tugas) {  // Jika parameter izin_tugas ada di URL
                    $stmt = $izin->readIzinTugas();  // Mengambil data izin tugas (baik luar kota maupun lainnya)
                } elseif ($tentang) {
                    // Menampilkan data singkat untuk halaman "tentang"
   
                    // Query singkat untuk halaman "tentang"
   
                    $query = "SELECT id_izin, keperluan, finger_print_id FROM " . $izin->table_name;
                    $stmt = $db->prepare($query);  // Menyiapkan query
                    $stmt->execute();  // Menjalankan query
                } else {
                    $stmt = $izin->read();  // Jika tidak ada parameter spesifik, mengambil semua data izin
                }

                // Looping data hasil query dan menampilkannya dalam tabel
   
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    // Menampilkan setiap baris data izin
   
                    echo "<tr>
                                                <td>{$row['id_izin']}</td>
                                                <td>{$row['keperluan']}</td>";
                    if (!$tentang) {
   
                        // Menampilkan kolom tambahan untuk data izin kecuali halaman "tentang"
   
                        echo "<td>{$row['finger_print_id']}</td>
                                                  <td>{$row['tgl_mulai_izin']}</td>
                                                  <td>{$row['durasi_izin_hari']}</td>
                                                  <td>{$row['durasi_izin_jam']}</td>
                                                  <td>{$row['durasi_izin_menit']}</td>
                                                  <td>{$row['nama_pengusul']}</td>
                                                  <td>{$row['tgl_usul']}</td>
                                                  <td><img src='{$row['ttd_pengusul']}' alt='Tanda Tangan Pengusul' style='width:100px; height:auto;'></td>
                                                  <td>{$row['putusan']}</td>
                                                  <td>{$row['tgl_putusan']}</td>
                                                  <td><img src='{$row['ttd_atasan']}' alt='Tanda Tangan Atasan' style='width:100px; height:auto;'></td>
                                                  <td>{$row['catatan']}</td>
                                                  <td>{$row['dosen']}</td>";
                    }
                    echo "</tr>";  // Menutup tag <tr> untuk baris data saat ini
                }
                ?>
            </tbody>
        </table>
    </div>

   ```

9. Menambahkan script js bootstrap untuk fitur tampilan pada output

``php

<!-- Menyertakan file JavaScript eksternal untuk Bootstrap dan jQuery -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
```

## Coding Tugas 2

```php

<?php

// Memulai sesi PHP untuk penggunaan session di dalam aplikasi

session_start();

// Kelas untuk koneksi database

class Database
{
    private $host = 'localhost';  // Nama host server database
    private $db_name = 'persuratan_dosen';  // Nama database yang digunakan
    private $username = 'root';  // Nama pengguna untuk mengakses database
    private $password = '';  // Kata sandi untuk pengguna database
    public $conn;  // Variabel untuk menyimpan koneksi database

    // Constructor untuk menginisialisasi koneksi saat objek dibuat

    public function __construct()
    {
        $this->connect();  // Memanggil metode koneksi database
    }

    // Metode untuk melakukan koneksi ke database menggunakan PDO

    public function connect()
    {
        $this->conn = null;  // Menginisialisasi variabel koneksi menjadi null

        // melakukan uji coba untuk mengetahui apakah terjadi error atau tidak
 
        try {
            // Mencoba membuat koneksi ke database dengan PDO

            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);

            // Mengatur mode error pada PDO menjadi exception

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {

            // Menampilkan pesan kesalahan jika koneksi gagal

            echo "Connection error: " . $exception->getMessage();
        }
    }
}

// Kelas model untuk mengelola data izin ketidakhadiran pegawai

class IzinKetidakhadiran
{
    private $conn;  // Variabel untuk menyimpan koneksi database
    public $table_name = "izin_ketidakhadiran_pegawai";  // Nama tabel di database

    // Constructor untuk menerima objek koneksi database sebagai parameter

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Metode untuk mengambil semua data izin ketidakhadiran dari tabel

    public function read()
    {
        $query = "SELECT * FROM " . $this->table_name;  // Query untuk mengambil semua data
        $stmt = $this->conn->prepare($query);  // Menyiapkan query
        $stmt->execute();  // Menjalankan query
        return $stmt;  // Mengembalikan hasil query
    }

    // Metode untuk mengambil data izin cuti saja

    public function readIzinCuti()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE keperluan = 'Cuti'";  // Query untuk mengambil data izin cuti
        $stmt = $this->conn->prepare($query);  // Menyiapkan query
        $stmt->execute();  // Menjalankan query
        return $stmt;  // Mengembalikan hasil query
    }

    // Metode untuk mengambil data izin tugas (luar kota dan lainnya)

    public function readIzinTugas()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE keperluan = 'Izin Tugas Luar Kota' OR keperluan = 'Tanpa Keterangan'";  // Query untuk mengambil data izin tugas
        $stmt = $this->conn->prepare($query);  // Menyiapkan query
        $stmt->execute();  // Menjalankan query
        return $stmt;  // Mengembalikan hasil query
    }

    // Metode untuk mengambil data izin tugas luar kota saja

    public function readIzinTugasLuarKota()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE keperluan = 'Izin Tugas Luar Kota'";  // Query untuk mengambil data izin tugas luar kota
        $stmt = $this->conn->prepare($query);  // Menyiapkan query
        $stmt->execute();  // Menjalankan query
        return $stmt;  // Mengembalikan hasil query
    }

    // Metode untuk mengambil data izin tugas lainnya (selain luar kota)

    public function readIzinTugasLainnya()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE keperluan = 'Tanpa Keterangan'";  // Query untuk mengambil data lain
        $stmt = $this->conn->prepare($query);  // Menyiapkan query
        $stmt->execute();  // Menjalankan query
        return $stmt;  // Mengembalikan hasil query
    }
}

// Inisialisasi koneksi database dan objek model izin

$database = new Database();  // Membuat objek koneksi database
$db = $database->conn;  // Mendapatkan koneksi yang sudah terhubung
$izin = new IzinKetidakhadiran($db);  // Membuat objek model izin ketidakhadiran

// Mengecek parameter izin cuti, izin tugas, atau tentang ada di URL

$izin_cuti = isset($_GET['izin_cuti']) ? true : false;  // Mengecek apakah parameter izin cuti ada di URL
$izin_tugas = isset($_GET['izin_tugas']) ? true : false;  // Mengecek apakah parameter izin tugas ada di URL
$tentang = isset($_GET['tentang']) ? true : false;  // Mengecek apakah parameter tentang ada di URL
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8"> <!-- Mengatur encoding dokumen -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsive meta tag -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> <!-- Mengimpor CSS Bootstrap -->
    <center>
        <title>Data Izin Ketidakhadiran Pegawai</title>
    </center> <!-- Judul halaman -->
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light"> <!-- Navbar Bootstrap -->
        <a class="navbar-brand" href="#">Sistem Izin Dosen</a> <!-- Nama aplikasi di navbar -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span> <!-- Tombol navbar di layar kecil -->
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="?">Beranda</a> <!-- Link ke halaman beranda -->
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?izin_cuti=true">Izin Cuti</a> <!-- Link ke halaman izin cuti -->
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?izin_tugas=true">Lainnya</a> <!-- Link ke halaman izin tugas -->
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?tentang=true">Tentang</a> <!-- Link ke halaman tentang -->
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5"> <!-- Membuat container untuk konten utama -->
        <h2>Data Izin Ketidakhadiran Pegawai</h2> <!-- Judul konten -->
        <table class="table table-striped"> <!-- Tabel dengan gaya Bootstrap -->
            <thead>
                <tr>
                    <th>ID Izin</th>
                    <th>Keperluan</th>
                    <?php if (!$tentang): ?> <!-- Menampilkan kolom tambahan jika bukan halaman "tentang" -->
                        <th>Finger Print ID</th>
                        <th>Tanggal Mulai Izin</th>
                        <th>Durasi Izin (Hari)</th>
                        <th>Durasi Izin (Jam)</th>
                        <th>Durasi Izin (Menit)</th>
                        <th>Nama Pengusul</th>
                        <th>Tanggal Usul</th>
                        <th>Tanda Tangan Pengusul</th>
                        <th>Putusan</th>
                        <th>Tanggal Putusan</th>
                        <th>Tanda Tangan Atasan</th>
                        <th>Catatan</th>
                        <th>Dosen</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php
                // Mengambil data izin berdasarkan pilihan (izin cuti, izin tugas, atau data umum)
                if ($izin_cuti) {
                    $stmt = $izin->readIzinCuti();  // Mengambil data izin cuti jika URL berisi parameter izin_cuti
                } elseif ($izin_tugas) {  // Jika parameter izin_tugas ada di URL
                    $stmt = $izin->readIzinTugas();  // Mengambil data izin tugas (baik luar kota maupun lainnya)
                } elseif ($tentang) {
                    // Menampilkan data singkat untuk halaman "tentang"
                    // Query singkat untuk halaman "tentang"
                    $query = "SELECT id_izin, keperluan, finger_print_id FROM " . $izin->table_name;
                    $stmt = $db->prepare($query);  // Menyiapkan query
                    $stmt->execute();  // Menjalankan query
                } else {
                    $stmt = $izin->read();  // Jika tidak ada parameter spesifik, mengambil semua data izin
                }

                // Looping data hasil query dan menampilkannya dalam tabel
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    // Menampilkan setiap baris data izin
                    echo "<tr>
                                                <td>{$row['id_izin']}</td>
                                                <td>{$row['keperluan']}</td>";
                    if (!$tentang) {
                        // Menampilkan kolom tambahan untuk data izin kecuali halaman "tentang"
                        echo "<td>{$row['finger_print_id']}</td>
                                                  <td>{$row['tgl_mulai_izin']}</td>
                                                  <td>{$row['durasi_izin_hari']}</td>
                                                  <td>{$row['durasi_izin_jam']}</td>
                                                  <td>{$row['durasi_izin_menit']}</td>
                                                  <td>{$row['nama_pengusul']}</td>
                                                  <td>{$row['tgl_usul']}</td>
                                                  <td><img src='{$row['ttd_pengusul']}' alt='Tanda Tangan Pengusul' style='width:100px; height:auto;'></td>
                                                  <td>{$row['putusan']}</td>
                                                  <td>{$row['tgl_putusan']}</td>
                                                  <td><img src='{$row['ttd_atasan']}' alt='Tanda Tangan Atasan' style='width:100px; height:auto;'></td>
                                                  <td>{$row['catatan']}</td>
                                                  <td>{$row['dosen']}</td>";
                    }
                    echo "</tr>";  // Menutup tag <tr> untuk baris data saat ini
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Menyertakan file JavaScript eksternal untuk Bootstrap dan jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

```

### Output tampilan beranda
![image](https://github.com/user-attachments/assets/c80a0dee-ed16-49a7-b2a0-7b8112af7808)

### Output tampilan izin cuti
![image](https://github.com/user-attachments/assets/8e712a6e-a393-4cf8-9265-14ac8526e578)

### Output tampilan lainnya
![image](https://github.com/user-attachments/assets/6b4df763-1099-4fce-8f84-cf3ef699816e)

### Output tentang
![image](https://github.com/user-attachments/assets/6e045e51-9cc1-438e-8b35-993e16fe0624)




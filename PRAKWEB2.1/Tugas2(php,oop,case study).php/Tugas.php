<?php
session_start(); // Memulai session PHP untuk mengelola data session.


// Kelas untuk koneksi database
class Database
{
    private $host = 'localhost'; // Nama host database, dalam hal ini 'localhost'.
    private $db_name = 'persuratan_dosen'; // Nama database yang digunakan.
    private $username = 'root'; // Username untuk koneksi ke database, default adalah 'root'.
    private $password = ''; // Password untuk koneksi ke database, dalam hal ini kosong karena default XAMPP.
    public $conn; // Properti untuk menyimpan koneksi database.

    public function __construct()
    {
        $this->connect(); // Memanggil metode connect() saat objek Database dibuat.
    }

    public function connect()
    {
        $this->conn = null; // Inisialisasi koneksi sebagai null.

        try {
            // Mencoba membuat koneksi ke database menggunakan PDO.
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Mengatur mode kesalahan PDO agar melempar exception.
        } catch (PDOException $exception) {
            // Menampilkan pesan error jika koneksi gagal.
            echo "Connection error: " . $exception->getMessage();
        }
    }
}

// Kelas model untuk mengelola data izin ketidakhadiran pegawai
class IzinKetidakhadiran
{
    private $conn; // Properti untuk menyimpan koneksi database.
    public $table_name = "izin_ketidakhadiran_pegawai"; // Nama tabel yang digunakan di database.

    public function __construct($db)
    {
        $this->conn = $db; // Menginisialisasi koneksi database melalui parameter konstruktornya.
    }

    public function read()
    {
        // Query untuk mengambil semua data izin dari tabel.
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query); // Mempersiapkan query.
        $stmt->execute(); // Menjalankan query.
        return $stmt; // Mengembalikan hasil statement.
    }

    public function readIzinCuti()
    {
        // Query untuk mengambil data izin dengan keperluan 'Cuti'.
        $query = "SELECT * FROM " . $this->table_name . " WHERE keperluan = 'Cuti'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readIzinTugasLuarKota()
    {
        // Query untuk mengambil data izin dengan keperluan 'Izin Tugas Luar Kota'.
        $query = "SELECT * FROM " . $this->table_name . " WHERE keperluan = 'Izin Tugas Luar Kota'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readIzinTugasLainnya()
    {
        // Query untuk mengambil data izin dengan keperluan 'Tanpa Keterangan'.
        $query = "SELECT * FROM " . $this->table_name . " WHERE keperluan = 'Tanpa Keterangan'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}

// Membuat objek koneksi database.
$database = new Database();
$db = $database->conn; // Mengakses properti koneksi dari objek database.
$izin = new IzinKetidakhadiran($db); // Membuat objek IzinKetidakhadiran dengan koneksi database.

// Mengecek parameter izin cuti, izin tugas luar kota, izin tugas lainnya, atau tentang ada di URL.
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
    <!-- Menghubungkan dengan Bootstrap CSS untuk styling -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <center>
        <title>Data Izin Ketidakhadiran Pegawai</title>
    </center>
</head>

<body>
    <!-- Bagian Navbar (navigasi) -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Sistem Izin Dosen</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
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
                    <a class="nav-link" href="?izin_tugas_luar_kota=true">Izin Tugas Luar Kota</a> <!-- Link baru untuk Izin Tugas Luar Kota -->
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?izin_tugas_lainnya=true">Tanpa Keterangan</a> <!-- Link baru untuk Izin Tugas Tanpa Keterangan -->
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?tentang=true">Tentang</a> <!-- Link ke halaman tentang -->
                </li>
            </ul>
        </div>
    </nav>

    <!-- Bagian konten utama -->
    <div class="container mt-5">
        <h2>Data Izin Ketidakhadiran Pegawai</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID Izin</th>
                    <th>Keperluan</th>
                    <?php if (!$tentang): ?>
                        <!-- Kolom tambahan yang hanya ditampilkan jika bukan halaman "Tentang" -->
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
                // Menampilkan data sesuai dengan parameter yang diterima dari URL.
                if ($izin_cuti) {
                    $stmt = $izin->readIzinCuti();
                } elseif ($izin_tugas_luar_kota) {
                    $stmt = $izin->readIzinTugasLuarKota();  // Menampilkan data Izin Tugas Luar Kota
                } elseif ($izin_tugas_lainnya) {
                    $stmt = $izin->readIzinTugasLainnya();  // Menampilkan data Izin Tugas Tanpa Keterangan
                } elseif ($tentang) {
                    // Jika halaman "Tentang", hanya menampilkan ID Izin, Keperluan, dan Finger Print ID.
                    $query = "SELECT id_izin, keperluan, finger_print_id FROM " . $izin->table_name;
                    $stmt = $db->prepare($query);
                    $stmt->execute();
                } else {
                    // Menampilkan semua data izin jika tidak ada parameter tertentu.
                    $stmt = $izin->read();
                }

                // Menampilkan data izin dalam bentuk tabel.
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    // Mengambil setiap baris data yang dikembalikan dari query dan menampilkannya dalam bentuk tabel.
                    echo "<tr>
                    <td>{$row['id_izin']}</td>
                    <td>{$row['keperluan']}</td>";

                    // Jika halaman yang diakses bukan halaman "tentang", tampilkan kolom tambahan untuk detail izin.
                    if (!$tentang) {
                        // Menampilkan kolom tambahan jika bukan halaman "tentang".
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
                    // Menutup tag <tr> untuk setiap baris data.
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
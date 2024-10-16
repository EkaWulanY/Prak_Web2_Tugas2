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
// Memulai sesi PHP untuk penggunaan session di dalam aplikasi
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
5. 

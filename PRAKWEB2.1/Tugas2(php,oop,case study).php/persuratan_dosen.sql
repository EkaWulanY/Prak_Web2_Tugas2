-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 17, 2024 at 02:49 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `persuratan_dosen`
--

-- --------------------------------------------------------

--
-- Table structure for table `izin_ketidakhadiran_pegawai`
--

CREATE TABLE `izin_ketidakhadiran_pegawai` (
  `id_izin` int NOT NULL,
  `keperluan` varchar(255) NOT NULL,
  `finger_print_id` varchar(20) NOT NULL,
  `tgl_mulai_izin` date NOT NULL,
  `durasi_izin_hari` varchar(20) NOT NULL,
  `durasi_izin_jam` varchar(20) NOT NULL,
  `durasi_izin_menit` varchar(20) NOT NULL,
  `nama_pengusul` varchar(255) NOT NULL,
  `tgl_usul` date NOT NULL,
  `ttd_pengusul` varchar(255) NOT NULL,
  `putusan` varchar(50) NOT NULL,
  `tgl_putusan` date NOT NULL,
  `ttd_atasan` varchar(255) NOT NULL,
  `catatan` varchar(255) NOT NULL,
  `dosen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `izin_ketidakhadiran_pegawai`
--

INSERT INTO `izin_ketidakhadiran_pegawai` (`id_izin`, `keperluan`, `finger_print_id`, `tgl_mulai_izin`, `durasi_izin_hari`, `durasi_izin_jam`, `durasi_izin_menit`, `nama_pengusul`, `tgl_usul`, `ttd_pengusul`, `putusan`, `tgl_putusan`, `ttd_atasan`, `catatan`, `dosen`) VALUES
(1, 'Izin Sakit', 'FP002', '2024-10-02', '3', '1', '40', 'Amelia', '2024-09-26', 'path/to/signature2.png', 'Disetujui', '2024-10-03', 'path/to/supervisor_sign2.png', 'Segera pulih dan bergabung dengan kami', 'Dosen B'),
(2, 'Cuti', 'FP001', '2024-10-01', '7', '4', '0', 'Anastasya', '2024-09-25', 'path/to/signature1.png', 'Disetujuai', '2024-10-02', 'path/to/supervisor_sign1.png\'', '-', 'Dosen C'),
(3, 'Izin Keperluan Keluarga', 'FP003', '2024-10-02', '2', '2', '1', 'Fachri', '2024-10-01', 'path/to/signature3.png', 'Ditolak', '2024-10-02', 'path/to/supervisor_sign3.png', 'Dokumen Tidak Lengkap', 'Dosen A'),
(4, 'Izin Tugas Luar Kota', 'FP004', '2024-10-14', '7', '4', '0', 'Aditya', '2024-10-04', 'path/to/signature4.png', 'Disetujui', '2024-10-11', 'path/to/supervisor_sign4.png', 'Semangat dan semoga sukses', 'Dosen D'),
(5, 'Tanpa Keterangan', 'FP005', '2024-10-21', '30', '0', '0', 'Sasa', '2024-10-16', 'path/to/signature5.png', 'Ditolak', '2024-10-18', 'path/to/supervisor_sign5.png', '-', 'Dosen E'),
(6, 'Izin Tugas Luar Kota', 'FP006', '2024-10-16', '7', '2', '4', 'Andin', '2024-10-14', 'Tanda Tangan Pengusul', 'Disetujui', '2024-10-15', 'Tanda Tangan Atasan', 'Eeefghjkl', 'Dosen A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `izin_ketidakhadiran_pegawai`
--
ALTER TABLE `izin_ketidakhadiran_pegawai`
  ADD PRIMARY KEY (`id_izin`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `izin_ketidakhadiran_pegawai`
--
ALTER TABLE `izin_ketidakhadiran_pegawai`
  MODIFY `id_izin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

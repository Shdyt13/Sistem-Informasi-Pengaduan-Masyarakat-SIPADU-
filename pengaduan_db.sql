-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Waktu pembuatan: 04 Feb 2026 pada 11.14
-- Versi server: 10.4.34-MariaDB-1:10.4.34+maria~ubu2004
-- Versi PHP: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Basis data: `pengaduan_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `penduduk`
--

CREATE TABLE `penduduk` (
  `id` int(11) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `pekerjaan` varchar(50) NOT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `agama` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `penduduk`
--

INSERT INTO `penduduk` (`id`, `nik`, `nama`, `alamat`, `no_telp`, `pekerjaan`, `tempat_lahir`, `tgl_lahir`, `agama`) VALUES
(6, '1263545634737373', 'Salman', 'Bintan', '087742121251', 'Swasta', 'Dabok', '2007-03-01', '-'),
(8, '1234567890129087', 'maninta', 'Kijang', '087742121251', 'IRT', 'UBAN', '2000-07-11', 'Islam'),
(9, '1234567898765432', 'Ewang', 'Lagoy', '087789645378', 'Serabut', NULL, NULL, NULL),
(10, '8666382923882345', 'salman', 'Pinang', '089909876543', 'Lepas', NULL, NULL, NULL),
(11, '2201992398489876', 'Ujang', 'Tepi Laut', '087742121251', 'CEO', 'Bintan', '2004-03-05', 'Islam'),
(12, '2122003984750987', 'Sandi', 'Bintan', '082268478964', 'Petani', NULL, NULL, NULL),
(14, '1234123412341234', 'Fajar', 'Dompak', '087742121251', 'Buruh Harian Lepas', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaduan`
--

CREATE TABLE `pengaduan` (
  `id` int(11) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `kategori` varchar(20) NOT NULL,
  `nama_pelapor` varchar(100) NOT NULL,
  `isi_laporan` text NOT NULL,
  `tanggapan` text DEFAULT NULL,
  `tgl_pengaduan` date NOT NULL,
  `status` enum('Pending','Proses','Selesai') NOT NULL DEFAULT 'Pending',
  `sub_kategori` varchar(50) DEFAULT NULL,
  `syarat_terlampir` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `pengaduan`
--

INSERT INTO `pengaduan` (`id`, `nik`, `kategori`, `nama_pelapor`, `isi_laporan`, `tanggapan`, `tgl_pengaduan`, `status`, `sub_kategori`, `syarat_terlampir`) VALUES
(22, '2201992398489876', 'PBI-JK', 'Ujang', '1', NULL, '2026-01-31', 'Selesai', 'Peserta Baru', 'NON DTSEN, Foto Copy KK dan KTP sebanyak 1 lembar'),
(23, '1263545634737373', 'PBI-JK', 'Salman', 'Aktivasi', NULL, '2026-01-31', 'Selesai', 'Reaktivasi', 'Surat Keterangan DTSEN, Foto Copy KK dan KTP sebanyak 1 lembar'),
(29, '1263545634737373', 'PBI-JK', 'Salman', 'Pembuatan PBI-JK', NULL, '2026-02-01', 'Pending', 'Peserta Baru', ''),
(30, '1234567890129087', 'DTSEN', 'maninta', 'DTSEN', NULL, '2026-02-02', 'Proses', NULL, 'NON DTSEN, Foto Copy KK dan KTP sebanyak 1 lembar, Foto Copy SKTM');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaduan_anggota`
--

CREATE TABLE `pengaduan_anggota` (
  `id` int(11) NOT NULL,
  `id_pengaduan` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `nik` varchar(20) DEFAULT NULL,
  `status_hubungan` varchar(50) DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `role` enum('admin','user','petugas') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama`, `role`) VALUES
(4, 'dinsos2026', '$2y$10$/5snbBnB33YUKFMdbfO26uEy6ZLTh62andSrDkyf8mUfMexwLoJMC', '', 'admin'),
(5, 'userlogin', '$2y$10$vVxM0iSTDAgcVGqF020BD.uO0GMBlXXOI7l9lWKC8XpywXWfBG4eW', 'user1', 'user'),
(8, 'userbaru', '$2y$10$q8tXwouW5pLGCO9j9gfhC.MNf0oiuOcgaKtNkMDgiAG0HJbNDgUGa', '', 'petugas');

--
-- Indeks untuk tabel yang dibuang
--

--
-- Indeks untuk tabel `penduduk`
--
ALTER TABLE `penduduk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengaduan_anggota`
--
ALTER TABLE `pengaduan_anggota`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pengaduan` (`id_pengaduan`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `penduduk`
--
ALTER TABLE `penduduk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `pengaduan_anggota`
--
ALTER TABLE `pengaduan_anggota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pengaduan_anggota`
--
ALTER TABLE `pengaduan_anggota`
  ADD CONSTRAINT `pengaduan_anggota_ibfk_1` FOREIGN KEY (`id_pengaduan`) REFERENCES `pengaduan` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

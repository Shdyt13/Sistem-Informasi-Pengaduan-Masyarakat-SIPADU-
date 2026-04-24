-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Waktu pembuatan: 24 Apr 2026 pada 21.38
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
-- Struktur dari tabel `log_aktivitas`
--

CREATE TABLE `log_aktivitas` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `aksi` varchar(255) NOT NULL,
  `target_data` varchar(100) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `otp_verifikasi`
--

CREATE TABLE `otp_verifikasi` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `kode_otp` varchar(6) NOT NULL,
  `tujuan` varchar(100) NOT NULL,
  `target_data` varchar(50) DEFAULT NULL,
  `expired_at` datetime NOT NULL,
  `status` enum('valid','used','expired') DEFAULT 'valid',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `otp_verifikasi`
--

INSERT INTO `otp_verifikasi` (`id`, `user_id`, `kode_otp`, `tujuan`, `target_data`, `expired_at`, `status`, `created_at`) VALUES
(1, 4, '249877', '082268478964', '6', '2026-04-24 19:59:51', '', '2026-04-24 19:54:51'),
(2, 4, '492176', '6282268478964', '6', '2026-04-24 20:16:45', '', '2026-04-24 20:11:45'),
(3, 4, '334511', '6282268478964', '14', '2026-04-24 20:17:23', '', '2026-04-24 20:12:23'),
(4, 4, '918976', '6282268478964', '6', '2026-04-24 20:22:22', '', '2026-04-24 20:17:22'),
(5, 4, '922180', '6282268478964', '6', '2026-04-24 20:23:56', '', '2026-04-24 20:18:56'),
(6, 4, '611943', '6282268478964', '6', '2026-04-24 20:25:56', '', '2026-04-24 20:20:56'),
(7, 4, '595188', '6282268478964', '14', '2026-04-24 20:26:58', '', '2026-04-24 20:21:58'),
(8, 4, '235840', '6282268478964', '6', '2026-04-24 20:30:13', '', '2026-04-24 20:25:13'),
(9, 4, '469050', '6282268478964', '6', '2026-04-24 20:30:40', '', '2026-04-24 20:25:40'),
(10, 4, '497174', '6282268478964', '6', '2026-04-24 20:33:57', '', '2026-04-24 20:28:57'),
(11, 4, '539777', '6282268478964', '6', '2026-04-24 20:35:51', '', '2026-04-24 20:30:51'),
(12, 4, '219697', '6282268478964', '6', '2026-04-24 20:37:15', '', '2026-04-24 20:32:15'),
(13, 4, '854776', '6282268478964', '6', '2026-04-24 20:39:38', 'used', '2026-04-24 20:34:38'),
(14, 4, '813841', '6282268478964', '14', '2026-04-24 20:40:09', 'used', '2026-04-24 20:35:09'),
(15, 4, '366550', '6282268478964', '12', '2026-04-24 20:42:39', '', '2026-04-24 20:37:39'),
(16, 4, '353552', '6282268478964', '8', '2026-04-24 20:55:26', '', '2026-04-24 20:40:26'),
(17, 4, '488049', '6285274150130', '8', '2026-04-24 20:56:51', '', '2026-04-24 20:41:51'),
(18, 4, '903040', '6285274150130', '8', '2026-04-24 21:00:39', '', '2026-04-24 20:45:39'),
(19, 4, '212432', '6282268478964', '8', '2026-04-24 21:47:58', '', '2026-04-24 21:32:58');

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
(8, '1234567890129087', 'maninta', 'Kijang', '087742121251', 'IRT', 'UBAN', '2000-07-11', 'Islam'),
(9, '1234567898765432', 'Ewang', 'Lagoy', '087789645378', 'Serabut', NULL, NULL, NULL),
(10, '8666382923882345', 'salman', 'Pinang', '089909876543', 'Lepas', NULL, NULL, NULL),
(11, '2201992398489876', 'Ujang', 'Tepi Laut', '087742121251', 'CEO', 'Bintan', '2004-03-05', 'Islam'),
(12, '2122003984750987', 'Sandi', 'Bintan', '082268478964', 'Petani', NULL, NULL, NULL);

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
(8, 'userbaru', '$2y$10$q8tXwouW5pLGCO9j9gfhC.MNf0oiuOcgaKtNkMDgiAG0HJbNDgUGa', '', 'petugas'),
(10, 'petugas', '$2y$10$OETFGTVTppAkj.2ek8.FqedJ2m0bIcW.qthvQkC7uTyxuAnhBOvf2', '', 'petugas');

--
-- Indeks untuk tabel yang dibuang
--

--
-- Indeks untuk tabel `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `otp_verifikasi`
--
ALTER TABLE `otp_verifikasi`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT untuk tabel `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `otp_verifikasi`
--
ALTER TABLE `otp_verifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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

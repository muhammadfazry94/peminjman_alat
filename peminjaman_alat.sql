-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 05, 2026 at 04:15 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `peminjaman_alat`
--

-- --------------------------------------------------------

--
-- Table structure for table `alat`
--

CREATE TABLE `alat` (
  `id` int(11) NOT NULL,
  `nama_alat` varchar(100) NOT NULL,
  `stok` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alat`
--

INSERT INTO `alat` (`id`, `nama_alat`, `stok`) VALUES
(1, 'Paku Beton', 77),
(2, 'Laptop', 12),
(3, 'Proyektor', 3),
(4, 'Kamera', 7),
(5, 'Tripod', 4),
(6, 'Bor Listrik', 4),
(7, 'Gerinda', 8),
(8, 'Palu', 15),
(9, 'Obeng Set', 20),
(10, 'Alat Cukur', 10);

-- --------------------------------------------------------

--
-- Table structure for table `log_aktivitas`
--

CREATE TABLE `log_aktivitas` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `aktivitas` varchar(255) DEFAULT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log_aktivitas`
--

INSERT INTO `log_aktivitas` (`id`, `user_id`, `aktivitas`, `waktu`) VALUES
(1, 1, 'Login', '2026-04-15 02:34:25'),
(2, 1, 'Melakukan peminjaman alat', '2026-04-15 02:34:25'),
(3, 1, 'Mengambil alat', '2026-04-15 02:34:25'),
(4, 1, 'Mengembalikan alat', '2026-04-15 02:34:25'),
(5, 1, 'Logout', '2026-04-15 02:34:25'),
(6, 1, 'Login sebagai admin', '2026-04-15 03:12:39'),
(7, 1, 'Login sebagai admin', '2026-04-15 03:12:58'),
(8, 12, 'Login sebagai ceo', '2026-04-15 03:14:23'),
(9, 12, 'Login sebagai ceo', '2026-04-15 03:17:19'),
(10, 2, 'Peminjaman disetujui oleh admin', '2026-04-15 03:55:25'),
(11, 2, 'Peminjaman disetujui oleh admin', '2026-04-15 03:55:30');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` int(11) NOT NULL,
  `user` varchar(100) DEFAULT NULL,
  `alat_id` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `user`, `alat_id`, `jumlah`, `status`, `tanggal`) VALUES
(1, 'admin', 1, 123, 'Disetujui', '2026-04-17 12:30:32'),
(2, 'admin', 1, 123, 'Disetujui', '2026-04-17 12:30:39'),
(3, 'admin', 6, 2, 'Disetujui', '2026-04-18 08:40:10'),
(4, 'admin', 10, 9, 'Ditolak', '2026-04-18 08:40:31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', '123', 'admin'),
(2, 'ardan', '123', 'konsumen'),
(3, 'hapid', '123', 'konsumen'),
(4, 'atep', '123', 'konsumen'),
(5, 'galih', '123', 'konsumen'),
(6, 'akif', '123', 'konsumen'),
(7, 'adit', '123', 'konsumen'),
(8, 'irgi', '123', 'konsumen'),
(9, 'amirul', '123', 'konsumen'),
(10, 'admin', '123', 'konsumen'),
(11, 'admin', '123', 'admin'),
(12, 'ceo', '123', 'ceo'),
(13, 'user1', '123', 'konsumen');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alat`
--
ALTER TABLE `alat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alat`
--
ALTER TABLE `alat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

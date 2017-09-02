-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 02 Sep 2017 pada 23.07
-- Versi Server: 10.1.24-MariaDB
-- PHP Version: 7.0.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jabetto-schedule`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `agenda`
--

CREATE TABLE `agenda` (
  `id` int(10) NOT NULL,
  `agenda_tipe_id` int(10) NOT NULL,
  `deskripsi` text NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_akhir` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `agenda`
--

INSERT INTO `agenda` (`id`, `agenda_tipe_id`, `deskripsi`, `tgl_mulai`, `tgl_akhir`) VALUES
(2, 5, 'makan siang', '2017-09-03', '2017-09-04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `agenda_teknisi`
--

CREATE TABLE `agenda_teknisi` (
  `id` int(10) NOT NULL,
  `agenda_id` int(10) NOT NULL,
  `teknisi_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `agenda_teknisi`
--

INSERT INTO `agenda_teknisi` (`id`, `agenda_id`, `teknisi_id`) VALUES
(4, 2, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `agenda_tipe`
--

CREATE TABLE `agenda_tipe` (
  `id` int(10) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `warna` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `agenda_tipe`
--

INSERT INTO `agenda_tipe` (`id`, `nama`, `warna`) VALUES
(5, 'PICKET', '#0015fe');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `website` varchar(45) NOT NULL,
  `no_telp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `email`, `alamat`, `website`, `no_telp`) VALUES
(1, 'BTN', 'btn@btn.com', 'btn', 'btn', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `status` enum('sa','admin','se') NOT NULL DEFAULT 'se',
  `no_telp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id`, `email`, `password`, `nama`, `status`, `no_telp`) VALUES
(1, 'admin@jabetto.com', '$2y$10$W5itITeUCMDU2CCCaF9Hr.trrf4oPgJTxJ2D3xnJm4Eqi.1kOchdO', 'Administrator', 'sa', '08123123123'),
(3, 'dhanar.j.kusuma@gmail.com', '$2y$10$xzlCl9C69ZNfkxuGJG6cYONuKqvutaNU6PcxHpvRq/fFbDyFSLlIG', 'admin123', 'admin', '123123123'),
(4, 'contohadmin@gmail.com', 'password_hash(admin123, PASSWORD_BCRYPT)', 'adminIT', 'se', '34124134');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pic`
--

CREATE TABLE `pic` (
  `id` int(10) NOT NULL,
  `pelanggan_id` int(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `no_telp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pic`
--

INSERT INTO `pic` (`id`, `pelanggan_id`, `nama`, `email`, `no_telp`) VALUES
(1, 1, 'asu', 'adfa@gmai.com', '134');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agenda_tipe_id` (`agenda_tipe_id`);

--
-- Indexes for table `agenda_teknisi`
--
ALTER TABLE `agenda_teknisi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agenda_id` (`agenda_id`),
  ADD KEY `teknisi_id` (`teknisi_id`);

--
-- Indexes for table `agenda_tipe`
--
ALTER TABLE `agenda_tipe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `pic`
--
ALTER TABLE `pic`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pic_ibfk_1` (`pelanggan_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `agenda_teknisi`
--
ALTER TABLE `agenda_teknisi`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `agenda_tipe`
--
ALTER TABLE `agenda_tipe`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `pic`
--
ALTER TABLE `pic`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `agenda`
--
ALTER TABLE `agenda`
  ADD CONSTRAINT `agenda_ibfk_1` FOREIGN KEY (`agenda_tipe_id`) REFERENCES `agenda_tipe` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `agenda_teknisi`
--
ALTER TABLE `agenda_teknisi`
  ADD CONSTRAINT `agenda_teknisi_ibfk_1` FOREIGN KEY (`agenda_id`) REFERENCES `agenda` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `agenda_teknisi_ibfk_2` FOREIGN KEY (`teknisi_id`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pic`
--
ALTER TABLE `pic`
  ADD CONSTRAINT `pic_ibfk_1` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

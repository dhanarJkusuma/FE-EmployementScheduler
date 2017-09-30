-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2017 at 07:53 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jabetto-scheduler`
--

-- --------------------------------------------------------

--
-- Table structure for table `agenda`
--

CREATE TABLE `agenda` (
  `id` int(10) NOT NULL,
  `agenda_tipe_id` int(10) NOT NULL,
  `deskripsi` text NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_akhir` date NOT NULL,
  `pelanggan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agenda`
--

INSERT INTO `agenda` (`id`, `agenda_tipe_id`, `deskripsi`, `tgl_mulai`, `tgl_akhir`, `pelanggan_id`) VALUES
(5, 5, '', '2017-09-06', '2017-09-07', 1),
(8, 6, 'omom', '2017-09-08', '2017-09-09', 1),
(9, 5, 'jfasdfasdfasdf', '2017-08-31', '2017-09-01', 1),
(10, 5, 'asdfasdf', '2017-09-29', '2017-09-30', 1),
(12, 6, 'Meeting bersama2', '2017-09-30', '2017-10-01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `agenda_teknisi`
--

CREATE TABLE `agenda_teknisi` (
  `id` int(10) NOT NULL,
  `agenda_id` int(10) NOT NULL,
  `teknisi_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `agenda_tipe`
--

CREATE TABLE `agenda_tipe` (
  `id` int(10) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `warna` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agenda_tipe`
--

INSERT INTO `agenda_tipe` (`id`, `nama`, `warna`) VALUES
(5, 'PICKET', '#0015fe'),
(6, 'Meeting', '#805555');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
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
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `email`, `alamat`, `website`, `no_telp`) VALUES
(1, 'BTN', 'btn@btn.com', 'btn', 'btn', '1');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
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
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `email`, `password`, `nama`, `status`, `no_telp`) VALUES
(1, 'admin@jabetto.com', '$2y$10$W5itITeUCMDU2CCCaF9Hr.trrf4oPgJTxJ2D3xnJm4Eqi.1kOchdO', 'Administrator', 'sa', '08123123123'),
(3, 'dhanar.j.kusuma@gmail.com', '$2y$10$xzlCl9C69ZNfkxuGJG6cYONuKqvutaNU6PcxHpvRq/fFbDyFSLlIG', 'admin123', 'admin', '123123123'),
(4, 'contohadmin@gmail.com', 'password_hash(admin123, PASSWORD_BCRYPT)', 'adminIT', 'se', '34124134'),
(7, 'admin_se@gmail.com', '$2y$10$ALxeR6ULes49QqEtJZbNNOYDnROpzQ5wRX9zVsjsDHtUbD8osgRbW', 'Admin System Engineer', 'se', '0912301238');

-- --------------------------------------------------------

--
-- Table structure for table `pic`
--

CREATE TABLE `pic` (
  `id` int(10) NOT NULL,
  `pelanggan_id` int(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `no_telp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pic`
--

INSERT INTO `pic` (`id`, `pelanggan_id`, `nama`, `email`, `no_telp`) VALUES
(1, 1, 'test', 'adfa@gmai.com', '0851613123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agenda_tipe_id` (`agenda_tipe_id`),
  ADD KEY `pelanggan_id` (`pelanggan_id`);

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `agenda_teknisi`
--
ALTER TABLE `agenda_teknisi`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `agenda_tipe`
--
ALTER TABLE `agenda_tipe`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `pic`
--
ALTER TABLE `pic`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `agenda`
--
ALTER TABLE `agenda`
  ADD CONSTRAINT `agenda_ibfk_1` FOREIGN KEY (`agenda_tipe_id`) REFERENCES `agenda_tipe` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `agenda_ibfk_2` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `agenda_teknisi`
--
ALTER TABLE `agenda_teknisi`
  ADD CONSTRAINT `agenda_teknisi_ibfk_1` FOREIGN KEY (`agenda_id`) REFERENCES `agenda` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `agenda_teknisi_ibfk_2` FOREIGN KEY (`teknisi_id`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pic`
--
ALTER TABLE `pic`
  ADD CONSTRAINT `pic_ibfk_1` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

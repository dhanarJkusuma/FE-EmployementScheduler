# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.2.8-MariaDB)
# Database: penjadwalan
# Generation Time: 2017-09-30 05:19:18 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table AGENDA
# ------------------------------------------------------------

DROP TABLE IF EXISTS `AGENDA`;

CREATE TABLE `AGENDA` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `agenda_tipe_id` int(10) NOT NULL,
  `deskripsi` text NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_akhir` date NOT NULL,
  `pelanggan_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `agenda_tipe_id` (`agenda_tipe_id`),
  KEY `pelanggan_id` (`pelanggan_id`),
  CONSTRAINT `agenda_ibfk_1` FOREIGN KEY (`agenda_tipe_id`) REFERENCES `agenda_tipe` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `agenda_ibfk_2` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `AGENDA` WRITE;
/*!40000 ALTER TABLE `AGENDA` DISABLE KEYS */;

INSERT INTO `AGENDA` (`id`, `agenda_tipe_id`, `deskripsi`, `tgl_mulai`, `tgl_akhir`, `pelanggan_id`)
VALUES
	(5,5,'','2017-09-06','2017-09-07',1),
	(8,6,'omom','2017-09-08','2017-09-09',1),
	(9,5,'jfasdfasdfasdf','2017-08-31','2017-09-01',1),
	(10,5,'asdfasdf','2017-09-29','2017-09-30',1),
	(12,6,'Meeting bersama2','2017-09-30','2017-10-01',1);

/*!40000 ALTER TABLE `AGENDA` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table agenda_teknisi
# ------------------------------------------------------------

DROP TABLE IF EXISTS `agenda_teknisi`;

CREATE TABLE `agenda_teknisi` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `agenda_id` int(10) NOT NULL,
  `teknisi_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `agenda_id` (`agenda_id`),
  KEY `teknisi_id` (`teknisi_id`),
  CONSTRAINT `agenda_teknisi_ibfk_1` FOREIGN KEY (`agenda_id`) REFERENCES `agenda` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `agenda_teknisi_ibfk_2` FOREIGN KEY (`teknisi_id`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table agenda_tipe
# ------------------------------------------------------------

DROP TABLE IF EXISTS `agenda_tipe`;

CREATE TABLE `agenda_tipe` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nama` varchar(30) NOT NULL,
  `warna` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `agenda_tipe` WRITE;
/*!40000 ALTER TABLE `agenda_tipe` DISABLE KEYS */;

INSERT INTO `agenda_tipe` (`id`, `nama`, `warna`)
VALUES
	(5,'PICKET','#0015fe'),
	(6,'Meeting','#805555');

/*!40000 ALTER TABLE `agenda_tipe` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pelanggan
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pelanggan`;

CREATE TABLE `pelanggan` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `website` varchar(45) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `pelanggan` WRITE;
/*!40000 ALTER TABLE `pelanggan` DISABLE KEYS */;

INSERT INTO `pelanggan` (`id`, `nama`, `email`, `alamat`, `website`, `no_telp`)
VALUES
	(1,'BTN','btn@btn.com','btn','btn','1');

/*!40000 ALTER TABLE `pelanggan` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pengguna
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pengguna`;

CREATE TABLE `pengguna` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `status` enum('sa','admin','se') NOT NULL DEFAULT 'se',
  `no_telp` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `pengguna` WRITE;
/*!40000 ALTER TABLE `pengguna` DISABLE KEYS */;

INSERT INTO `pengguna` (`id`, `email`, `password`, `nama`, `status`, `no_telp`)
VALUES
	(1,'admin@jabetto.com','$2y$10$W5itITeUCMDU2CCCaF9Hr.trrf4oPgJTxJ2D3xnJm4Eqi.1kOchdO','Administrator','sa','08123123123'),
	(3,'dhanar.j.kusuma@gmail.com','$2y$10$xzlCl9C69ZNfkxuGJG6cYONuKqvutaNU6PcxHpvRq/fFbDyFSLlIG','admin123','admin','123123123'),
	(4,'contohadmin@gmail.com','password_hash(admin123, PASSWORD_BCRYPT)','adminIT','se','34124134'),
	(7,'admin_se@gmail.com','$2y$10$ALxeR6ULes49QqEtJZbNNOYDnROpzQ5wRX9zVsjsDHtUbD8osgRbW','Admin System Engineer','se','0912301238');

/*!40000 ALTER TABLE `pengguna` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pic
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pic`;

CREATE TABLE `pic` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `pelanggan_id` int(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pic_ibfk_1` (`pelanggan_id`),
  CONSTRAINT `pic_ibfk_1` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `pic` WRITE;
/*!40000 ALTER TABLE `pic` DISABLE KEYS */;

INSERT INTO `pic` (`id`, `pelanggan_id`, `nama`, `email`, `no_telp`)
VALUES
	(1,1,'test','adfa@gmai.com','0851613123');

/*!40000 ALTER TABLE `pic` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

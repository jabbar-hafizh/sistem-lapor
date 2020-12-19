# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.1.38-MariaDB)
# Database: silapor_db
# Generation Time: 2020-12-19 15:55:54 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table bagian
# ------------------------------------------------------------

DROP TABLE IF EXISTS `bagian`;

CREATE TABLE `bagian` (
  `kd_bagian` char(36) NOT NULL DEFAULT '',
  `nm_bagian` varchar(255) NOT NULL,
  PRIMARY KEY (`kd_bagian`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `bagian` WRITE;
/*!40000 ALTER TABLE `bagian` DISABLE KEYS */;

INSERT INTO `bagian` (`kd_bagian`, `nm_bagian`)
VALUES
	('1','Supervisor Customer Service'),
	('2','Manager');

/*!40000 ALTER TABLE `bagian` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table detil_keluhan
# ------------------------------------------------------------

DROP TABLE IF EXISTS `detil_keluhan`;

CREATE TABLE `detil_keluhan` (
  `id_keluhan_fk` char(36) NOT NULL DEFAULT '',
  `id_jenis_keluhan_fk` char(36) NOT NULL DEFAULT '',
  `penjelasan_keluhan` varchar(255) NOT NULL,
  `bukti_foto_keluhan` varchar(255) NOT NULL,
  `status_keluhan` varchar(255) NOT NULL,
  `penyelesaian_keluhan` varchar(255) DEFAULT NULL,
  `tingkat_keluhan` varchar(255) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `detil_keluhan` WRITE;
/*!40000 ALTER TABLE `detil_keluhan` DISABLE KEYS */;

INSERT INTO `detil_keluhan` (`id_keluhan_fk`, `id_jenis_keluhan_fk`, `penjelasan_keluhan`, `bukti_foto_keluhan`, `status_keluhan`, `penyelesaian_keluhan`, `tingkat_keluhan`)
VALUES
	('1b37d28a-1bad-466d-8aba-a7a3177ec318','0eec142a-9679-4950-a227-84870bd5b94f','Mesin etoll rusak ga terbaca','0.jpeg','Selesai','Selesai','berat'),
	('2d78bfd8-1553-40ef-9532-6ca3b6246868','0eec142a-9679-4950-a227-84870bd5b94f','Ga bisa dipake','0.jpeg','Selesai','Selesai','ringan');

/*!40000 ALTER TABLE `detil_keluhan` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table jenis_keluhan
# ------------------------------------------------------------

DROP TABLE IF EXISTS `jenis_keluhan`;

CREATE TABLE `jenis_keluhan` (
  `id_jenis_keluhan` char(36) NOT NULL DEFAULT '',
  `nm_keluhan` varchar(255) NOT NULL,
  PRIMARY KEY (`id_jenis_keluhan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `jenis_keluhan` WRITE;
/*!40000 ALTER TABLE `jenis_keluhan` DISABLE KEYS */;

INSERT INTO `jenis_keluhan` (`id_jenis_keluhan`, `nm_keluhan`)
VALUES
	('0eec142a-9679-4950-a227-84870bd5b94f','Mesin e-Toll rusak');

/*!40000 ALTER TABLE `jenis_keluhan` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table karyawan
# ------------------------------------------------------------

DROP TABLE IF EXISTS `karyawan`;

CREATE TABLE `karyawan` (
  `id_karyawan` char(36) NOT NULL DEFAULT '',
  `nm_karyawan` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_telp` varchar(255) NOT NULL,
  `kd_bagian_fk` char(36) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL,
  `shift` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_karyawan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `karyawan` WRITE;
/*!40000 ALTER TABLE `karyawan` DISABLE KEYS */;

INSERT INTO `karyawan` (`id_karyawan`, `nm_karyawan`, `alamat`, `no_telp`, `kd_bagian_fk`, `password`, `shift`)
VALUES
	('1','Mr. X','Indonesia','082112637227','1','$2y$10$g.j6Q4VS7yuzGjnBnH64F.knslUzd.fVnnRtk6LSG6fSwmRGJ/gra',1),
	('GUYX0496','Mr. Z','Planet namek','081399999999','2','$2y$10$/v7zuuYT2VUB8X3v47FiYeZXKx3TC0Lq7gzgbqDAjAfm24O1nAJSC',2);

/*!40000 ALTER TABLE `karyawan` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table keluhan
# ------------------------------------------------------------

DROP TABLE IF EXISTS `keluhan`;

CREATE TABLE `keluhan` (
  `id_keluhan` char(36) NOT NULL DEFAULT '',
  `waktu_keluhan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nm_pengeluh` varchar(255) NOT NULL,
  `no_telp` varchar(255) NOT NULL,
  `id_karyawan_fk` char(36) DEFAULT NULL,
  PRIMARY KEY (`id_keluhan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `keluhan` WRITE;
/*!40000 ALTER TABLE `keluhan` DISABLE KEYS */;

INSERT INTO `keluhan` (`id_keluhan`, `waktu_keluhan`, `nm_pengeluh`, `no_telp`, `id_karyawan_fk`)
VALUES
	('1b37d28a-1bad-466d-8aba-a7a3177ec318','2020-12-19 16:55:54','Pandhu','081399999998','GUYX0496'),
	('2d78bfd8-1553-40ef-9532-6ca3b6246868','2020-12-19 22:27:59','Pandhu','081399999998','1');

/*!40000 ALTER TABLE `keluhan` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

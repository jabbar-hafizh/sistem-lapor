-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2020 at 10:05 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `silapor_db`
--
CREATE DATABASE IF NOT EXISTS `silapor_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `silapor_db`;

-- --------------------------------------------------------

--
-- Table structure for table `bagian`
--

CREATE TABLE `bagian` (
  `kd_bagian` int(11) NOT NULL,
  `nm_bagian` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bagian`
--

INSERT INTO `bagian` (`kd_bagian`, `nm_bagian`) VALUES
(1, 'Customer Service');

-- --------------------------------------------------------

--
-- Table structure for table `detil_keluhan`
--

CREATE TABLE `detil_keluhan` (
  `id_keluhan_fk` int(11) NOT NULL,
  `id_jenis_keluhan_fk` int(11) NOT NULL,
  `penjelasan_keluhan` varchar(255) NOT NULL,
  `bukti_foto_keluhan` varchar(255) NOT NULL,
  `status_keluhan` varchar(255) NOT NULL,
  `penyelesaian_keluhan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detil_keluhan`
--

INSERT INTO `detil_keluhan` (`id_keluhan_fk`, `id_jenis_keluhan_fk`, `penjelasan_keluhan`, `bukti_foto_keluhan`, `status_keluhan`, `penyelesaian_keluhan`) VALUES
(1, 2, 'Banjir di lautan', '1.png', 'Baru', NULL),
(2, 1, 'Jalanan rusak di jalanan', '2.png', 'Baru', NULL),
(3, 2, 'Ya Banjir', '3.png', 'Diproses', NULL),
(4, 1, 'jalanan rusak di atlantis', '4.png', 'Ditangani', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_keluhan`
--

CREATE TABLE `jenis_keluhan` (
  `id_jenis_keluhan` int(11) NOT NULL,
  `nm_keluhan` varchar(255) NOT NULL,
  `kd_bagian_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_keluhan`
--

INSERT INTO `jenis_keluhan` (`id_jenis_keluhan`, `nm_keluhan`, `kd_bagian_fk`) VALUES
(1, 'Jalanan Rusak', 1),
(2, 'Banjir', 2),
(3, 'Macet', 3);

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `nm_karyawan` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_telp` varchar(255) NOT NULL,
  `kd_bagian_fk` int(11) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nm_karyawan`, `alamat`, `no_telp`, `kd_bagian_fk`, `password`) VALUES
(1, 'Bang Jali', 'Parung', '082112637227', 1, 'passwordjali');

-- --------------------------------------------------------

--
-- Table structure for table `keluhan`
--

CREATE TABLE `keluhan` (
  `id_keluhan` int(11) NOT NULL,
  `waktu_keluhan` timestamp NOT NULL DEFAULT current_timestamp(),
  `nm_pengeluh` varchar(255) NOT NULL,
  `no_telp` varchar(255) NOT NULL,
  `id_karyawan_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keluhan`
--

INSERT INTO `keluhan` (`id_keluhan`, `waktu_keluhan`, `nm_pengeluh`, `no_telp`, `id_karyawan_fk`) VALUES
(1, '2020-11-26 09:08:14', 'Shaun Murphy', '082112637227', NULL),
(2, '2020-11-26 09:11:20', 'Joe', '082112637222', NULL),
(3, '2020-11-26 09:15:33', 'Sandi', '082112637221', 1),
(4, '2020-11-26 13:29:49', 'Murphy', '082112637223', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bagian`
--
ALTER TABLE `bagian`
  ADD PRIMARY KEY (`kd_bagian`);

--
-- Indexes for table `jenis_keluhan`
--
ALTER TABLE `jenis_keluhan`
  ADD PRIMARY KEY (`id_jenis_keluhan`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `keluhan`
--
ALTER TABLE `keluhan`
  ADD PRIMARY KEY (`id_keluhan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bagian`
--
ALTER TABLE `bagian`
  MODIFY `kd_bagian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jenis_keluhan`
--
ALTER TABLE `jenis_keluhan`
  MODIFY `id_jenis_keluhan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `keluhan`
--
ALTER TABLE `keluhan`
  MODIFY `id_keluhan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

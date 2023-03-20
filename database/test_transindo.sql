-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 20, 2023 at 10:00 AM
-- Server version: 5.7.33
-- PHP Version: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_transindo`
--

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `pendaftaran_id` varchar(50) NOT NULL,
  `pendaftaran_nama` varchar(50) DEFAULT NULL,
  `pendaftaran_no_telp` varchar(15) DEFAULT NULL,
  `pendaftaran_jenis_tiket` varchar(15) DEFAULT NULL,
  `pendaftaran_jumlah_bayar` int(15) DEFAULT NULL,
  `kode_ID` varchar(100) DEFAULT NULL,
  `status_checkin` enum('Belum','Sudah') NOT NULL DEFAULT 'Belum'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pendaftaran`
--

INSERT INTO `pendaftaran` (`pendaftaran_id`, `pendaftaran_nama`, `pendaftaran_no_telp`, `pendaftaran_jenis_tiket`, `pendaftaran_jumlah_bayar`, `kode_ID`, `status_checkin`) VALUES
('PEN_20032023_1353091679295189864', 'Amina', '087867854676', 'VVIP', 2400000, '1679295190', 'Sudah'),
('PEN_20032023_1402211679295741036', 'sina', '087867656797', 'VIP A', 1050000, 'sina1679295741', 'Sudah'),
('PEN_20032023_1408571679296137128', 'agu', '0857876785', 'VIP A', 350000, 'VIP A1679296137', 'Belum');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_nama` varchar(50) NOT NULL,
  `user_level` varchar(20) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_nama`, `user_level`, `username`, `password`) VALUES
(501, 'Pandu Gumilar Somantri', 'Admin', 'pandu', 'pandu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`pendaftaran_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=502;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

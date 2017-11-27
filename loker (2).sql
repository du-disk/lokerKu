-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2017 at 12:49 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `loker`
--

-- --------------------------------------------------------

--
-- Table structure for table `help`
--

CREATE TABLE IF NOT EXISTS `help` (
`id` int(11) NOT NULL,
  `judul` varchar(40) NOT NULL,
  `isi` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `help`
--

INSERT INTO `help` (`id`, `judul`, `isi`) VALUES
(1, 'Cara Menggunakan Aplikasi LokerKu.', 'Cara Menggunakan Aplikasi LokerKu.');

-- --------------------------------------------------------

--
-- Table structure for table `isi_loker`
--

CREATE TABLE IF NOT EXISTS `isi_loker` (
`kd_isi` int(11) NOT NULL,
  `no_loker` int(11) NOT NULL,
  `tanggal_masuk` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tanggal_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `file` varchar(50) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `isi_loker`
--

INSERT INTO `isi_loker` (`kd_isi`, `no_loker`, `tanggal_masuk`, `tanggal_update`, `file`, `description`) VALUES
(5, 1, '2017-09-16 05:03:23', '2017-09-16 05:06:16', '', 'asasa'),
(6, 2, '2017-09-16 05:13:52', '2017-09-16 05:13:52', 'Sketch.png', 'we\r\n\r\n'),
(7, 4, '2017-09-16 10:41:52', '2017-09-16 10:45:51', 'tutorial_webgis.pdf', 'Tutorial Web Gis');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE IF NOT EXISTS `kelas` (
`kd_kelas` int(11) NOT NULL,
  `kelas` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`kd_kelas`, `kelas`) VALUES
(101, 'X - RPL3'),
(102, 'XI - RPL3'),
(103, 'XII  - RPL3');

-- --------------------------------------------------------

--
-- Table structure for table `lokers`
--

CREATE TABLE IF NOT EXISTS `lokers` (
  `no_loker` int(11) NOT NULL,
  `pemilik` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `kd_kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lokers`
--

INSERT INTO `lokers` (`no_loker`, `pemilik`, `password`, `kd_kelas`) VALUES
(1, 'Dudi Iskandar', '841c68ffb622a373805002eac37502b1', 101),
(2, 'Indra Maulana', 'e24f6e3ce19ee0728ff1c443e4ff488d', 102),
(3, 'Rizqi Fadhillah', '71fd94a0d995244544c153158bbbefc5', 102),
(4, 'Dudi Iskandar', '7d1bc8e89e561b5337afe0c4feca9b31', 103);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `kd_kelas` int(11) NOT NULL,
  `akses` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `kd_kelas`, `akses`) VALUES
(1, 'dudii12', '7d1bc8e89e561b5337afe0c4feca9b31', 0, 'admin'),
(2, 'xirpl3', '381b9cff8042d607fb536092b702947f', 102, 'users'),
(3, 'xiirpl3', 'aca17a6d8922879aa5bbade59c0fa3c9', 103, 'users');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `help`
--
ALTER TABLE `help`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `isi_loker`
--
ALTER TABLE `isi_loker`
 ADD PRIMARY KEY (`kd_isi`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
 ADD PRIMARY KEY (`kd_kelas`);

--
-- Indexes for table `lokers`
--
ALTER TABLE `lokers`
 ADD PRIMARY KEY (`no_loker`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `help`
--
ALTER TABLE `help`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `isi_loker`
--
ALTER TABLE `isi_loker`
MODIFY `kd_isi` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
MODIFY `kd_kelas` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=108;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

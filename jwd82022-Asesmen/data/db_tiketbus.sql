-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2022 at 04:41 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_tiketbus`
--

-- --------------------------------------------------------

--
-- Table structure for table `tiket_penumpang`
--

CREATE TABLE `tiket_penumpang` (
  `id_penumpang` int(64) NOT NULL,
  `kode_book` varchar(20) NOT NULL,
  `no_ktp` varchar(255) NOT NULL,
  `nama_pemesan` varchar(255) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `jenis_kelas` varchar(20) NOT NULL,
  `jml_tidak_lansia` int(64) NOT NULL,
  `jml_lansia` int(64) NOT NULL,
  `total_bayar` int(64) NOT NULL,
  `tgl_brkt` date NOT NULL,
  `tgl_transaksi` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tiket_penumpang`
--

INSERT INTO `tiket_penumpang` (`id_penumpang`, `kode_book`, `no_ktp`, `nama_pemesan`, `no_hp`, `jenis_kelas`, `jml_tidak_lansia`, `jml_lansia`, `total_bayar`, `tgl_brkt`, `tgl_transaksi`) VALUES
(1, '0VCJJFL', '123123124', 'Rasyid Ramadhani', '8975643563', 'Bisnis', 1, 1, 380000, '2022-10-01', '2022-09-28 21:36:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tiket_penumpang`
--
ALTER TABLE `tiket_penumpang`
  ADD PRIMARY KEY (`id_penumpang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tiket_penumpang`
--
ALTER TABLE `tiket_penumpang`
  MODIFY `id_penumpang` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

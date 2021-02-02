-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2021 at 03:31 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_bms`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_staf`
--

CREATE TABLE `tb_staf` (
  `id_staf` int(11) NOT NULL,
  `nopegawai` char(18) DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `provinsi` char(2) NOT NULL,
  `kota` char(4) NOT NULL,
  `kecamatan` char(7) NOT NULL,
  `tlp` varchar(12) NOT NULL,
  `id_tipeuser` int(11) NOT NULL DEFAULT 1,
  `status` enum('aktif','tidak aktif') NOT NULL,
  `tgl_update` datetime NOT NULL,
  `id_user` int(11) NOT NULL,
  `password` char(15) NOT NULL DEFAULT 'staf123',
  `jabatan` varchar(100) DEFAULT NULL,
  `rfid` varchar(20) DEFAULT NULL,
  `jk` varchar(1) DEFAULT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_staf`
--

INSERT INTO `tb_staf` (`id_staf`, `nopegawai`, `nama`, `alamat`, `provinsi`, `kota`, `kecamatan`, `tlp`, `id_tipeuser`, `status`, `tgl_update`, `id_user`, `password`, `jabatan`, `rfid`, `jk`, `tempat_lahir`, `tgl_lahir`) VALUES
(1, '001', 'RIZKY FBRIANTO', 'Gempolk Kurung', '35', '3525', '3525040', '081216590250', 1, 'aktif', '2021-01-15 09:50:04', 1, '', '', '', '', NULL, NULL),
(2, ' 111', 'SRI SUWARNI PRAMUKTI, S.Pd', 'watugolong krian sidoarjo', '17', '1704', '1704031', '08123205171', 1, 'aktif', '2021-02-01 11:21:33', 1, 'staf123', 'asd', '12345', 'P', 'SIDOARJO', '1970-02-02'),
(3, NULL, 'DWI ARDIYANTI, S.Pd', 'Patoman Rt 12 Rw 04 Kedung Anyar Wringinanom Gresik', '', '', '', '', 1, 'aktif', '2021-02-01 10:52:47', 1, 'staf123', NULL, NULL, 'P', 'Gresik', '1980-06-23'),
(4, NULL, 'DHANI TRIANA ANDRIYATI, S.Pd', 'Suwaluh, Balongbendo Sidoarjo', '', '', '', '', 1, 'aktif', '2021-02-01 10:52:47', 1, 'staf123', NULL, NULL, 'P', 'SIDOARJO', '1982-04-16'),
(5, NULL, 'Drs. EDY ERYANTO', 'Kenongo Rt.6 Rw.2 Tulangan Sidoarjo', '', '', '', '', 1, 'aktif', '2021-02-01 10:52:47', 1, 'staf123', NULL, NULL, 'L', 'SIDOARJO', '1962-09-06'),
(6, NULL, 'Drs. EDY UTOMO, S.Pd', 'wringinanom RT 1 RW1 Wringinanom', '', '', '', '', 1, 'aktif', '2021-02-01 10:52:47', 1, 'staf123', NULL, NULL, 'L', 'GRESIK', '1964-09-07'),
(7, NULL, 'ETIKA REDHA RESTIANA. S. Pd', 'Sumberwaru Rt.2 Rw.2 Wringinanom Gresik', '', '', '', '', 1, 'aktif', '2021-02-01 10:52:47', 1, 'staf123', NULL, NULL, 'P', 'GRESIK', '1982-05-29'),
(8, NULL, 'FIRST NANDA PUTRA WAHYU WARDHI, S.Pd', 'njetis mojokerto', '', '', '', '', 1, 'aktif', '2021-02-01 10:52:47', 1, 'staf123', NULL, NULL, 'L', 'BOYOLALI', '1986-03-19'),
(9, NULL, 'HARI PATMONO, S.Pd., M.Pd', 'Jaranan Rt.03 Panggung Harjo sewon Bantul', '', '', '', '', 1, 'aktif', '2021-02-01 10:52:47', 1, 'staf123', NULL, NULL, 'L', 'BANTUL', '1979-08-27'),
(10, NULL, 'Drs. IMAM HADI, MM', 'Sumberwaru Rt.2 Rw.2 Wringinanom Gresik', '', '', '', '', 1, 'aktif', '2021-02-01 10:52:47', 1, 'staf123', NULL, NULL, 'L', 'GRESIK', '1963-07-14'),
(11, NULL, 'Dra. INDRAWATI', 'Kapling Madubronto gang 1 rt 69 rw 12, Sidorejo Krian Sidoarjo', '', '', '', '', 1, 'aktif', '2021-02-01 10:52:47', 1, 'staf123', NULL, NULL, 'P', 'MADIUN', '1964-12-06'),
(12, NULL, 'ISMAN, S.Pd., MM', 'kedamean gresik', '', '', '', '', 1, 'aktif', '2021-02-01 10:52:47', 1, 'staf123', NULL, NULL, 'L', 'GRESIK', '1970-01-03'),
(13, NULL, 'Drs. JUWITO', 'Bogempinggir Rt.5 Rw.2 Balongbendo Sidoarjo', '', '', '', '', 1, 'aktif', '2021-02-01 10:52:47', 1, 'staf123', NULL, NULL, 'L', 'TULUNGAGUNG', '1966-06-19'),
(14, NULL, 'LILIS YULIATI, S.pd', 'sumberwaru wringinanom', '', '', '', '', 1, 'aktif', '2021-02-01 10:52:47', 1, 'staf123', NULL, NULL, 'P', ' GRESIK', '1975-08-17'),
(15, NULL, 'LUTFI TUTI INGGARANI, S.Pd', 'Seduri Rt.7 Rw. II Balongbendo Sidoarjo', '', '', '', '', 1, 'aktif', '2021-02-01 10:52:47', 1, 'staf123', NULL, NULL, 'P', 'SIDOARJO', '1983-10-05'),
(16, NULL, 'MISTIYAH, S. Pd', 'krian sidoarjo', '', '', '', '', 1, 'aktif', '2021-02-01 10:52:47', 1, 'staf123', NULL, NULL, 'P', 'JUN WANGI KRIAN', '1968-09-19'),
(17, NULL, 'Drs. MOKH EDY SUSANTO', 'kedamean gresik', '', '', '', '', 1, 'aktif', '2021-02-01 10:52:47', 1, 'staf123', NULL, NULL, 'L', 'MOJOKERTO', '1966-12-15'),
(18, NULL, 'Drs. MUH. AMIRIL M', 'Krembangan Rt 14 / 03 Taman Sidoarjo', '', '', '', '', 1, 'aktif', '2021-02-01 10:52:47', 1, 'staf123', NULL, NULL, 'L', 'SIDOARJO', '1968-04-10'),
(19, NULL, 'MUKHAMAD SHOLEHCHUDIN, S.Sos', 'Sumberwaru Rt.2 Rw.3 Wringinanom Gresik', '', '', '', '', 1, 'aktif', '2021-02-01 10:52:47', 1, 'staf123', NULL, NULL, 'L', ' GRESIK', '1977-05-31'),
(20, NULL, 'MUNIR, S.Pd', 'Kesemben kulon Rt.2 Rw.3 Wringinanom Gresik', '', '', '', '', 1, 'aktif', '2021-02-01 10:52:47', 1, 'staf123', NULL, NULL, 'L', 'SURABAYA', '1977-09-10'),
(21, NULL, 'SRI MULYANI, S.Pd., M.Pd', 'Ketimang Rt.4 Rw.1 Wonoayu Sidoarjo', '', '', '', '', 1, 'aktif', '2021-02-01 10:52:47', 1, 'staf123', NULL, NULL, 'P', 'SIDOARJO', '1969-01-12'),
(22, NULL, 'SRI WULANDARI, S.Pd', 'Wonogiri Wonoplintahan Rt.3 Rw.3 Prambon Sidoarjo', '', '', '', '', 1, 'aktif', '2021-02-01 10:52:47', 1, 'staf123', NULL, NULL, 'P', 'SIDOARJO', '1975-09-18'),
(23, NULL, 'SUHANTO, S.Pd., MM', 'Legundi Rt.5/2 Krikilan Driyorejo Gresik', '', '', '', '', 1, 'aktif', '2021-02-01 10:52:47', 1, 'staf123', NULL, NULL, 'L', 'GRESIK', '1964-09-08'),
(24, NULL, 'Drs. SUKADI, M.Si', 'Dsn Balong Jrambah rt 15 rw 06 Kedamean Gresik', '', '', '', '', 1, 'aktif', '2021-02-01 10:52:47', 1, 'staf123', NULL, NULL, 'L', 'GRESIK', '1963-10-12'),
(25, NULL, 'SUPII, S.Pd', 'kedamean gresik', '', '', '', '', 1, 'aktif', '2021-02-01 10:52:47', 1, 'staf123', NULL, NULL, 'L', 'GRESIK', '1969-03-08'),
(26, NULL, 'SUPIN, M.Pd', 'Perum Sumput Asri no. 29 Driyorejo Gresik', '', '', '', '', 1, 'aktif', '2021-02-01 10:52:47', 1, 'staf123', NULL, NULL, 'P', 'MAGETAN', '1967-01-17'),
(27, NULL, 'SUPRIYATIN, S.Pd', 'Kesemben kulon Rt.2 Rw.3 Wringinanom Gresik', '', '', '', '', 1, 'aktif', '2021-02-01 10:52:47', 1, 'staf123', NULL, NULL, 'P', 'GRESIK', '1986-04-20'),
(28, '123123', 'sad', 'asd', '51', '5102', '5102011', '08121760289', 1, 'aktif', '2021-02-01 11:10:54', 1, '', NULL, '', 'L', 'asd', '2021-01-31'),
(29, ' 123123', 'a', ' ', '', '', '', '08121760289', 1, 'aktif', '2021-02-02 09:25:11', 1, 'staf123', ' ', ' ', 'P', ' as', '2021-02-07'),
(30, NULL, 'b', NULL, '', '', '', '', 1, 'aktif', '2021-02-02 09:24:46', 1, 'staf123', NULL, NULL, NULL, '', '0000-00-00'),
(31, NULL, 'c', NULL, '', '', '', '', 1, 'aktif', '2021-02-02 09:24:46', 1, 'staf123', NULL, NULL, NULL, '', '0000-00-00'),
(32, NULL, 'd', NULL, '', '', '', '', 1, 'aktif', '2021-02-02 09:24:46', 1, 'staf123', NULL, NULL, NULL, '', '0000-00-00'),
(33, NULL, 'e', NULL, '', '', '', '', 1, 'aktif', '2021-02-02 09:24:46', 1, 'staf123', NULL, NULL, NULL, '', '0000-00-00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_staf`
--
ALTER TABLE `tb_staf`
  ADD PRIMARY KEY (`id_staf`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_staf`
--
ALTER TABLE `tb_staf`
  MODIFY `id_staf` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

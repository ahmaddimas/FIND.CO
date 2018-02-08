-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2018 at 07:08 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pw`
--
CREATE DATABASE IF NOT EXISTS `db_pw` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_pw`;

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(1) NOT NULL,
  `last_loggin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `username`, `password`, `role`, `last_loggin`) VALUES
(1, 'hubin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_guru_pembimbing`
--

CREATE TABLE `tb_guru_pembimbing` (
  `id_guru` int(11) NOT NULL,
  `oauth_uid` varchar(255) NOT NULL,
  `nama_guru` varchar(50) NOT NULL,
  `email_guru` varchar(100) NOT NULL,
  `telp_guru` varchar(12) NOT NULL,
  `jk_guru` varchar(6) NOT NULL,
  `picture_url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_guru_pembimbing`
--

INSERT INTO `tb_guru_pembimbing` (`id_guru`, `oauth_uid`, `nama_guru`, `email_guru`, `telp_guru`, `jk_guru`, `picture_url`) VALUES
(3, '113634289449530108260', 'Muhammad Haikal Atthoriq', 'muhammad_atthoriq_24rpl@student.smktelkom-mlg.sch.id', '', '', 'https://lh6.googleusercontent.com/-BKvHsJ3Tq7E/AAAAAAAAAAI/AAAAAAAAAVQ/ZfvXJibk9Ic/photo.jpg'),
(4, '114624470082022841565', 'NABILA FIRSTANANDA SAPUTRI', 'nabila_saputri_24rpl@student.smktelkom-mlg.sch.id', '', 'female', 'https://lh6.googleusercontent.com/-wQJcZCe_tkI/AAAAAAAAAAI/AAAAAAAAAEA/-Gje0URzoR4/photo.jpg'),
(5, '113737970762948243576', 'Ahmad Dimas Abid Muttaqi', 'ahmad_muttaqi_24rpl@student.smktelkom-mlg.sch.id', '', 'male', 'https://lh3.googleusercontent.com/-HFMtJNXTtOE/AAAAAAAAAAI/AAAAAAAAAFc/HAOHOlJNBFU/photo.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_guru_perusahaan`
--

CREATE TABLE `tb_guru_perusahaan` (
  `id_guru_perusahaan` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `id_perusahaan` int(11) NOT NULL,
  `tahun` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_guru_perusahaan`
--

INSERT INTO `tb_guru_perusahaan` (`id_guru_perusahaan`, `id_guru`, `id_perusahaan`, `tahun`) VALUES
(20, 4, 7, 2018);

-- --------------------------------------------------------

--
-- Table structure for table `tb_monitoring`
--

CREATE TABLE `tb_monitoring` (
  `id_monitoring` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `id_perusahaan` int(11) NOT NULL,
  `tgl_monitoring` date NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_monitoring`
--

INSERT INTO `tb_monitoring` (`id_monitoring`, `id_guru`, `id_perusahaan`, `tgl_monitoring`, `keterangan`) VALUES
(1, 4, 7, '2018-02-08', 'asdsad');

-- --------------------------------------------------------

--
-- Table structure for table `tb_perusahaan`
--

CREATE TABLE `tb_perusahaan` (
  `id_perusahaan` int(11) NOT NULL,
  `nama_perusahaan` varchar(100) NOT NULL,
  `telp_perusahaan` varchar(12) NOT NULL,
  `alamat` text NOT NULL,
  `kota` varchar(50) NOT NULL,
  `provinsi` varchar(50) NOT NULL,
  `fax` varchar(20) NOT NULL,
  `cp` varchar(50) NOT NULL,
  `picture_url` text NOT NULL,
  `priority` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_perusahaan`
--

INSERT INTO `tb_perusahaan` (`id_perusahaan`, `nama_perusahaan`, `telp_perusahaan`, `alamat`, `kota`, `provinsi`, `fax`, `cp`, `picture_url`, `priority`) VALUES
(1, 'Google Indonesia', '086234123555', 'Sentral Senayan II Lantai 28, Jl. Asia Afrika No. 8, Gelora, Tanah Abang, RT.1/RW.3, RT.1/RW.3, Gelora, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10270', 'Jakarta', 'DKI Jakarta', '1213123', 'Mrs. Nabila', 'assets/images/google.jpg', 0),
(3, 'SMK Telkom Malang', '081232313123', 'Jl. Danau Ranau Sawojajar Malang', 'Malang', 'Jawa Timur', '312312314', 'Mrs. Joice', 'assets/images/telkom.jpg', 0),
(4, 'PT. Telekomunikasi Indonesia, Tbk', '0', 'Jl. Gajah Mada No. 182-184 Lt.3 Jember 68131', 'KAB. Jember', 'Jawa Timur', '-', 'Mr. Zul', 'assets/images/TI.jpg', 0),
(5, 'PT. Telkom Telkomsel Jakarta', '(021) 385081', 'Jl. Jenderal Gatot Subroto No. 42 City Plasa Lt. II Wisma Mulia-Jakarta', 'Jakarta', 'DKI Jakarta', '-', 'Mrs. Saputri', 'assets/images/TELKOMSEL.jpg', 0),
(6, 'PT. INDOSAT MEGA MEDIA JAKARTA', '0', 'JL. KEBAGUSAN RAYA NO. 36 RAGUNAN-JAKARTA', 'Jakarta', 'DKI Jakarta', '-', '(021) 78546900', 'assets/images/INDOSAT.jpg', 0),
(7, 'PT. Newmont Nusa Tenggara', '0', 'Jl Sriwijaya 258 Indonesia 80235', 'Makassar', 'Sulawesi Selatan', '-', '(0372)635318', 'assets/images/NEWMONT.jpg', 0),
(8, 'PT. Telkom Witel Solo', '081362080312', 'Jl. Mayor Kusmanto No. 1', 'Solo', 'Jawa Tengah', '-', '-', 'assets/images/WITEL_SOLO.jpg', 0),
(9, 'PT. FINNET INDONESIA', '0218299999', 'MENARA BIDAKARA 1 LT. 12 JL. JENDERAL GATOT SUBROTO KAV 71-73 JAKARTA 13350', 'Jakarta', 'DKI Jakarta', '-', '(021) 8299999', 'assets/images/FINNET.jpg', 0),
(10, 'Telkom Witel Jatim Barat', '0', 'Jl. Panjaitan 19 Madiun', 'Madiun', 'Jawa Timur', '-', '0351-494001/494203', 'assets/images/WITEL_JATIM_BARAT.jpg', 0),
(11, 'VISIONET', '08999999999', 'MALANG', 'MALANG', 'JAWA TIMUR', '0', 'DIMAS', 'assets/images/1.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_perusahaan_siswa`
--

CREATE TABLE `tb_perusahaan_siswa` (
  `id_perusahaan_siswa` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_perusahaan` int(11) NOT NULL,
  `indeks` int(1) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_perusahaan_siswa`
--

INSERT INTO `tb_perusahaan_siswa` (`id_perusahaan_siswa`, `id_siswa`, `id_perusahaan`, `indeks`, `status`) VALUES
(4, 3, 4, 1, 'diterima'),
(5, 3, 3, 2, '-'),
(8, 5, 1, 1, 'menunggu'),
(9, 5, 5, 2, 'menunggu'),
(12, 7, 9, 1, '-'),
(13, 7, 7, 2, 'diterima'),
(14, 8, 7, 1, 'diterima'),
(15, 8, 1, 2, '-');

-- --------------------------------------------------------

--
-- Table structure for table `tb_rekap_perusahaan`
--

CREATE TABLE `tb_rekap_perusahaan` (
  `id_rekap` int(11) NOT NULL,
  `id_perusahaan` int(11) NOT NULL,
  `kuota` int(11) NOT NULL,
  `diterima` int(11) NOT NULL,
  `tahun_rekap` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_rekap_perusahaan`
--

INSERT INTO `tb_rekap_perusahaan` (`id_rekap`, `id_perusahaan`, `kuota`, `diterima`, `tahun_rekap`) VALUES
(1, 1, 2, 0, 2017),
(3, 3, 5, 0, 2016),
(9, 3, 4, 0, 2017),
(10, 4, 6, 1, 2017),
(11, 5, 4, 0, 2017),
(12, 6, 3, 0, 2017),
(13, 7, 0, 0, 2017),
(14, 8, 3, 0, 2017),
(15, 9, 8, 0, 2017),
(16, 10, 9, 0, 2017),
(22, 11, 10, 0, 2018);

-- --------------------------------------------------------

--
-- Table structure for table `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `id_siswa` int(11) NOT NULL,
  `oauth_uid` varchar(255) NOT NULL,
  `nis` varchar(20) NOT NULL,
  `nama_siswa` varchar(50) NOT NULL,
  `email_siswa` varchar(100) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `telp_siswa` varchar(12) NOT NULL,
  `jk_siswa` varchar(6) NOT NULL,
  `angkatan` int(5) NOT NULL,
  `jurusan` varchar(3) NOT NULL,
  `picture_url` text NOT NULL,
  `last_logged` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_siswa`
--

INSERT INTO `tb_siswa` (`id_siswa`, `oauth_uid`, `nis`, `nama_siswa`, `email_siswa`, `kelas`, `telp_siswa`, `jk_siswa`, `angkatan`, `jurusan`, `picture_url`, `last_logged`) VALUES
(3, '112274529044745553265', '', 'JOICE JESSICA', 'joice_jessica_24rpl@student.smktelkom-mlg.sch.id', '', '', 'female', 24, 'RPL', 'https://lh6.googleusercontent.com/-OcmbJ3_QhnU/AAAAAAAAAAI/AAAAAAAAADc/PMJ22aPOPH8/photo.jpg', '0000-00-00 00:00:00'),
(4, '103364408396867969257', '', 'Mohammad Huzaer Rekso Jiwo', 'mohammad_jiwo_24rpl@student.smktelkom-mlg.sch.id', '', '', 'male', 24, 'RPL', 'https://lh6.googleusercontent.com/-FkGQFBem1uM/AAAAAAAAAAI/AAAAAAAAADw/GGaWhGPFBYA/photo.jpg', '0000-00-00 00:00:00'),
(5, '113634289449530108260', '4778/4766.070', 'Muhammad Haikal Atthoriq', 'muhammad_atthoriq_24rpl@student.smktelkom-mlg.sch.id', 'RPL 3', '08123456789', '', 24, 'RPL', 'https://lh6.googleusercontent.com/-BKvHsJ3Tq7E/AAAAAAAAAAI/AAAAAAAAAVQ/ZfvXJibk9Ic/photo.jpg', '0000-00-00 00:00:00'),
(7, '103124597533881341919', '4778/4766.071', 'Zulfikri Rosyid', 'zulfikri_rosyid_24rpl@student.smktelkom-mlg.sch.id', 'RPL 3', '23800928', 'male', 24, 'RPL', 'https://lh3.googleusercontent.com/-ccOjz6aYTeU/AAAAAAAAAAI/AAAAAAAAACU/-WNr850Y8mY/photo.jpg', '0000-00-00 00:00:00'),
(8, '114624470082022841565', '4778/4766.070', 'NABILA FIRSTANANDA SAPUTRI', 'nabila_saputri_24rpl@student.smktelkom-mlg.sch.id', 'RPL 3', '082230815893', 'female', 24, 'RPL', 'https://lh6.googleusercontent.com/-wQJcZCe_tkI/AAAAAAAAAAI/AAAAAAAAAEA/-Gje0URzoR4/photo.jpg', '0000-00-00 00:00:00'),
(9, '113737970762948243576', '', 'Ahmad Dimas Abid Muttaqi', 'ahmad_muttaqi_24rpl@student.smktelkom-mlg.sch.id', '', '', 'male', 24, 'RPL', 'https://lh3.googleusercontent.com/-HFMtJNXTtOE/AAAAAAAAAAI/AAAAAAAAAFc/HAOHOlJNBFU/photo.jpg', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tb_guru_pembimbing`
--
ALTER TABLE `tb_guru_pembimbing`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indexes for table `tb_guru_perusahaan`
--
ALTER TABLE `tb_guru_perusahaan`
  ADD PRIMARY KEY (`id_guru_perusahaan`);

--
-- Indexes for table `tb_monitoring`
--
ALTER TABLE `tb_monitoring`
  ADD PRIMARY KEY (`id_monitoring`);

--
-- Indexes for table `tb_perusahaan`
--
ALTER TABLE `tb_perusahaan`
  ADD PRIMARY KEY (`id_perusahaan`);

--
-- Indexes for table `tb_perusahaan_siswa`
--
ALTER TABLE `tb_perusahaan_siswa`
  ADD PRIMARY KEY (`id_perusahaan_siswa`);

--
-- Indexes for table `tb_rekap_perusahaan`
--
ALTER TABLE `tb_rekap_perusahaan`
  ADD PRIMARY KEY (`id_rekap`);

--
-- Indexes for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_guru_pembimbing`
--
ALTER TABLE `tb_guru_pembimbing`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tb_guru_perusahaan`
--
ALTER TABLE `tb_guru_perusahaan`
  MODIFY `id_guru_perusahaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `tb_monitoring`
--
ALTER TABLE `tb_monitoring`
  MODIFY `id_monitoring` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_perusahaan`
--
ALTER TABLE `tb_perusahaan`
  MODIFY `id_perusahaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tb_perusahaan_siswa`
--
ALTER TABLE `tb_perusahaan_siswa`
  MODIFY `id_perusahaan_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `tb_rekap_perusahaan`
--
ALTER TABLE `tb_rekap_perusahaan`
  MODIFY `id_rekap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

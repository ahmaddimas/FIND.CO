-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 12 Des 2017 pada 12.27
-- Versi Server: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(1) NOT NULL,
  `last_loggin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `username`, `password`, `role`, `last_loggin`) VALUES
(1, 'hubin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_guru_pembimbing`
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
-- Dumping data untuk tabel `tb_guru_pembimbing`
--

INSERT INTO `tb_guru_pembimbing` (`id_guru`, `oauth_uid`, `nama_guru`, `email_guru`, `telp_guru`, `jk_guru`, `picture_url`) VALUES
(1, '113737970762948243576', 'Ahmad Dimas Abid Muttaqi', 'ahmad_muttaqi_24rpl@student.smktelkom-mlg.sch.id', '', 'male', 'https://lh3.googleusercontent.com/-HFMtJNXTtOE/AAAAAAAAAAI/AAAAAAAAAFc/HAOHOlJNBFU/photo.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_guru_siswa`
--

CREATE TABLE `tb_guru_siswa` (
  `id_guru_siswa` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `tahun` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_perusahaan`
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
  `picture_url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_perusahaan`
--

INSERT INTO `tb_perusahaan` (`id_perusahaan`, `nama_perusahaan`, `telp_perusahaan`, `alamat`, `kota`, `provinsi`, `fax`, `cp`, `picture_url`) VALUES
(1, 'Google Indonesia', '086234123555', 'Sentral Senayan II Lantai 28, Jl. Asia Afrika No. 8, Gelora, Tanah Abang, RT.1/RW.3, RT.1/RW.3, Gelora, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10270', 'Jakarta', 'DKI Jakarta', '1213123', 'Mrs. Nabila', 'assets/images/google.jpg'),
(3, 'SMK Telkom Malang', '081232313123', 'Jl. Danau Ranau Sawojajar Malang', 'Malang', 'Jawa Timur', '312312314', 'Mrs. Joice', 'assets/images/telkom.jpg'),
(4, 'PT. Telekomunikasi Indonesia, Tbk', '0', 'Jl. Gajah Mada No. 182-184 Lt.3 Jember 68131', 'KAB. Jember', 'Jawa Timur', '-', '(0331) 353200', 'assets/images/TI.jpg'),
(5, 'PT. Telkom Telkomsel Jakarta', '0', 'Jl. Jenderal Gatot Subroto No. 42 City Plasa Lt. II Wisma Mulia-Jakarta', 'Jakarta', 'DKI Jakarta', '-', '(021) 3850811', 'assets/images/TELKOMSEL.jpg'),
(6, 'PT. INDOSAT MEGA MEDIA JAKARTA', '0', 'JL. KEBAGUSAN RAYA NO. 36 RAGUNAN-JAKARTA', 'Jakarta', 'DKI Jakarta', '-', '(021) 78546900', 'assets/images/INDOSAT.jpg'),
(7, 'PT. Newmont Nusa Tenggara', '0', 'Jl Sriwijaya 258 Indonesia 80235', 'Makassar', 'Sulawesi Selatan', '-', '(0372)635318', 'assets/images/NEWMONT.jpg'),
(8, 'PT. Telkom Witel Solo', '081362080312', 'Jl. Mayor Kusmanto No. 1', 'Solo', 'Jawa Tengah', '-', '-', 'assets/images/WITEL_SOLO.jpg'),
(9, 'PT. FINNET INDONESIA', '0218299999', 'MENARA BIDAKARA 1 LT. 12 JL. JENDERAL GATOT SUBROTO KAV 71-73 JAKARTA 13350', 'Jakarta', 'DKI Jakarta', '-', '(021) 8299999', 'assets/images/FINNET.jpg'),
(10, 'Telkom Witel Jatim Barat', '0', 'Jl. Panjaitan 19 Madiun', 'Madiun', 'Jawa Timur', '-', '0351-494001/494203', 'assets/images/WITEL_JATIM_BARAT.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_perusahaan_siswa`
--

CREATE TABLE `tb_perusahaan_siswa` (
  `id_perusahaan_siswa` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_perusahaan` int(11) NOT NULL,
  `indeks` int(1) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_perusahaan_siswa`
--

INSERT INTO `tb_perusahaan_siswa` (`id_perusahaan_siswa`, `id_siswa`, `id_perusahaan`, `indeks`, `status`) VALUES
(2, 1, 1, 1, 'menunggu'),
(3, 1, 3, 2, 'menunggu'),
(4, 3, 4, 1, 'menunggu'),
(5, 3, 3, 2, 'menunggu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_rekap_perusahaan`
--

CREATE TABLE `tb_rekap_perusahaan` (
  `id_rekap` int(11) NOT NULL,
  `id_perusahaan` int(11) NOT NULL,
  `kuota` int(11) NOT NULL,
  `tahun_rekap` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_rekap_perusahaan`
--

INSERT INTO `tb_rekap_perusahaan` (`id_rekap`, `id_perusahaan`, `kuota`, `tahun_rekap`) VALUES
(1, 1, 2, 2017),
(3, 3, 5, 2016),
(9, 3, 4, 2017),
(10, 4, 6, 2017),
(11, 5, 4, 2017),
(12, 6, 3, 2017),
(13, 7, 2, 2017),
(14, 8, 3, 2017),
(15, 9, 8, 2017),
(16, 10, 9, 2017);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_siswa`
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
-- Dumping data untuk tabel `tb_siswa`
--

INSERT INTO `tb_siswa` (`id_siswa`, `oauth_uid`, `nis`, `nama_siswa`, `email_siswa`, `kelas`, `telp_siswa`, `jk_siswa`, `angkatan`, `jurusan`, `picture_url`, `last_logged`) VALUES
(1, '113737970762948243576', '', 'Ahmad Dimas Abid Muttaqi', 'ahmad_muttaqi_24rpl@student.smktelkom-mlg.sch.id', 'RPL 3', '082236421452', 'male', 24, 'RPL', 'https://lh3.googleusercontent.com/-HFMtJNXTtOE/AAAAAAAAAAI/AAAAAAAAAFc/HAOHOlJNBFU/photo.jpg', '0000-00-00 00:00:00'),
(2, '114624470082022841565', '', 'NABILA FIRSTANANDA SAPUTRI', 'nabila_saputri_24rpl@student.smktelkom-mlg.sch.id', '', '', 'female', 24, 'RPL', 'https://lh6.googleusercontent.com/-wQJcZCe_tkI/AAAAAAAAAAI/AAAAAAAAAEA/-Gje0URzoR4/photo.jpg', '0000-00-00 00:00:00'),
(3, '112274529044745553265', '', 'JOICE JESSICA', 'joice_jessica_24rpl@student.smktelkom-mlg.sch.id', '', '', 'female', 24, 'RPL', 'https://lh6.googleusercontent.com/-OcmbJ3_QhnU/AAAAAAAAAAI/AAAAAAAAADc/PMJ22aPOPH8/photo.jpg', '0000-00-00 00:00:00'),
(4, '103364408396867969257', '', 'Mohammad Huzaer Rekso Jiwo', 'mohammad_jiwo_24rpl@student.smktelkom-mlg.sch.id', '', '', 'male', 24, 'RPL', 'https://lh6.googleusercontent.com/-FkGQFBem1uM/AAAAAAAAAAI/AAAAAAAAADw/GGaWhGPFBYA/photo.jpg', '0000-00-00 00:00:00');

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
-- Indexes for table `tb_guru_siswa`
--
ALTER TABLE `tb_guru_siswa`
  ADD PRIMARY KEY (`id_guru_siswa`);

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
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_guru_siswa`
--
ALTER TABLE `tb_guru_siswa`
  MODIFY `id_guru_siswa` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_perusahaan`
--
ALTER TABLE `tb_perusahaan`
  MODIFY `id_perusahaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tb_perusahaan_siswa`
--
ALTER TABLE `tb_perusahaan_siswa`
  MODIFY `id_perusahaan_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tb_rekap_perusahaan`
--
ALTER TABLE `tb_rekap_perusahaan`
  MODIFY `id_rekap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

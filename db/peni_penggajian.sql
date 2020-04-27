-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Apr 2020 pada 17.57
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `peni_penggajian`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `gaji`
--

CREATE TABLE `gaji` (
  `id_gaji` int(10) NOT NULL,
  `tgl_gaji` date NOT NULL,
  `nip` varchar(10) NOT NULL,
  `gaji` double NOT NULL,
  `lembur` double NOT NULL,
  `uang_makan` double NOT NULL,
  `transport` double NOT NULL,
  `bpjs` double NOT NULL,
  `pph21` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `gaji`
--

INSERT INTO `gaji` (`id_gaji`, `tgl_gaji`, `nip`, `gaji`, `lembur`, `uang_makan`, `transport`, `bpjs`, `pph21`) VALUES
(24, '2020-04-27', '1501091009', 2000000, 560000, 1500000, 750000, 41000, 200000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `nip` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `jabatan` varchar(20) NOT NULL,
  `nohp` varchar(12) NOT NULL,
  `sk` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`nip`, `nama`, `alamat`, `jabatan`, `nohp`, `sk`) VALUES
('1501091001', 'Tasyaa', 'Jakarta', 'Manager Keuangan', '081222675643', ''),
('1501091002', 'Fara', 'Padang Panjang', 'Programmer', '081288123344', 'S'),
('1501091003', 'Rangga', 'Depok', 'Operator', '089976554388', ''),
('1501091004', 'Iding', 'Padang Pendek', 'Operator Jet', '083811436677', 'df'),
('1501091006', 'Ahyani', 'bekasi barat daya', 'Direktur', '08127778767', ''),
('1501091008', 'Huri', 'Jakarta', 'Kepala Bagian', '089938737766', ''),
('1501091009', 'Alexa', 'Jakarta', 'Operator', '081233564487', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `username` varchar(20) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `password` varchar(20) NOT NULL,
  `level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`username`, `nama`, `password`, `level`) VALUES
('adminkeu', 'Nur Jaman', 'admin', 'keu'),
('adminspv', 'Jayadi', 'admin', 'spv');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `gaji`
--
ALTER TABLE `gaji`
  ADD PRIMARY KEY (`id_gaji`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`nip`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `gaji`
--
ALTER TABLE `gaji`
  MODIFY `id_gaji` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

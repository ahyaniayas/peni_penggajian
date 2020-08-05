-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Jun 2020 pada 15.55
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
  `hari_kerja` varchar(5) NOT NULL,
  `lembur` double NOT NULL,
  `uang_makan` double NOT NULL,
  `transport` double NOT NULL,
  `bpjs` double NOT NULL,
  `pph21` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `gaji`
--

INSERT INTO `gaji` (`id_gaji`, `tgl_gaji`, `nip`, `gaji`, `hari_kerja`, `lembur`, `uang_makan`, `transport`, `bpjs`, `pph21`) VALUES
(25, '2020-06-25', '5500', 4276500, '21', 150000, 500000, 750000, 171060, 0),
(27, '2020-06-25', '5501', 4276500, '21', 230000, 2000000, 2000000, 171060, 0),
(27, '2020-06-25', '5501', 4276500, '21', 230000, 2000000, 2000000, 171060, 0),
(27, '2020-06-25', '5501', 4276500, '21', 230000, 2000000, 2000000, 171060, 0),
(27, '2020-06-25', '5501', 4276500, '21', 230000, 2000000, 2000000, 171060, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoice`
--

CREATE TABLE `invoice` (
  `id_invoice` int(11) NOT NULL,
  `tgl_invoice` date NOT NULL,
  `nomor` varchar(25) NOT NULL,
  `total_gaji` double NOT NULL,
  `mfee` double NOT NULL,
  `bayar` double NOT NULL,
  `tgl_bayar` date NOT NULL,
  `id_perusahaan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `invoice`
--

INSERT INTO `invoice` (`id_invoice`, `tgl_invoice`, `nomor`, `total_gaji`, `mfee`, `bayar`, `tgl_bayar`, `id_perusahaan`) VALUES
(2, '2020-03-31', 'INV-228042020025314', 15000000, 5500000, 20940000, '2020-04-28', 2),
(3, '2020-04-28', 'INV-228042020075443', 25000000, 5500000, 0, '0000-00-00', 2),
(4, '2020-01-29', 'INV-328042020102647', 55000000, 6500000, 0, '0000-00-00', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `nip` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nomor_rekening` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `jabatan` varchar(20) NOT NULL,
  `nohp` varchar(12) NOT NULL,
  `id_perusahaan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`nip`, `nama`, `nomor_rekening`, `alamat`, `jabatan`, `nohp`, `id_perusahaan`) VALUES
('1501091001', 'Tasyaa', '1560003606318', 'Jakarta', 'Operator Produksi', '081222675643', 2),
('1501091002', 'Fara', '1560003606319', 'Padang Panjang', 'Operator Produksi', '081288123344', 3),
('1501091003', 'Rangga', '1560003606310', 'Depok', 'Operator Produksi', '089976554388', 3),
('1501091004', 'Iding', '1560003606311', 'Padang Pendek', 'Operator Produksi', '083811436677', 3),
('1501091006', 'Ahyani', '1560003606312', 'bekasi barat daya', 'Operator Produksi', '08127778767', 2)
;

-- --------------------------------------------------------

--
-- Struktur dari tabel `perusahaan`
--

CREATE TABLE `perusahaan` (
  `id_perusahaan` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `perusahaan`
--

INSERT INTO `perusahaan` (`id_perusahaan`, `nama`, `alamat`) VALUES
(2, 'PT Astra International', 'Jalan Raya Bekasi Timur No. 12'),
(3, 'PT Mondelez Indonesia Manufacturing', 'Jl Inspeksi Kali Malang No. 46'),
(4, 'PT Best Label Indonesia', 'Jl Raya Jakarta Bogor KM 33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `username` varchar(20) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `password` varchar(20) NOT NULL,
  `level` enum('spv','keu','super','') NOT NULL,
  `id_perusahaan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`username`, `nama`, `password`, `level`, `id_perusahaan`) VALUES
('adminkeu', 'Bagian Keuangan', 'admin', 'keu', NULL),
('adminspv', 'Supervisor', 'admin', 'spv', 3),
('adminsuper', 'Peni', 'admin', 'super', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `gaji`
--
ALTER TABLE `gaji`
  ADD PRIMARY KEY (`id_gaji`),
  ADD KEY `nip` (`nip`);

--
-- Indeks untuk tabel `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id_invoice`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`nip`),
  ADD KEY `id_perusahaan` (`id_perusahaan`);

--
-- Indeks untuk tabel `perusahaan`
--
ALTER TABLE `perusahaan`
  ADD PRIMARY KEY (`id_perusahaan`);

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
  MODIFY `id_gaji` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id_invoice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `perusahaan`
--
ALTER TABLE `perusahaan`
  MODIFY `id_perusahaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `gaji`
--
ALTER TABLE `gaji`
  ADD CONSTRAINT `gaji_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `pegawai` (`nip`);

--
-- Ketidakleluasaan untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`id_perusahaan`) REFERENCES `perusahaan` (`id_perusahaan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

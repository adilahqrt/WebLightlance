-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Des 2021 pada 04.09
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lightlance`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(2) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_password` varchar(20) NOT NULL,
  `user_fullname` varchar(30) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `user_email`, `user_password`, `user_fullname`, `foto`) VALUES
(1, 'admin@gmail.com', '12345', 'administrator', 'Administrator-256.png'),
(2, 'admin2@gmail.com', '12345', 'administrator2', 'Dekorasi_Tedak_Siten_Berwarna_merah.width-800.jpg'),
(3, 'admin3@gmail.com', '123321', 'administrator3', 'Pelanggan-removebg-preview.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(2) NOT NULL,
  `nama_kategori` varchar(15) NOT NULL,
  `image_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `image_kategori`) VALUES
(1, 'Wedding', 'Dekorasi_Tedak_Siten_Berwarna_merah.width-800.jpg'),
(2, 'PreWedding', ''),
(3, 'Engagement', ''),
(4, 'Birthday Party', ''),
(5, 'Tedak Siten', 'Dekorasi_Tedak_Siten_Berwarna_merah.width-800.jpg'),
(6, 'Pas Photo', ''),
(7, 'Hunting', ''),
(13, 'Tedak Sinten', 'Screenshot_26.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `paket`
--

CREATE TABLE `paket` (
  `id_paket` int(2) NOT NULL,
  `nama_paket` varchar(20) NOT NULL,
  `harga_paket` int(10) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `id_kategori` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `paket`
--

INSERT INTO `paket` (`id_paket`, `nama_paket`, `harga_paket`, `deskripsi`, `id_kategori`) VALUES
(1, 'Wedding 1', 500, '1 Roll Foto (40 Foto)\r\n5 Jam Kerja\r\nAll File Edit', 2),
(2, 'Wedding 2', 500000, '2 Roll Foto (80 Foto)\r\n5 Jam Kerja \r\nAll File Edit\r\n', 1),
(3, 'PreWedding', 750000, 'Foto Konsep\r\n2 Hardfile Custom\r\n2 Jam Kerja di Lokasi \r\nAll File Edit\r\n', 2),
(4, 'Engagement 1', 350000, '1 Roll Foto (40 Foto)\r\n5 Jam Kerja\r\nAll File Edit', 3),
(5, 'Engagement 2', 500000, '2 Roll Foto (80 Foto)\r\n5 Jam Kerja\r\nAll File Edit\r\n', 3),
(6, 'Birthday Party 1', 350000, '1 Roll Foto (40 foto)\r\n5 Jam Kerja\r\nAll File Edit\r\n', 4),
(7, 'Birthday Party 2', 500000, '2 Roll Foto (80 Foto)\r\n5 Jam Kerja\r\nAll File Edit', 4),
(8, 'Tedak Siten 1', 350000, '1 Roll Foto (40 Foto)\r\n5 Jam Kerja\r\nAll File Edit', 5),
(9, 'Tedak Siten 2', 500000, '2 Roll Foto (80 Foto)\r\n5 Jam Kerja\r\nAll File Edit', 5),
(10, 'Pas Photo', 15000, '3x4 Hardfile 10 Lembar\r\nAll File Edit', 6),
(11, 'Hunting ', 100000, '1 Roll Foto (40 Foto)\r\n1 Lokasi\r\n2 Jam Kerja\r\nAll File Edit\r\n', 7),
(18, 'Hunting 2', 11, 'www', 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pemesanan` int(3) NOT NULL,
  `tgl_pemesanan` date NOT NULL,
  `id_user` int(3) NOT NULL,
  `id_paket` int(2) NOT NULL,
  `id_kategori` int(2) NOT NULL,
  `status_pemesanan` enum('Pending','Success','Cancel') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pemesanan`
--

INSERT INTO `pemesanan` (`id_pemesanan`, `tgl_pemesanan`, `id_user`, `id_paket`, `id_kategori`, `status_pemesanan`) VALUES
(2, '2021-12-25', 4, 6, 4, 'Success'),
(3, '2021-12-31', 3, 11, 7, 'Pending');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(3) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `alamat` varchar(40) NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `saldo` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `email`, `password`, `fullname`, `gender`, `alamat`, `no_telp`, `saldo`) VALUES
(1, 'adilah.qurrotu.aini@gmail.com', '$2y$10$syqkDgBWIwy9YQrvEthJMuJHRHJB4U47eIEtY.J9oMp.5BIMn.E2u', 'adilah', 'Female', 'Jember', '08234567890', 0),
(2, 'adilah.qurrotu25@gmail.com', '$2y$10$EBBdU.95RBpu2nIkVezfa.Mq..d1/RgHuJzImm31b0CEH4N/g4tJG', 'dila', 'Female', 'Jember', '081234567890', 0),
(3, 'denica123@gmail.com', '$2y$10$UuCl4vY0yqSGJ1i01wXkyOUiOU6T3cKjctGcT1wxKoznNa8egjZC.', 'deni', 'Female', 'Jember', '089876543210', 0),
(4, 'adilaah@gmail.com', '$2y$10$p9/4r9fO/3BBwOF.HWSFpeMK1ZWl1XirKCRHD810IPHb0SU4JZVqq', 'Adilah Qurrotu', 'Female', 'jember', '081234567890', 0),
(5, 'dila@gmail.com', '$2y$10$KeleWo0Tb/fZFm5rS9P/7efl5s8.nO4nzKoq65c8T1dD6fr4RkbIe', 'Dila', 'Female', 'Rambi', '088765431239', 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`id_paket`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_kategori` (`id_paket`),
  ADD KEY `id_paket` (`id_paket`),
  ADD KEY `MEMILIH` (`id_kategori`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `paket`
--
ALTER TABLE `paket`
  MODIFY `id_paket` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pemesanan` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `paket`
--
ALTER TABLE `paket`
  ADD CONSTRAINT `DIMILIKI` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);

--
-- Ketidakleluasaan untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `DIPESAN` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `MEMILIH` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`),
  ADD CONSTRAINT `MEMILIIH` FOREIGN KEY (`id_paket`) REFERENCES `paket` (`id_paket`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2023 at 08:50 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ernov`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Bag'),
(2, 'Sandal'),
(3, 'Wallet'),
(4, 'Belt'),
(5, 'Clutch');

-- --------------------------------------------------------

--
-- Table structure for table `keluar`
--

CREATE TABLE `keluar` (
  `id_keluar` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp(),
  `qty` int(11) NOT NULL,
  `penerima` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keluar`
--

INSERT INTO `keluar` (`id_keluar`, `id_barang`, `tanggal`, `qty`, `penerima`) VALUES
(1, 2, '2023-06-13', 1, 'toko'),
(2, 1, '2023-06-13', 1, 'toko'),
(3, 3, '2023-06-13', 1, 'customer'),
(4, 1, '2023-06-13', 1, 'customer'),
(5, 4, '2023-06-13', 12, 'customer'),
(6, 8, '2023-06-14', 7, 'toko'),
(7, 11, '2023-06-14', 50, 'toko'),
(8, 3, '2023-06-14', 1, 'toko'),
(9, 14, '2023-06-14', 3, 'toko');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id_user` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id_user`, `email`, `username`, `password`, `role`) VALUES
(1, 'hihihi@gmail.com', 'bujang', '827', 'member'),
(5, 'gok@gmail.com', 'do', '827ccb0eea8a706c4c34a16891f84e7b', 'member'),
(6, 'ridho@gmail.com', 'ridho', '12345', 'member'),
(7, 'hihihi@gmail.com', 'bujang', '12345', 'member');

-- --------------------------------------------------------

--
-- Table structure for table `masuk`
--

CREATE TABLE `masuk` (
  `id_masuk` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp(),
  `keterangan` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `masuk`
--

INSERT INTO `masuk` (`id_masuk`, `id_barang`, `tanggal`, `keterangan`, `qty`) VALUES
(1, 1, '2023-06-13', 'gudang', 1),
(2, 1, '2023-06-13', 'gudang', 5),
(3, 3, '2023-06-13', 'gudang', 1),
(4, 1, '2023-06-14', 'gudang', 40),
(5, 2, '2023-06-14', 'gudang', 30),
(6, 3, '2023-06-14', 'gudang', 1),
(7, 4, '2023-06-14', 'gudang', 34),
(8, 1, '2023-06-14', 'gudang', 20),
(9, 11, '2023-06-14', 'gudang', 1),
(10, 15, '2023-06-14', 'gudang', 3);

-- --------------------------------------------------------

--
-- Table structure for table `stok`
--

CREATE TABLE `stok` (
  `id_barang` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stok`
--

INSERT INTO `stok` (`id_barang`, `id_kategori`, `nama_barang`, `harga`, `deskripsi`, `stock`, `image`) VALUES
(1, 1, 'Bag Li', 50000, 'kulit', 60, ''),
(2, 2, 'sandal ', 10000, 'Python', 30, ''),
(3, 1, 'bag python', 1000000, 'Python', 0, 'a663c2628b6da3c19fbbd33dadd2e23c.jpg'),
(4, 1, 'Bag Chanel', 1000000, 'Python', 34, ''),
(5, 1, 'Bag Celine', 1000000, 'Python', 30, ''),
(8, 1, 'Aluna', 1000000, 'Python', 5, NULL),
(9, 1, 'Bag Oval', 1000000, 'rajut', 13, '336e0b8ea54b77923fa67888dffbeb2d.jpg'),
(11, 2, 'Sandal Herme', 10000, 'Python', 51, '8320519fea711fd1734070a46dcc63c5.jpg'),
(12, 1, 'vvvvv', 10000, 'kulit', 100, '1f3f898b36c4d5f6e9461900a52dc318.jpg'),
(14, 3, 'wallet Smox', 150000, 'Rotan', 9, NULL),
(15, 1, 'Bag carla', 1000000, 'Python', 103, 'a09a2264de4109177aea4c1f6acfc970.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `keluar`
--
ALTER TABLE `keluar`
  ADD PRIMARY KEY (`id_keluar`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `masuk`
--
ALTER TABLE `masuk`
  ADD PRIMARY KEY (`id_masuk`);

--
-- Indexes for table `stok`
--
ALTER TABLE `stok`
  ADD PRIMARY KEY (`id_barang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `keluar`
--
ALTER TABLE `keluar`
  MODIFY `id_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `masuk`
--
ALTER TABLE `masuk`
  MODIFY `id_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `stok`
--
ALTER TABLE `stok`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

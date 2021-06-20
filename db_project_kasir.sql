-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2021 at 10:04 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_project_kasir`
--

-- --------------------------------------------------------

--
-- Table structure for table `cash_balance`
--

CREATE TABLE `cash_balance` (
  `ID` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `mutation` varchar(50) NOT NULL,
  `amount` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail_transaksi`
--

CREATE TABLE `tb_detail_transaksi` (
  `id` int(11) NOT NULL,
  `id_transaksi` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `produk` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `harga` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id_kategori` int(11) NOT NULL,
  `kategori` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kategori`
--

INSERT INTO `tb_kategori` (`id_kategori`, `kategori`) VALUES
(23, 'Makanan'),
(30, 'Minuman'),
(42, 'Makanan Ringan'),
(67, 'Pecah Belah');

-- --------------------------------------------------------

--
-- Table structure for table `tb_produk`
--

CREATE TABLE `tb_produk` (
  `id_produk` int(11) NOT NULL,
  `kode_produk` varchar(50) NOT NULL,
  `nama_produk` varchar(500) DEFAULT NULL,
  `stok` int(11) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `harga_beli` int(255) DEFAULT NULL,
  `harga_umum` int(255) NOT NULL,
  `harga_langganan` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_produk`
--

INSERT INTO `tb_produk` (`id_produk`, `kode_produk`, `nama_produk`, `stok`, `satuan`, `id_kategori`, `harga_beli`, `harga_umum`, `harga_langganan`) VALUES
(84, '999999001', 'Le Minerale', 399, 'Btl sedang', 42, 3000, 5000, 4000),
(85, '999999002', 'Le Minerale Besar', 265, 'btl bsr', 30, 5000, 7000, 6000),
(86, '999999003', 'Gelas', 246, 'Lusin', 67, 45000, 60000, 55000),
(87, '999999004', 'Piring Kaca', 262, 'Lusin', 67, 50000, 70000, 65000),
(88, '999999005', 'Qtela Singkong', 399, 'bks', 23, 5000, 8000, 7000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_transaksi` varchar(50) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `date` datetime DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `paid` int(255) DEFAULT NULL,
  `selling_type` varchar(50) CHARACTER SET latin1 NOT NULL DEFAULT 'default',
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `telepon` varchar(30) NOT NULL,
  `password` varchar(250) NOT NULL,
  `level` enum('admin','kasir') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `telepon`, `password`, `level`) VALUES
(1, 'Administrator', 'administrator', '02100001', '$2y$10$IFeEn3gqmBCzcmU9.1hfiee1zBXnxQgsJSkZq5EXXzAK9Te/hq1dK', 'admin'),
(2, 'Dg. Tiro', 'dg-tiro', '021112126', '$2y$10$/YpuKUTS9Q5HDZ2w5bL0nOb7znKw.v7dub.1NLvwgvEdleQGx5N4.', 'kasir'),
(3, 'Matius Rimbe', 'matius-rimbe', '0211212124', '$2y$10$wiKRks1F4eNJw041MeRduuV9jT0skzD0bHJJnyKuMCLOjpW7GGokq', 'admin'),
(18, 'Septi Rosma', 'septi-rosma', '8777', '$2y$10$2phfXZQJxnUO7/BMYc3RzuvS3x2Ld0SSAPcWuJSCnq3nBe7K.tYvC', 'admin'),
(19, 'kasir', 'kasir', '0210001', '$2y$10$8HieAqKDZUvZVCGZhufSj.bBVfJXGjd/DprsJ5oAchoALJUevc1Ty', 'kasir');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cash_balance`
--
ALTER TABLE `cash_balance`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `date` (`date`);

--
-- Indexes for table `tb_detail_transaksi`
--
ALTER TABLE `tb_detail_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `kat-relasi` (`id_kategori`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cash_balance`
--
ALTER TABLE `cash_balance`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_detail_transaksi`
--
ALTER TABLE `tb_detail_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `tb_produk`
--
ALTER TABLE `tb_produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

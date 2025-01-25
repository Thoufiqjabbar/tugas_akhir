-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 25, 2025 at 12:31 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laundry_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jen`
--

CREATE TABLE `jen` (
  `id` int NOT NULL,
  `nama_layanan` varchar(25) NOT NULL,
  `harga` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laundry`
--

CREATE TABLE `laundry` (
  `id` int NOT NULL,
  `jumlah_pakaian` int NOT NULL,
  `berat` decimal(10,2) NOT NULL,
  `jenis_layanan` varchar(15) NOT NULL,
  `harga_layanan` decimal(10,2) NOT NULL,
  `harga_antar` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int NOT NULL,
  `id_pelanggan` int NOT NULL,
  `jumlah_pakaian` int NOT NULL,
  `berat` decimal(10,2) NOT NULL,
  `jenis_layanan` varchar(25) NOT NULL,
  `harga_layanan` decimal(10,2) NOT NULL,
  `harga_antar` decimal(10,2) NOT NULL,
  `setatus_order` varchar(100) NOT NULL,
  `total_harga` decimal(10,2) NOT NULL,
  `tanggal_order` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jen`
--
ALTER TABLE `jen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nama_layanan` (`nama_layanan`),
  ADD KEY `nama_layanan_2` (`nama_layanan`);

--
-- Indexes for table `laundry`
--
ALTER TABLE `laundry`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jenis_layanan` (`jenis_layanan`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jenis_layanan` (`jenis_layanan`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jen`
--
ALTER TABLE `jen`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laundry`
--
ALTER TABLE `laundry`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jen`
--
ALTER TABLE `jen`
  ADD CONSTRAINT `jen_ibfk_1` FOREIGN KEY (`nama_layanan`) REFERENCES `order` (`jenis_layanan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `laundry`
--
ALTER TABLE `laundry`
  ADD CONSTRAINT `laundry_ibfk_1` FOREIGN KEY (`jenis_layanan`) REFERENCES `jen` (`nama_layanan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

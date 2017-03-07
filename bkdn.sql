-- phpMyAdmin SQL Dump
-- version 4.4.13.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 13, 2017 at 01:19 PM
-- Server version: 5.6.31-0ubuntu0.15.10.1
-- PHP Version: 5.6.11-1ubuntu3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bkdn`
--

-- --------------------------------------------------------

--
-- Table structure for table `mst_customer`
--

CREATE TABLE IF NOT EXISTS `mst_customer` (
  `id` int(4) NOT NULL,
  `code` varchar(25) NOT NULL,
  `addby` varchar(15) NOT NULL,
  `adddt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modby` varchar(15) DEFAULT NULL,
  `moddt` datetime DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `npwp` varchar(25) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `deleted` enum('0','1') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_customer`
--

INSERT INTO `mst_customer` (`id`, `code`, `addby`, `adddt`, `modby`, `moddt`, `name`, `address`, `npwp`, `phone`, `deleted`) VALUES
(1, 'CUS001', 'SYSTEM', '2017-01-01 06:42:39', 'SYSTEM', '2017-01-31 11:47:04', 'PT SUMBER WARAS', 'JAKARTA BARAT JABAR', '099888.12113.4445.7', '+62896888999998', '0'),
(3, 'CUS002', 'SYSTEM', '2017-01-01 07:01:36', NULL, NULL, 'PT WIJAYA KUSUMA', 'JAKARTA SELATAN JLN TB SIMATUPANG', '899999.121.2323232', '+62896889999999', '0'),
(4, 'CUS003', 'SYSTEM', '2017-01-24 14:21:48', NULL, NULL, 'PT PERDANA PRATAMA', 'JL RAYA JAKARATA-BOGOR, CIMANGGIS-DEPOK', '0001888877775555', '089678554321', '0'),
(5, 'CUS004', 'SYSTEM', '2017-01-24 14:26:08', 'SYSTEM', '2017-01-31 11:51:40', 'PT JAYA LAKSANA', 'JL RAYA PADJAJARAN BOGOR TENGAH', '09888888888', '111111111111111', '1'),
(6, 'CUS005', 'SYSTEM', '2017-01-24 14:34:06', 'SYSTEM', '2017-01-31 11:41:35', 'PT DRAKULA INDONESIA', 'JL HEULANG JAKARTA BARAT', '222222222222222', '333333333333333', '1'),
(7, 'CUS006', 'SYSTEM', '2017-01-31 11:50:44', 'SYSTEM', '2017-01-31 11:51:32', 'PT AL-ZEZA ', 'Kp Mekarsari RT 05 RW 11', '123456', '123456', '0');

-- --------------------------------------------------------

--
-- Table structure for table `mst_division`
--

CREATE TABLE IF NOT EXISTS `mst_division` (
  `id` int(4) NOT NULL,
  `addby` varchar(25) NOT NULL,
  `adddt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modby` varchar(25) DEFAULT NULL,
  `moddt` datetime DEFAULT NULL,
  `code` varchar(25) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_division`
--

INSERT INTO `mst_division` (`id`, `addby`, `adddt`, `modby`, `moddt`, `code`, `project_name`, `address`, `deleted`) VALUES
(1, 'SYSTEM', '2017-01-01 15:39:33', NULL, NULL, 'EPC', 'PLTG (peaker) 100 MW Gorontalo', 'Desa Maleo, Kecamatan Paguat, Kab Pohuwatu, Provinsi Gorontalo', '0');

-- --------------------------------------------------------

--
-- Table structure for table `mst_emailtmpl`
--

CREATE TABLE IF NOT EXISTS `mst_emailtmpl` (
  `id` int(4) NOT NULL,
  `addby` varchar(25) NOT NULL,
  `adddt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modby` varchar(25) DEFAULT NULL,
  `moddt` datetime DEFAULT NULL,
  `code` varchar(15) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `bodymsg` text,
  `deleted` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0 (TIDAK TERHAPUS) 1 (TERHAPUS)'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_emailtmpl`
--

INSERT INTO `mst_emailtmpl` (`id`, `addby`, `adddt`, `modby`, `moddt`, `code`, `name`, `bodymsg`, `deleted`) VALUES
(1, 'EMP00009', '2017-02-08 13:04:27', 'EMP00009', '2017-02-09 03:35:38', 'ETL0001', 'test email', 'woke bro', '0');

-- --------------------------------------------------------

--
-- Table structure for table `mst_employee`
--

CREATE TABLE IF NOT EXISTS `mst_employee` (
  `id` int(4) NOT NULL,
  `code` varchar(35) NOT NULL,
  `adddt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `addby` varchar(15) NOT NULL,
  `moddt` datetime DEFAULT NULL,
  `modby` varchar(15) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `placeofbirth` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `id_role` int(11) DEFAULT NULL,
  `deleted` enum('0','1') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_employee`
--

INSERT INTO `mst_employee` (`id`, `code`, `adddt`, `addby`, `moddt`, `modby`, `name`, `placeofbirth`, `birthday`, `gender`, `address`, `phone`, `username`, `password`, `id_role`, `deleted`) VALUES
(1, 'EMP00001', '2016-12-17 00:00:00', 'SYSTEM', '2017-02-02 06:01:10', 'EMP00001', 'ADAM', 'BOGOR', '1981-08-12', 'male', 'BOGOR, KP MEKAR SARI RT 05 RW 11', '089679089556', 'adam.sumarna', '25d55ad283aa400af464c76d713c07ad', 1, '0'),
(3, 'EMP00002', '0000-00-00 00:00:00', 'SYSTEM', '2017-01-31 11:31:52', 'EMP00001', 'BAMBANG', 'Wonongsari', '2017-01-31', 'male', 'JAKARTA', '12345', 'user', 'e10adc3949ba59abbe56e057f20f883e', 2, '0'),
(4, 'EMP00003', '0000-00-00 00:00:00', 'SYSTEM', '2017-02-05 17:40:40', 'EMP00001', 'SUHARNO', 'Wonogiri', '2017-01-31', 'male', 'JAKARTA', '12345', 'user1', 'e10adc3949ba59abbe56e057f20f883e', NULL, '0'),
(5, 'EMP00004', '0000-00-00 00:00:00', 'SYSTEM', '2017-01-31 11:32:37', 'EMP00001', 'KODIRAN', 'Banjar Negara', '2017-01-31', 'male', 'JAKARTA', '12345', 'user2', 'e10adc3949ba59abbe56e057f20f883e', NULL, '0'),
(6, 'EMP00005', '0000-00-00 00:00:00', 'SYSTEM', '2017-01-31 11:32:47', 'EMP00001', 'LARSO', 'Wonogiri', '2017-01-31', 'male', 'JAKARTA', '12345', 'user3', 'e10adc3949ba59abbe56e057f20f883e', 2, '0'),
(7, 'EMP00006', '0000-00-00 00:00:00', 'SYSTEM', '2017-01-31 11:40:24', 'EMP00001', 'PEBRY SETIAWAN', 'Jakarta', '2017-01-31', 'male', 'JAKARTA', '12345', 'user4', 'e10adc3949ba59abbe56e057f20f883e', 2, '0'),
(8, 'EMP00007', '0000-00-00 00:00:00', 'SYSTEM', '2017-01-31 11:40:05', 'EMP00001', 'SUKARSIH', 'Tangerang', '2017-01-31', 'female', 'JAKARTA', '12345', 'user5', 'e10adc3949ba59abbe56e057f20f883e', NULL, '1'),
(9, 'EMP00008', '0000-00-00 00:00:00', 'SYSTEM', '2017-01-31 11:39:59', 'EMP00001', 'DENI', 'Jakarta', '2017-01-31', 'male', 'JAKARTA', '12345', 'user6', 'e10adc3949ba59abbe56e057f20f883e', NULL, '1'),
(10, 'EMP00009', '0000-00-00 00:00:00', 'SYSTEM', '2017-01-31 11:39:05', 'EMP00001', 'Abdul Syakur', 'Tanjung Raja', '2017-01-31', 'male', 'JAKARTA', '12345', 'syakur', '4297f44b13955235245b2497399d7a93', 1, '0');

-- --------------------------------------------------------

--
-- Table structure for table `mst_pj`
--

CREATE TABLE IF NOT EXISTS `mst_pj` (
  `id` int(4) NOT NULL,
  `addby` varchar(25) NOT NULL,
  `adddt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modby` varchar(25) DEFAULT NULL,
  `moddt` datetime DEFAULT NULL,
  `code` varchar(15) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0 (TIDAK TERHAPUS) 1 (TERHAPUS)'
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_pj`
--

INSERT INTO `mst_pj` (`id`, `addby`, `adddt`, `modby`, `moddt`, `code`, `name`, `deleted`) VALUES
(1, 'SYSTEM', '2017-01-01 11:30:39', 'SYSTEM', '2017-01-19 22:29:14', 'P001', 'PENGANGKUTAN', '0'),
(2, 'SYSTEM', '2017-01-01 11:41:33', NULL, NULL, 'P002', 'JUAL BELI', '0'),
(3, 'SYSTEM', '2017-01-01 11:42:26', NULL, NULL, 'P003', 'BORONGAN', '0'),
(4, 'SYSTEM', '2017-01-26 16:19:59', 'SYSTEM', '2017-01-31 05:03:50', 'P004', 'ANGKUT DAN GOTONG 3', '0'),
(5, 'SYSTEM', '2017-01-26 17:16:25', 'SYSTEM', '2017-01-31 05:04:02', 'P005', 'PJPJP', '0'),
(6, 'SYSTEM', '2017-01-26 17:17:45', NULL, NULL, 'P006', 'SYAKUR KURA KURA', '0'),
(7, 'SYSTEM', '2017-01-26 17:22:26', NULL, NULL, 'P007', 'SAYKUR LAH', '0'),
(8, 'SYSTEM', '2017-02-08 12:48:15', 'SYSTEM', '2017-02-08 12:49:30', 'P008', 'test', '1'),
(9, 'SYSTEM', '2017-02-08 12:49:36', 'SYSTEM', '2017-02-08 12:49:43', 'P009', 'test', '1'),
(10, 'SYSTEM', '2017-02-08 12:50:07', 'SYSTEM', '2017-02-08 12:50:23', 'P0010', 'test', '1');

-- --------------------------------------------------------

--
-- Table structure for table `mst_user_role`
--

CREATE TABLE IF NOT EXISTS `mst_user_role` (
  `id` int(11) NOT NULL,
  `addby` varchar(25) NOT NULL,
  `adddt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `modby` varchar(25) DEFAULT NULL,
  `moddt` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `role_name` varchar(255) NOT NULL DEFAULT '',
  `employee` enum('0','1') NOT NULL DEFAULT '0',
  `customer` enum('0','1') NOT NULL DEFAULT '0',
  `pj` enum('0','1') NOT NULL DEFAULT '0',
  `registerbkdn` enum('0','1') NOT NULL DEFAULT '0',
  `registercom` enum('0','1') NOT NULL DEFAULT '0',
  `print_bkdn` enum('0','1') NOT NULL DEFAULT '0',
  `invoice` enum('0','1') NOT NULL DEFAULT '0',
  `role` enum('0','1') NOT NULL DEFAULT '0',
  `user_matrix` enum('0','1') DEFAULT '0',
  `deleted` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_user_role`
--

INSERT INTO `mst_user_role` (`id`, `addby`, `adddt`, `modby`, `moddt`, `role_name`, `employee`, `customer`, `pj`, `registerbkdn`, `registercom`, `print_bkdn`, `invoice`, `role`, `user_matrix`, `deleted`) VALUES
(1, 'SYSTEM', '2017-02-01 09:17:47', NULL, '2017-02-01 09:17:47', 'administrator', '1', '1', '1', '1', '1', '1', '1', '1', '1', '0'),
(2, 'administrator', '2017-02-01 11:06:47', 'EMP00001', '2017-02-01 11:06:47', 'user', '0', '0', '0', '0', '1', '1', '0', '0', '0', '0'),
(3, 'EMP00001', '2017-02-01 11:00:31', 'EMP00001', '2017-02-01 11:00:31', 'admin', '1', '1', '1', '0', '0', '0', '0', '0', '0', '0'),
(4, 'EMP00001', '2017-02-05 21:07:25', NULL, NULL, 'User2', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `template`
--

CREATE TABLE IF NOT EXISTS `template` (
  `id` int(4) NOT NULL,
  `addby` varchar(25) NOT NULL,
  `adddt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modby` varchar(25) DEFAULT NULL,
  `moddt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trx_invoice`
--

CREATE TABLE IF NOT EXISTS `trx_invoice` (
  `id` int(4) NOT NULL,
  `addby` varchar(25) NOT NULL,
  `adddt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modby` varchar(25) DEFAULT NULL,
  `moddt` datetime DEFAULT NULL,
  `code_customer` varchar(15) NOT NULL,
  `no_kontrak` varchar(100) NOT NULL,
  `no_invoice` varchar(100) NOT NULL,
  `no_faktur` varchar(100) NOT NULL,
  `tgl` datetime NOT NULL,
  `penerima` varchar(100) NOT NULL,
  `deleted` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trx_invoice`
--

INSERT INTO `trx_invoice` (`id`, `addby`, `adddt`, `modby`, `moddt`, `code_customer`, `no_kontrak`, `no_invoice`, `no_faktur`, `tgl`, `penerima`, `deleted`) VALUES
(1, 'EMP00009', '2017-02-09 03:45:13', 'EMP00009', '2017-02-11 17:51:36', 'PT SUMBER WARAS', '062/SPP/GTL/EPC/PP/XI/2015', 'NOINVOICE', 'NOFAKTUR', '2017-02-11 12:00:00', 'PENERIMA SYAKUR', '0'),
(2, 'EMP00009', '2017-02-11 17:34:51', 'EMP00009', '2017-02-11 17:51:36', 'PT SUMBER WARAS', '062/SPP/GTL/EPC/PP/XI/2015', 'NOINVOICE', 'NOFAKTUR', '2017-02-11 12:00:00', 'PENERIMA SYAKUR', '0'),
(3, 'EMP00009', '2017-02-11 17:43:40', 'EMP00009', '2017-02-11 17:51:36', 'PT SUMBER WARAS', '062/SPP/GTL/EPC/PP/XI/2015', 'NOINVOICE', 'NOFAKTUR', '2017-02-11 12:00:00', 'PENERIMA SYAKUR', '0'),
(4, 'EMP00009', '2017-02-11 17:51:23', 'EMP00009', '2017-02-11 17:51:36', 'PT SUMBER WARAS', '062/SPP/GTL/EPC/PP/XI/2015', 'NOINVOICE', 'NOFAKTUR', '2017-02-11 12:00:00', 'PENERIMA SYAKUR', '0');

-- --------------------------------------------------------

--
-- Table structure for table `trx_register_bkdn`
--

CREATE TABLE IF NOT EXISTS `trx_register_bkdn` (
  `id` int(4) NOT NULL,
  `no_kontrak` varchar(100) NOT NULL,
  `addby` varchar(25) NOT NULL,
  `adddt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modby` varchar(25) DEFAULT NULL,
  `moddt` datetime DEFAULT NULL,
  `code_division` varchar(15) NOT NULL,
  `code_customer` varchar(15) NOT NULL,
  `code_pj` varchar(15) NOT NULL COMMENT 'Jenis Perjanjian',
  `tgl_pj` datetime NOT NULL,
  `amount_kontrak` decimal(18,2) NOT NULL,
  `begindate` datetime NOT NULL COMMENT 'Tanggal Awal Pelaksanaan',
  `enddate` datetime NOT NULL COMMENT 'Akhir pelaksanaan',
  `ppn` int(4) NOT NULL,
  `pph` int(4) NOT NULL,
  `total_amount` decimal(18,2) NOT NULL,
  `lingkup_pekerjaan` text,
  `dasar_pelaksanaan_pekerjaan` text,
  `cara_pembayaran` text,
  `pelaksanaan_pekerjaan` text,
  `asuransi_dan_jaminan` text,
  `lain_lain` text,
  `file_name` varchar(255) DEFAULT NULL,
  `is_close` enum('0','1') DEFAULT '0' COMMENT '1 DOCUMENT SUDAH DI BUAT',
  `deleted` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trx_register_bkdn`
--

INSERT INTO `trx_register_bkdn` (`id`, `no_kontrak`, `addby`, `adddt`, `modby`, `moddt`, `code_division`, `code_customer`, `code_pj`, `tgl_pj`, `amount_kontrak`, `begindate`, `enddate`, `ppn`, `pph`, `total_amount`, `lingkup_pekerjaan`, `dasar_pelaksanaan_pekerjaan`, `cara_pembayaran`, `pelaksanaan_pekerjaan`, `asuransi_dan_jaminan`, `lain_lain`, `file_name`, `is_close`, `deleted`) VALUES
(1, '061/SPP/GTL/EPC/PP/XI/2015', 'SYSTEM', '2017-01-24 11:22:10', 'EMP00001', '2017-02-06 06:12:26', 'EPC', 'CUS001', 'P001', '2017-01-24 11:22:10', 1400000000.00, '2017-01-01 01:00:00', '2017-02-04 01:00:00', 10, 0, 1540000000.00, '<p>LINGKUP PEKERJAAN</p>', '<p>DASAR PELAKSANAAN PEKERJAAN</p>', '<p>CARA PEMBAYARAN</p>', '<p>PELAKSANAAN PEKERJAAN</p>', '<p>ASURANSI DAN JAMINAN DAN KESEHATAN</p>', '<p>LAIN-LAIN</p>', 'f233b1145d96aa046d6b91a1d393a990.xls', '1', '0'),
(2, '062/SPP/GTL/EPC/PP/XI/2015', 'SYSTEM', '2017-01-24 14:58:09', 'EMP00001', '2017-02-05 20:36:51', 'EPC', 'CUS001', 'P001', '2017-02-05 12:00:00', 2000000000.00, '2017-02-06 12:00:00', '2017-02-08 12:00:00', 10, 0, 1100000000.00, '<p>LINGKUP PEKERJAAN</p>', '<p>DASAR PELAKSANAAN PEKERJAAN</p>', '<p>CARA PEMBAYARAN</p>', '<p>PELAKSANAAN PEKERJAAN</p>', '<p>ASURANSI DAN PEKERJAAN</p>', '<p>LAIN-LAIN</p>', '624643d79e4f7c990c41c3312360dd02.pdf', '0', '0'),
(3, 'BKDN/001', 'SYSTEM', '2017-01-26 16:13:39', 'EMP00001', '2017-02-05 20:37:14', 'EPC', 'CUS001', 'P001', '2017-02-05 12:00:00', 2000000000.00, '2017-02-06 12:00:00', '2017-02-10 12:00:00', 10, 0, 2200000000.00, '<p>LINGKUP PEKERJAAN</p>', '<p>DASAR PELAKSANAAN PEKERJAAN</p>', '<p>CARA PEMBAYARAN</p>', '<p>PELAKSANAAN PEKERJAAN</p>', '<p>ASURANSI DAN JAMINAN PELAKSANAAN</p>', '<p>LAIN-LAIN</p>', '1231bdc0a941a9b035a8bfc7158f9a6a.pdf', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `trx_register_bkdn_detail`
--

CREATE TABLE IF NOT EXISTS `trx_register_bkdn_detail` (
  `id` int(4) NOT NULL,
  `no_kontrak` varchar(100) NOT NULL,
  `adddt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `addby` varchar(25) NOT NULL,
  `moddt` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modby` varchar(25) DEFAULT NULL,
  `qty` int(4) NOT NULL DEFAULT '0',
  `deskripsi` varchar(255) DEFAULT NULL,
  `spesifikasi_standart` varchar(255) DEFAULT NULL,
  `price_per_item` decimal(18,2) NOT NULL,
  `total_price` decimal(18,2) NOT NULL DEFAULT '0.00',
  `deleted` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trx_register_bkdn_detail`
--

INSERT INTO `trx_register_bkdn_detail` (`id`, `no_kontrak`, `adddt`, `addby`, `moddt`, `modby`, `qty`, `deskripsi`, `spesifikasi_standart`, `price_per_item`, `total_price`, `deleted`) VALUES
(1, '061/SPP/GTL/EPC/PP/XI/2015', '2017-01-24 11:22:10', 'SYSTEM', NULL, NULL, 1, 'DESKRIPSI', 'STANDART 1', 99999999.99, 99999999.99, '0'),
(2, '061/SPP/GTL/EPC/PP/XI/2015', '2017-01-24 11:22:10', 'SYSTEM', NULL, NULL, 1, 'PPN', 'PPN', 35000000.00, 35000000.00, '0'),
(3, '061/SPP/GTL/EPC/PP/XI/2015', '2017-01-24 11:22:10', 'SYSTEM', NULL, NULL, 1, 'PPH', 'PPH', 15000000.00, 15000000.00, '0'),
(4, '062/SPP/GTL/EPC/PP/XI/2015', '2017-02-05 19:36:01', 'SYSTEM', '2017-02-05 19:36:01', 'EMP00001', 1, 'DESKRIPSI', 'SPESIFIKASI STANDART 2', 20000000.00, 20000000.00, '0'),
(5, 'BKDN/001', '2017-01-26 16:13:39', 'SYSTEM', NULL, NULL, 1, 'DESKRIPSI', 'SPESIFIKASI STANDART', 99999999.99, 99999999.99, '0'),
(6, 'BKDN/001', '2017-01-26 16:13:39', 'SYSTEM', NULL, NULL, 1, 'PPN', 'PPN', 20000000.00, 20000000.00, '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mst_customer`
--
ALTER TABLE `mst_customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `mst_division`
--
ALTER TABLE `mst_division`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_emailtmpl`
--
ALTER TABLE `mst_emailtmpl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_employee`
--
ALTER TABLE `mst_employee`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `mst_pj`
--
ALTER TABLE `mst_pj`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_user_role`
--
ALTER TABLE `mst_user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template`
--
ALTER TABLE `template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trx_invoice`
--
ALTER TABLE `trx_invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trx_register_bkdn`
--
ALTER TABLE `trx_register_bkdn`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_kontrak` (`no_kontrak`),
  ADD KEY `no_kontrak_2` (`no_kontrak`);

--
-- Indexes for table `trx_register_bkdn_detail`
--
ALTER TABLE `trx_register_bkdn_detail`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mst_customer`
--
ALTER TABLE `mst_customer`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `mst_division`
--
ALTER TABLE `mst_division`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `mst_emailtmpl`
--
ALTER TABLE `mst_emailtmpl`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `mst_employee`
--
ALTER TABLE `mst_employee`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `mst_pj`
--
ALTER TABLE `mst_pj`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `mst_user_role`
--
ALTER TABLE `mst_user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `template`
--
ALTER TABLE `template`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `trx_invoice`
--
ALTER TABLE `trx_invoice`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `trx_register_bkdn`
--
ALTER TABLE `trx_register_bkdn`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `trx_register_bkdn_detail`
--
ALTER TABLE `trx_register_bkdn_detail`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

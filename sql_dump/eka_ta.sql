-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2019 at 12:17 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eka_ta`
--

-- --------------------------------------------------------

--
-- Table structure for table `det_pemesanan`
--

CREATE TABLE `det_pemesanan` (
  `id_det_pemesanan` int(10) NOT NULL,
  `id_pemesanan` int(10) DEFAULT NULL,
  `nama_produk` varchar(255) DEFAULT NULL,
  `kategori` varchar(255) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `berat` float DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `det_pemesanan`
--

INSERT INTO `det_pemesanan` (`id_det_pemesanan`, `id_pemesanan`, `nama_produk`, `kategori`, `harga`, `berat`, `jumlah`, `gambar`) VALUES
(1, 1, 'Produk Tiga Jilbab', 'Jilbab', 30000, 500, 2, '768x76811.png'),
(2, 1, 'Produk Dua Jilbab', 'Jilbab', 20000, 710, 2, '768x76810.png'),
(3, 2, 'Produk Satu Kemeja', 'Kemeja', 250000, 500, 1, '768x7686.png'),
(4, 2, 'Produk Satu Aksesoris', 'Aksesoris', 100000, 500, 1, '768x768.png'),
(5, 3, 'Produk Tiga Jilbab', 'Jilbab', 30000, 500, 2, '768x76811.png'),
(6, 3, 'Produk Dua Kemeja', 'Kemeja', 175000, 750, 2, '768x7688.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(10) NOT NULL,
  `nama` varchar(25) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `username` varchar(16) DEFAULT NULL,
  `password` varchar(16) DEFAULT NULL,
  `no_handphone` char(12) DEFAULT NULL,
  `level` enum('admin','pemilik') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `nama`, `alamat`, `username`, `password`, `no_handphone`, `level`) VALUES
(1, 'admin', 'jogja kota Tes', 'admin', 'admin', '08123456789', 'admin'),
(2, 'Eka ', 'Alamat Pemilik', 'pemilik', 'pemilik', '08123456789', 'pemilik');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id_kategori` int(11) NOT NULL,
  `kategori` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kategori`
--

INSERT INTO `tb_kategori` (`id_kategori`, `kategori`) VALUES
(1, 'Aksesoris'),
(2, 'T-Shirt'),
(3, 'Kemeja'),
(4, 'Jilbab'),
(5, 'Mukena'),
(12, 'kategori baru');

-- --------------------------------------------------------

--
-- Table structure for table `tb_konfirmasi`
--

CREATE TABLE `tb_konfirmasi` (
  `id_konfirmasi` int(10) NOT NULL,
  `id_pemesanan` int(10) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `bukti_pembayaran` varchar(30) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_konfirmasi`
--

INSERT INTO `tb_konfirmasi` (`id_konfirmasi`, `id_pemesanan`, `tanggal`, `bukti_pembayaran`, `status`) VALUES
(1, 1, '2019-06-15', '1024x7681.jpg', '1'),
(2, 2, '2019-06-15', '2000_2d1j_small.jpg', '0'),
(3, 3, '2019-06-16', '2000_2d2_small1.jpg', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tb_ongkir`
--

CREATE TABLE `tb_ongkir` (
  `id_ongkir` int(10) NOT NULL,
  `provinsi` varchar(30) DEFAULT NULL,
  `kabupaten` varchar(30) DEFAULT NULL,
  `kota` varchar(30) DEFAULT NULL,
  `biaya` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_ongkir`
--

INSERT INTO `tb_ongkir` (`id_ongkir`, `provinsi`, `kabupaten`, `kota`, `biaya`) VALUES
(1, 'DI YOGYAKARTA', 'kotagede', 'kotagede', 15000),
(2, 'DI YOGYAKARTA', 'Kota Yogyakarta', 'Kota Yogyakarta', 10000),
(3, 'Jawa Tengah', 'Kebumen', 'Kebumen', 20000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pelanggan`
--

CREATE TABLE `tb_pelanggan` (
  `id_pelanggan` int(10) NOT NULL,
  `username` varchar(16) DEFAULT NULL,
  `password` varchar(16) DEFAULT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `no_handphone` char(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pelanggan`
--

INSERT INTO `tb_pelanggan` (`id_pelanggan`, `username`, `password`, `nama`, `alamat`, `no_handphone`) VALUES
(1, 'pelanggan', 'pelanggan', 'pelanggan', 'jogja', '08123456789'),
(2, 'pelanggandua', 'pelanggandua', 'Pelanggan Dua', 'Alamat Pelanggan Dua', '+8347872364');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pemesanan`
--

CREATE TABLE `tb_pemesanan` (
  `id_pemesanan` int(10) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `id_pelanggan` int(10) DEFAULT NULL,
  `kode_unik` int(5) DEFAULT NULL,
  `biaya_ongkir` int(11) DEFAULT NULL,
  `komentar_pesanan` text,
  `alamat_pengiriman` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pemesanan`
--

INSERT INTO `tb_pemesanan` (`id_pemesanan`, `tanggal`, `id_pelanggan`, `kode_unik`, `biaya_ongkir`, `komentar_pesanan`, `alamat_pengiriman`) VALUES
(1, '2019-06-15', 1, 827, 10000, '', 'jogja (Kota Yogyakarta,Kota Yogyakarta,DI YOGYAKARTA)'),
(2, '2019-06-15', 2, 789, 20000, 'test comment', 'rt rw no rumah jalan (Kebumen,Kebumen,Jawa Tengah)'),
(3, '2019-06-16', 1, 731, 15000, '', 'jogja (kotagede,kotagede,DI YOGYAKARTA)');

-- --------------------------------------------------------

--
-- Table structure for table `tb_produk`
--

CREATE TABLE `tb_produk` (
  `id_produk` int(10) NOT NULL,
  `nama_produk` varchar(100) DEFAULT NULL,
  `deskripsi` text,
  `id_kategori` int(11) DEFAULT NULL,
  `id_supplier` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `gambar` varchar(50) DEFAULT NULL,
  `berat` smallint(6) DEFAULT NULL,
  `ukuran` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_produk`
--

INSERT INTO `tb_produk` (`id_produk`, `nama_produk`, `deskripsi`, `id_kategori`, `id_supplier`, `harga`, `stok`, `gambar`, `berat`, `ukuran`) VALUES
(4, 'Produk Satu Aksesoris', '<p>\r\n\r\n</p><h2>Why do we use it?</h2><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<br><p></p>', 1, 2, 100000, 9, '768x768.png', 500, NULL),
(5, 'Produk Dua Aksesoris', '<p>\r\n\r\n</p><h2>Why do we use it?</h2><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<br><p></p>', 1, 2, 150000, 20, '768x7681.png', 600, NULL),
(6, 'Produk Tiga Aksesoris', '<p>\r\n\r\n</p><h2>Why do we use it?</h2><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<br><p></p>', 1, 2, 120000, 30, '768x7682.png', 700, NULL),
(7, 'Produk Satu T-Shirt', '<p>\r\n\r\n</p><h2>Why do we use it?</h2><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<br><p></p>', 2, 2, 200000, 10, '768x7683.png', 400, NULL),
(8, 'Produk Dua T-Shirt', '<p>\r\n\r\n</p><h2>Why do we use it?</h2><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<br><p></p>', 2, 2, 175000, 20, '768x7684.png', 300, NULL),
(9, 'Produk Tiga T-Shirt', '<p>\r\n\r\n</p><h2>Why do we use it?</h2><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<br><p></p>', 2, 2, 150000, 30, '768x7685.png', 250, NULL),
(10, 'Produk Satu Kemeja', '<p>\r\n\r\n</p><h2>Why do we use it?</h2><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<br><p></p>', 3, 2, 250000, 9, '768x7686.png', 500, NULL),
(11, 'Produk Tiga Kemeja', '<p>\r\n\r\n</p><h2>Why do we use it?</h2><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<br><p></p>', 3, 2, 75000, 30, '768x7687.png', 250, NULL),
(12, 'Produk Dua Kemeja', '<p>\r\n\r\n</p><h2>Why do we use it?</h2><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<br><p></p>', 3, 2, 175000, 18, '768x7688.png', 750, NULL),
(13, 'Produk Satu Jilbab', '<p>\r\n\r\n</p><h2>Why do we use it?</h2><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<br><p></p>', 4, 2, 10000, 10, '768x7689.png', 1000, NULL),
(14, 'Produk Dua Jilbab', '<p>\r\n\r\n</p><h2>Why do we use it?</h2><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<br><p></p>', 4, 2, 20000, 0, '768x76810.png', 710, NULL),
(15, 'Produk Tiga Jilbab', '<p>\r\n\r\n</p><h2>Why do we use it?</h2><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<br><p></p>', 4, 2, 30000, 5, '768x76811.png', 500, '[\"S\"]');

-- --------------------------------------------------------

--
-- Table structure for table `tb_supplier`
--

CREATE TABLE `tb_supplier` (
  `id_supplier` int(10) NOT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `no_telp` char(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_supplier`
--

INSERT INTO `tb_supplier` (`id_supplier`, `nama`, `alamat`, `no_telp`) VALUES
(2, 'Supplier Satu', 'Babadan, Gedongkuning, Yogyakarta', '+62812253068'),
(3, 'Supplier Dua', 'Babadan, Gedongkuning, Yogyakarta', '+62812253068'),
(4, 'Supplier Tiga', 'Babadan, Gedongkuning, Yogyakarta', '+62812253068');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `det_pemesanan`
--
ALTER TABLE `det_pemesanan`
  ADD PRIMARY KEY (`id_det_pemesanan`);

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tb_konfirmasi`
--
ALTER TABLE `tb_konfirmasi`
  ADD PRIMARY KEY (`id_konfirmasi`);

--
-- Indexes for table `tb_ongkir`
--
ALTER TABLE `tb_ongkir`
  ADD PRIMARY KEY (`id_ongkir`);

--
-- Indexes for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `tb_pemesanan`
--
ALTER TABLE `tb_pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`);

--
-- Indexes for table `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `tb_supplier`
--
ALTER TABLE `tb_supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `det_pemesanan`
--
ALTER TABLE `det_pemesanan`
  MODIFY `id_det_pemesanan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_konfirmasi`
--
ALTER TABLE `tb_konfirmasi`
  MODIFY `id_konfirmasi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_ongkir`
--
ALTER TABLE `tb_ongkir`
  MODIFY `id_ongkir` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  MODIFY `id_pelanggan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_pemesanan`
--
ALTER TABLE `tb_pemesanan`
  MODIFY `id_pemesanan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_produk`
--
ALTER TABLE `tb_produk`
  MODIFY `id_produk` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tb_supplier`
--
ALTER TABLE `tb_supplier`
  MODIFY `id_supplier` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

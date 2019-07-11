-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2019 at 05:36 PM
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
  `gambar` varchar(255) DEFAULT NULL,
  `ukuran` char(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `det_pemesanan`
--

INSERT INTO `det_pemesanan` (`id_det_pemesanan`, `id_pemesanan`, `nama_produk`, `kategori`, `harga`, `berat`, `jumlah`, `gambar`, `ukuran`) VALUES
(1, 1, 'Produk Dua Kemeja', 'Kemeja', 175000, 750, 1, '768x7688.png', 'S'),
(2, 1, 'Produk Satu Jilbab', 'Jilbab', 10000, 1000, 1, '768x7689.png', NULL),
(3, 2, 'Produk Dua T-Shirt', 'T-Shirt', 175000, 300, 1, '768x7684.png', NULL),
(4, 2, 'Produk Satu Jilbab', 'Jilbab', 10000, 1000, 1, '768x7689.png', NULL),
(5, 3, 'Produk Satu Kemeja', 'Kemeja', 250000, 500, 1, '768x7686.png', NULL),
(6, 3, 'Produk Satu Aksesoris', 'Aksesoris', 100000, 500, 1, '768x768.png', NULL);

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
-- Table structure for table `tb_alamat`
--

CREATE TABLE `tb_alamat` (
  `id` int(11) NOT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `id_provinsi` int(3) DEFAULT NULL,
  `nama_provinsi` varchar(128) DEFAULT NULL,
  `id_kota` int(3) DEFAULT NULL,
  `nama_kota` varchar(128) DEFAULT NULL,
  `alamat_sebagai` varchar(128) DEFAULT NULL,
  `nama_penerima` varchar(128) DEFAULT NULL,
  `no_telepon` char(15) DEFAULT NULL,
  `kode_pos` char(9) DEFAULT NULL,
  `alamat_lengkap` text,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_alamat`
--

INSERT INTO `tb_alamat` (`id`, `id_pelanggan`, `id_provinsi`, `nama_provinsi`, `id_kota`, `nama_kota`, `alamat_sebagai`, `nama_penerima`, `no_telepon`, `kode_pos`, `alamat_lengkap`, `status`) VALUES
(1, 1, 6, 'DKI Jakarta', 154, 'Jakarta Timur', 'Teman', 'Mat Sanip bin Umar Juned', '08122530688', '13120', 'Apartemen Ula Ilu Tower Melati Lantai 8 No.44\r\nJl. Kacang Kapri Muda Kav. 13\r\nUtan Kayu Selatan, Matraman.', 0),
(2, 1, 6, 'DKI Jakarta', 151, 'Jakarta Barat', 'Rumah', 'Udin Komarudin', '08122530688', '11510', 'Perumahan Griya Mandala, Jl. Kehormatan Blok A No.19 Rt.002 Rw.08\r\nDuri Kepa, Kebon Jeruk', 1);

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
(1, 1, '2019-07-07', '2000_2d1j_small.jpg', '1'),
(2, 2, '2019-07-08', '2000_2d2_small1.jpg', '1'),
(3, 3, '2019-07-11', '2000_2d1j_small1.jpg', '0');

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
(1, 'pelanggan', 'pelanggan', 'Pelanggan Satu', 'jogja', '628123456789'),
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
  `kurir` varchar(225) DEFAULT NULL,
  `no_resi` char(32) DEFAULT NULL,
  `alamat_pengiriman` text,
  `status_pemesanan` tinyint(1) DEFAULT NULL,
  `tanggal_terima` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pemesanan`
--

INSERT INTO `tb_pemesanan` (`id_pemesanan`, `tanggal`, `id_pelanggan`, `kode_unik`, `biaya_ongkir`, `komentar_pesanan`, `kurir`, `no_resi`, `alamat_pengiriman`, `status_pemesanan`, `tanggal_terima`) VALUES
(1, '2019-07-07', 1, 468, 26000, '', 'JNE OKE (3-4 HARI)', 'BKIG300163107114', 'Udin Komarudin<br>\n                  \n                      Perumahan Griya Mandala, Jl. Kehormatan Blok A No.19 Rt.002 Rw.08\nDuri Kepa, Kebon Jeruk<br>\n                      Kota/Kab. Jakarta Barat Provinsi. DKI Jakarta, 11510<br>\n                      Indonesia<br>\n                      Telepon/Handphone:&nbsp;08122530688\n                                    ', 1, '2019-07-11'),
(2, '2019-07-08', 1, 447, 16000, 'sing penting tekan bos', 'JNE REG (2-3 HARI)', NULL, 'Mat Sanip bin Umar Juned<br>\n                                Apartemen Ula Ilu Tower Melati Lantai 8 No.44\nJl. Kacang Kapri Muda Kav. 13\nUtan Kayu Selatan, Matraman.<br>\n                                Kota/Kab. Jakarta Timur Provinsi. DKI Jakarta, 13120<br>\n                                Indonesia<br>\n                                Telepon/Handphone:&nbsp;08122530688\n                                ', NULL, NULL),
(3, '2019-07-11', 1, 112, 12000, '', 'TIKI ECO (4 HARI)', NULL, 'Udin Komarudin<br>\n                  \n                          Perumahan Griya Mandala, Jl. Kehormatan Blok A No.19 Rt.002 Rw.08\nDuri Kepa, Kebon Jeruk<br>\n                          Kota/Kab. Jakarta Barat Provinsi. DKI Jakarta, 11510<br>\n                          Indonesia<br>\n                          Telepon/Handphone:&nbsp;08122530688\n                                        ', NULL, NULL);

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
(4, 'Produk Satu Aksesoris', '<p>\r\n\r\n</p><h2>Why do we use it?</h2><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<br><p></p>', 1, 2, 100000, 8, '768x768.png', 500, NULL),
(5, 'Produk Dua Aksesoris', '<p>\r\n\r\n</p><h2>Why do we use it?</h2><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<br><p></p>', 1, 2, 150000, 20, '768x7681.png', 600, NULL),
(6, 'Produk Tiga Aksesoris', '<p>\r\n\r\n</p><h2>Why do we use it?</h2><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<br><p></p>', 1, 2, 120000, 30, '768x7682.png', 700, NULL),
(7, 'Produk Satu T-Shirt', '<p>\r\n\r\n</p><h2>Why do we use it?</h2><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<br><p></p>', 2, 2, 200000, 10, '768x7683.png', 400, NULL),
(8, 'Produk Dua T-Shirt', '<p>\r\n\r\n</p><h2>Why do we use it?</h2><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<br><p></p>', 2, 2, 175000, 19, '768x7684.png', 300, NULL),
(9, 'Produk Tiga T-Shirt', '<p>\r\n\r\n</p><h2>Why do we use it?</h2><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<br><p></p>', 2, 2, 150000, 30, '768x7685.png', 250, NULL),
(10, 'Produk Satu Kemeja', '<p>\r\n\r\n</p><h2>Why do we use it?</h2><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<br><p></p>', 3, 2, 250000, 8, '768x7686.png', 500, NULL),
(11, 'Produk Tiga Kemeja', '<p>\r\n\r\n</p><h2>Why do we use it?</h2><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<br><p></p>', 3, 2, 75000, 30, '768x7687.png', 250, NULL),
(12, 'Produk Dua Kemeja', '<p>\r\n\r\n</p><h2>Why do we use it?</h2><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<br><p></p>', 3, 2, 175000, 17, '768x7688.png', 750, '[\"S\",\"M\",\"L\",\"XL\"]'),
(13, 'Produk Satu Jilbab', '<p>\r\n\r\n</p><h2>Why do we use it?</h2><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<br><p></p>', 4, 2, 10000, 8, '768x7689.png', 1000, NULL),
(14, 'Produk Dua Jilbab', '<p>\r\n\r\n</p><h2>Why do we use it?</h2><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<br><p></p>', 4, 2, 20000, 0, '768x76810.png', 710, NULL),
(15, 'Produk Tiga Jilbab', '<p>\r\n\r\n</p><h2>Why do we use it?</h2><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<br><p></p>', 4, 2, 30000, 5, '768x76811.png', 500, '[\"S\",\"M\",\"L\"]');

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
-- Indexes for table `tb_alamat`
--
ALTER TABLE `tb_alamat`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `tb_alamat`
--
ALTER TABLE `tb_alamat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id_produk` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_supplier`
--
ALTER TABLE `tb_supplier`
  MODIFY `id_supplier` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

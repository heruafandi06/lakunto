-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 25 Jun 2016 pada 07.38
-- Versi Server: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `handphone`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `username` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `nama` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`username`, `password`, `nama`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
('aa', '4124bc0a9335c27f086f24ba207a4912', 'aa'),
('user', 'd41d8cd98f00b204e9800998ecf8427e', 'mimin'),
('admin', '079030899614f6e7b480243a436fcfa6', 'admin'),
('irvan', 'd41d8cd98f00b204e9800998ecf8427e', 'syachrudin'),
('admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
('cage', '9f1f78a320748365cb6994db2bc970bb', 'cage');

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama_customer` varchar(30) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `customer`
--

INSERT INTO `customer` (`username`, `password`, `nama_customer`) VALUES
('heru', '202cb962ac59075b964b07152d234b70', 'heru afandi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail`
--

CREATE TABLE IF NOT EXISTS `detail` (
  `id_detail` varchar(10) NOT NULL,
  `id_produk` varchar(10) NOT NULL,
  `layar` varchar(70) NOT NULL,
  `memori` varchar(30) NOT NULL,
  `ram` varchar(10) NOT NULL,
  `internet` varchar(35) NOT NULL,
  `os` varchar(45) NOT NULL,
  `cpu` varchar(50) NOT NULL,
  `kd` varchar(10) NOT NULL,
  `kb` varchar(10) NOT NULL,
  `baterai` varchar(30) NOT NULL,
  PRIMARY KEY (`id_detail`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail`
--

INSERT INTO `detail` (`id_detail`, `id_produk`, `layar`, `memori`, `ram`, `internet`, `os`, `cpu`, `kd`, `kb`, `baterai`) VALUES
('01', '01', '720 x 1280 pixels, 5.0 inches (~294 ppi pixel density)', '16 GB', '1 GB RAM D', 'HSPA+', 'Android OS, v4.2.1 (Jelly Bean)', 'MediaTek MT6582, Quad-core 1.3 GHz', '5 MP', '8 MP', 'Li-Ion 2410 mAh battery '),
('02', '02', '480 x 854 pixels, 4.5 inches (~218 ppi pixel density)', '4 GB, microSD, up to 32 GB', '512 MB RAM', 'HSDPA, 21 Mbps; HSUPA, 5.76 Mbps', 'Android OS, v4.2.2 (Jelly Bean)', 'MTK 6572, Dual-core 1.3 GHz', 'VGA', '5 MP', 'Li-Po 2000 mAh battery'),
('03', '03', '6 inch QHD IPS 540 x 960 pixels', '16 GB, microSD, up to 32 GB', '1 GB', 'HSDPA', 'Android 4.2 Jelly Bean', 'Quad Core 1.3 GHz', '3 MP', '13 MP', 'Poly-lith 2400 mAh'),
('04', '04', '4.0-inch, 480 x 800 pixels (WVGA), (233.2 ppi pixel density)', '4 GB, microSD, up to 32 GB', '512 MB RAM', 'HSDPA, 7.2 Mbps; HSUPA, 5.76 Mbps', 'Android OS, v4.2.2 (Jelly Bean)', 'dual-core 1.2 GHz ARM Cortex-A7 CPU', '0.3 MP', '3.2 MP', 'Li-Ion 1700 mAh'),
('05', '05', '720 x 1280 pixels, 5.0 inches (~294 ppi pixel density)', 'Internal 8 GB, microSD, up to ', '1 GB RAM', 'HSDPA, HSUPA', 'Android OS, v4.2 (Jelly Bean)', 'Mediatek MT6582, Quad-core 1.3 GHz Cortex-A7', '1.6 MP', '8 MP', 'Li-Ion 2250 mAh battery');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `id_kategori` varchar(10) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `url` varchar(100) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama`, `url`) VALUES
('01', 'Oppo', '?kategori=Oppo'),
('02', 'Lenovo', '?kategori=Lenovo'),
('03', 'Evercoss', '?kategori=Evercoss');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE IF NOT EXISTS `keranjang` (
  `username` varchar(30) NOT NULL,
  `id_produk` varchar(30) NOT NULL,
  `jumlah` tinyint(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan`
--

CREATE TABLE IF NOT EXISTS `pemesanan` (
  `id_pemesanan` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `tanggal` datetime NOT NULL,
  `kota` varchar(100) NOT NULL,
  `alamat_pengiriman` varchar(100) NOT NULL,
  `kode_pos` int(11) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT '0',
  `tanggal_konfirmasi` varchar(20) NOT NULL,
  `bank` varchar(100) NOT NULL,
  `nama_pengirim` varchar(100) NOT NULL,
  `jumlah_konfirmasi` double NOT NULL,
  PRIMARY KEY (`id_pemesanan`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan_detail`
--

CREATE TABLE IF NOT EXISTS `pemesanan_detail` (
  `id_pemesanan` varchar(20) NOT NULL,
  `id_produk` varchar(20) NOT NULL,
  `jumlah` tinyint(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pemesanan_detail`
--

INSERT INTO `pemesanan_detail` (`id_pemesanan`, `id_produk`, `jumlah`) VALUES
('20160624040909', '05', 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE IF NOT EXISTS `produk` (
  `id_produk` varchar(20) NOT NULL,
  `nama` varchar(120) NOT NULL,
  `gambar` varchar(200) NOT NULL,
  `harga` int(70) NOT NULL,
  `tanggal` datetime NOT NULL,
  `kategori` varchar(30) NOT NULL,
  `stok` tinyint(4) NOT NULL,
  `deskripsi` text NOT NULL,
  PRIMARY KEY (`id_produk`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `nama`, `gambar`, `harga`, `tanggal`, `kategori`, `stok`, `deskripsi`) VALUES
('01', 'Oppo R1', 'images/R1_kecil.jpg', 350000, '2016-06-20 00:00:00', 'Oppo', 21, '...'),
('02', 'Lenovo A516', 'images/LA516_kecil.jpg', 1500000, '2016-06-21 00:00:00', 'Lenovo', 10, '...'),
('03', 'Evercoss A66s', 'images/A66s_kecil.jpg', 2500000, '2016-06-22 00:00:00', 'Evercoss', 50, '...'),
('04', 'Oppo Find Muse', 'images/r831_kecil.jpg', 1700000, '2016-06-23 00:00:00', 'Oppo', 12, '...'),
('05', 'Lenovo A859', 'images/LA859_kecil.jpg', 2500000, '2016-06-24 00:00:00', 'Lenovo', 5, '...');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE IF NOT EXISTS `tb_admin` (
  `username` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `nama` varchar(20) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`username`, `password`, `nama`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'heru');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

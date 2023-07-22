-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 11, 2021 at 09:53 AM
-- Server version: 10.3.32-MariaDB-log-cll-lve
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kincaise_kincaipayment`
--

-- --------------------------------------------------------

--
-- Table structure for table `aktifitas`
--

CREATE TABLE `aktifitas` (
  `id` int(4) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `aksi` enum('Masuk','Keluar') NOT NULL,
  `ip` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aktifitas`
--

INSERT INTO `aktifitas` (`id`, `username`, `aksi`, `ip`, `date`, `time`) VALUES
(122, 'kincaipayment', 'Masuk', '182.3.71.56', '2021-09-15', '19:26:53'),
(123, 'kincaipayment', 'Keluar', '182.3.71.56', '2021-09-15', '19:30:05'),
(124, 'kincaipayment', 'Masuk', '182.3.71.56', '2021-09-15', '19:30:44'),
(125, 'kincaipayment', 'Masuk', '182.3.73.165', '2021-09-27', '02:46:42'),
(126, 'kincaipayment', 'Masuk', '182.3.70.87', '2021-09-28', '16:22:53'),
(127, 'kincaipayment', 'Masuk', '182.1.231.162', '2021-10-13', '05:01:09'),
(128, 'kincaipayment', 'Masuk', '182.3.70.136', '2021-11-30', '21:07:16'),
(129, 'kincaipayment', 'Keluar', '182.3.70.136', '2021-11-30', '21:07:27'),
(130, 'kincaipayment', 'Masuk', '182.3.70.136', '2021-11-30', '22:09:25'),
(131, 'kincaipayment', 'Masuk', '182.3.71.253', '2021-12-01', '22:02:09'),
(132, 'kincaipayment', 'Masuk', '182.3.71.48', '2021-12-11', '09:27:33');

-- --------------------------------------------------------

--
-- Table structure for table `bca`
--

CREATE TABLE `bca` (
  `id` varchar(10) NOT NULL,
  `user_id` varchar(25) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id` int(10) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `icon` enum('PESANAN','LAYANAN','DEPOSIT','PENGGUNA','PROMO') COLLATE utf8_swedish_ci NOT NULL,
  `title` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `tipe` enum('INFO','PERINGATAN','PENTING') COLLATE utf8_swedish_ci NOT NULL,
  `konten` text COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cek_akun`
--

CREATE TABLE `cek_akun` (
  `id` int(10) NOT NULL,
  `saldo` double NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `tipe` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `provider` varchar(50) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deposit`
--

CREATE TABLE `deposit` (
  `id` int(10) NOT NULL,
  `kode_deposit` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `tipe` varchar(255) NOT NULL,
  `provider` varchar(255) NOT NULL,
  `pengirim` varchar(250) NOT NULL,
  `penerima` varchar(100) NOT NULL,
  `catatan` text NOT NULL,
  `jumlah_transfer` int(255) NOT NULL,
  `get_saldo` varchar(250) NOT NULL,
  `metode_isi_saldo` varchar(25) NOT NULL,
  `status` enum('Success','Pending','Error') NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deposit`
--

INSERT INTO `deposit` (`id`, `kode_deposit`, `username`, `tipe`, `provider`, `pengirim`, `penerima`, `catatan`, `jumlah_transfer`, `get_saldo`, `metode_isi_saldo`, `status`, `date`, `time`) VALUES
(2, '922652', 'kincaipayment', 'Transfer Bank', 'BCA', 'Adi Gunawan', '3120760989 A/n Adi Gunawan', 'Transfer Sesui nominal 400.713', 400713, '400713', 'saldo_top_up', 'Success', '2021-09-16', '01:58:30'),
(3, '905125', 'kincaipayment', 'Transfer Pulsa', 'TELKOMSEL', '085381259307', '085381258307 A/n Telkomsel', 'Transfer Sesui nominal 42.500', 50000, '42500', 'saldo_top_up', 'Error', '2021-09-16', '02:07:20');

-- --------------------------------------------------------

--
-- Table structure for table `harga_kode_undangan`
--

CREATE TABLE `harga_kode_undangan` (
  `id` int(2) NOT NULL,
  `level` varchar(50) NOT NULL,
  `harga` double NOT NULL,
  `saldo_sosmed` double NOT NULL,
  `saldo_top_up` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `harga_kode_undangan`
--

INSERT INTO `harga_kode_undangan` (`id`, `level`, `harga`, `saldo_sosmed`, `saldo_top_up`) VALUES
(1, 'Member', 10000, 1000, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `kategori_layanan`
--

CREATE TABLE `kategori_layanan` (
  `id` int(10) NOT NULL,
  `nama` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `kode` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `tipe` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `server` varchar(50) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ketentuan_layanan`
--

CREATE TABLE `ketentuan_layanan` (
  `id` int(2) NOT NULL,
  `nomer` varchar(50) NOT NULL,
  `tipe` varchar(25) NOT NULL,
  `konten` text NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ketentuan_layanan`
--

INSERT INTO `ketentuan_layanan` (`id`, `nomer`, `tipe`, `konten`, `date`, `time`) VALUES
(1, '1', 'Umum', 'Dengan Mendaftar Dan Menggunakan Layanan Kincai Payment, Anda Secara Otomatis Menyetujui Semua Ketentuan Layanan Kami. Kami Berhak Mengubah Ketentuan Layanan Ini Tanpa Pemberitahuan Terlebih Dahulu. Anda Diharapkan Membaca Semua Ketentuan Layanan Kami Sebelum Membuat Pesanan.', '2021-09-16', '01:40:07'),
(2, '2', 'Umum', 'Kincai Payment Tidak Akan Bertanggung Jawab Jika Anda Mengalami Kerugian Dalam Bisnis Anda.', '2021-09-16', '01:39:57'),
(3, '3', 'Umum', 'Kincai Payment Tidak Bertanggung Jawab Jika Anda Mengalami Nonaktif Akun Atau Penghapusan Kiriman Yang Dilakukan Oleh Instagram, Twitter, Facebook, Youtube, Dan Lain-Lain.', '2021-09-16', '01:39:49'),
(4, '1', 'Layanan', 'Kincai Payment Hanya Digunakan Untuk Media Promosi Sosial Media, Pulsa PPOB, Voucher Game Dan Membantu Meningkatkan Penampilan Akun Anda Saja.', '2021-09-16', '01:39:42'),
(5, '2', 'Layanan', 'Kincai Payment Tidak Menjamin Pengikut Baru Anda Berinteraksi Dengan Anda, Kami Hanya Menjamin Bahwa Anda Mendapat Pengikut Yang Anda Beli. \r\nDan Kincai Payment tidak bertanggung jawab atas berkurangnya pengikut yang anda beli, tidak semua yang anda beli akan permanen tetapi tergantung bagaimana cara anda membelinya.', '2021-09-16', '01:39:36'),
(6, '3', 'Layanan', 'Kincai Payment Tidak Menerima Permintaan, Pembatalan, & Pengembalian Dana Setelah Pesanan Masuk Ke Sistem Kami. Kami Memberikan Pengembalian Dana Yang Sesuai Jika Pesanan Tidak Dapat Diselesaikan.', '2021-09-16', '01:39:21'),
(7, '4', 'Layanan', 'Kincai Payment Berhak Mensuspend Akun Anda, Apabila Akun Tersebut Di Perjual Belikan Dan Tanpa Pemberian Pengembalian Dana Dari Pihak Kincai Payment', '2021-09-16', '01:39:14');

-- --------------------------------------------------------

--
-- Table structure for table `kode_undangan`
--

CREATE TABLE `kode_undangan` (
  `id` int(10) NOT NULL,
  `level` enum('Member') COLLATE utf8_swedish_ci NOT NULL,
  `uplink` varchar(200) COLLATE utf8_swedish_ci NOT NULL,
  `kode` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `saldo_sosmed` int(10) NOT NULL,
  `saldo_top_up` int(10) NOT NULL,
  `status` enum('Belum Dipakai','Sudah Dipakai') COLLATE utf8_swedish_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kontak_admin`
--

CREATE TABLE `kontak_admin` (
  `id` int(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jabatan` text NOT NULL,
  `deskripsi` text NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `jam_kerja` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_hp` varchar(25) NOT NULL,
  `link_fb` varchar(100) NOT NULL,
  `link_ig` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kontak_admin`
--

INSERT INTO `kontak_admin` (`id`, `nama`, `jabatan`, `deskripsi`, `lokasi`, `jam_kerja`, `email`, `no_hp`, `link_fb`, `link_ig`) VALUES
(1, 'MC Project', 'Developers', 'Toko produk digital dan jasa freelance di Indonesia. Berfokus pada pengembangan, produksi dan pendistribusian karya desain, artikel, script pemrograman, source code, software aplikasi, tools, plugin, tema, dan template.', '401XD Group, Jl. Sumbawa, Ulak Karang', '14.00 - 02.00 WIB', 'mycoding@401xd.com', '082377823390', 'https://www.facebook.com/mycodingxd', 'https://www.instagram.com/mycodingxd');

-- --------------------------------------------------------

--
-- Table structure for table `kontak_website`
--

CREATE TABLE `kontak_website` (
  `id` int(11) NOT NULL,
  `logo` text NOT NULL,
  `link_fb` varchar(100) NOT NULL,
  `link_ig` varchar(100) NOT NULL,
  `no_wa` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `kode_pos` int(11) NOT NULL,
  `jam_kerja` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kontak_website`
--

INSERT INTO `kontak_website` (`id`, `logo`, `link_fb`, `link_ig`, `no_wa`, `email`, `alamat`, `kode_pos`, `jam_kerja`) VALUES
(1, 'RAP', 'https://www.facebook.com/KincaiMedia', 'https://www.instagram.com/kincaimedia', '6282377823390', 'support@kincaimedia.net', 'Kincai Media, Jl. Stadion Pancasila, Koto Panap, Tanah Kampung, Sungai Penuh, Jambi', 37111, '12:00 - 00:00 WIB');

-- --------------------------------------------------------

--
-- Table structure for table `layanan_pascabayar`
--

CREATE TABLE `layanan_pascabayar` (
  `id` int(10) NOT NULL,
  `service_id` varchar(25) COLLATE utf8_swedish_ci NOT NULL,
  `provider_id` varchar(25) COLLATE utf8_swedish_ci NOT NULL,
  `kategori` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `layanan` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `status` enum('Normal','Gangguan') COLLATE utf8_swedish_ci NOT NULL,
  `provider` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `tipe` varchar(25) COLLATE utf8_swedish_ci NOT NULL,
  `server` varchar(25) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `layanan_pulsa`
--

CREATE TABLE `layanan_pulsa` (
  `id` int(10) NOT NULL,
  `service_id` varchar(10) COLLATE utf8_swedish_ci NOT NULL,
  `provider_id` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `operator` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `layanan` text COLLATE utf8_swedish_ci NOT NULL,
  `deskripsi` text COLLATE utf8_swedish_ci NOT NULL,
  `harga` double NOT NULL,
  `harga_api` double NOT NULL,
  `status` enum('Normal','Gangguan') COLLATE utf8_swedish_ci NOT NULL,
  `provider` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `tipe` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `server` varchar(25) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `layanan_sosmed`
--

CREATE TABLE `layanan_sosmed` (
  `id` int(10) NOT NULL,
  `service_id` int(10) NOT NULL,
  `kategori` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `layanan` text COLLATE utf8_swedish_ci NOT NULL,
  `catatan` text COLLATE utf8_swedish_ci NOT NULL,
  `min` int(10) NOT NULL,
  `max` int(10) NOT NULL,
  `harga` double NOT NULL,
  `harga_api` double NOT NULL,
  `status` enum('Aktif','Tidak Aktif') COLLATE utf8_swedish_ci NOT NULL,
  `provider_id` int(10) NOT NULL,
  `provider` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `tipe` varchar(50) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `metode_depo`
--

CREATE TABLE `metode_depo` (
  `id` int(255) NOT NULL,
  `provider` varchar(255) NOT NULL,
  `catatan` text NOT NULL,
  `rate` varchar(255) NOT NULL,
  `nama_penerima` varchar(100) NOT NULL,
  `tujuan` varchar(250) NOT NULL,
  `tipe` enum('Transfer Pulsa','Transfer Bank') NOT NULL,
  `minimal` int(10) NOT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `metode_depo`
--

INSERT INTO `metode_depo` (`id`, `provider`, `catatan`, `rate`, `nama_penerima`, `tujuan`, `tipe`, `minimal`, `status`) VALUES
(1, 'BCA', 'Transfer Sesui nominal', '1', 'A/n Adi Gunawan', '3120760989', 'Transfer Bank', 100000, 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `mutasi`
--

CREATE TABLE `mutasi` (
  `id` int(11) NOT NULL,
  `kode_deposit` varchar(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `tipe` varchar(50) NOT NULL,
  `provider` varchar(50) NOT NULL,
  `jumlah` int(255) NOT NULL,
  `saldo` varchar(250) NOT NULL,
  `status` enum('READ','UNREAD') NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mutasi_bank`
--

CREATE TABLE `mutasi_bank` (
  `id` int(11) NOT NULL,
  `tipe` varchar(10) NOT NULL,
  `keterangan` text NOT NULL,
  `jumlah` double NOT NULL,
  `tanggal` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_pascabayar`
--

CREATE TABLE `pembelian_pascabayar` (
  `id` int(10) NOT NULL,
  `oid` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `provider_oid` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `id_layanan` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `user` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `kategori` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `layanan` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `harga` double NOT NULL,
  `profit` double NOT NULL,
  `koin` double NOT NULL,
  `target` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `nama_penerima` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `deskripsi1` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `deskripsi2` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `deskripsi3` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `deskripsi4` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `status` enum('Pending','Error','Success') COLLATE utf8_swedish_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `place_from` varchar(50) COLLATE utf8_swedish_ci NOT NULL DEFAULT 'WEB',
  `provider` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `refund` enum('0','1') COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_pulsa`
--

CREATE TABLE `pembelian_pulsa` (
  `id` int(10) NOT NULL,
  `oid` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `provider_oid` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `user` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `layanan` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `harga` double NOT NULL,
  `profit` double NOT NULL,
  `koin` double NOT NULL,
  `target` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `status` enum('Pending','Error','Success') COLLATE utf8_swedish_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `place_from` varchar(50) COLLATE utf8_swedish_ci NOT NULL DEFAULT 'WEB',
  `provider` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `refund` enum('0','1') COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_sosmed`
--

CREATE TABLE `pembelian_sosmed` (
  `id` int(10) NOT NULL,
  `oid` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `provider_oid` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `user` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `layanan` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `target` text COLLATE utf8_swedish_ci NOT NULL,
  `jumlah` int(10) NOT NULL,
  `remains` varchar(10) COLLATE utf8_swedish_ci NOT NULL,
  `start_count` varchar(10) COLLATE utf8_swedish_ci NOT NULL,
  `harga` double NOT NULL,
  `profit` double NOT NULL,
  `koin` double NOT NULL,
  `status` enum('Pending','Processing','Error','Partial','Success') COLLATE utf8_swedish_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `provider` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `place_from` enum('Website','API') COLLATE utf8_swedish_ci NOT NULL,
  `refund` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pertanyaan_umum`
--

CREATE TABLE `pertanyaan_umum` (
  `id` int(4) NOT NULL,
  `number` varchar(25) NOT NULL,
  `tipe` text NOT NULL,
  `title` text NOT NULL,
  `konten` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pertanyaan_umum`
--

INSERT INTO `pertanyaan_umum` (`id`, `number`, `tipe`, `title`, `konten`) VALUES
(1, 'One', 'Akun', 'Bagaimana Cara Mengubah Data Profil Saya?', 'Klik tombol titik tiga di pojok kanan atas dan silahkan pilih tombol profile'),
(2, 'Two', 'Akun', 'Bagaimana Cara Melihat Aktifitas Akun Saya?', 'Klik tombol titik tiga di pojok kanan atas dan silahkan pilih tombol aktifitas'),
(3, 'Three', 'Akun', 'Bagaimana Jika Akun Saya Digunakan Oleh Orang Lain?', 'Segera hubungi kontak yang sudah di sediakan admin di halaman kontak dan konsultasikan akun anda'),
(4, 'Four', 'Akun', 'Bagaimana Cara Ganti Kata Sandi?', 'Klik tombol titik tiga di pojok kanan atas dan silahkan pilih tombol profile kemudian pilih tombol setrib 3 di pojok kiri atas dan pilih menu ganti kata sandi'),
(5, 'Five', 'Akun', 'Bagaimana Cara Ganti PIN Transaksi?', 'Klik tombol titik tiga di pojok kanan atas dan silahkan pilih tombol profile kemudian pilih tombol setrib 3 di pojok kiri atas dan pilih menu ganti pin'),
(6, 'One', 'Pesanan', 'Bagaimana Cara Melihat Riwayat Pesanan Saya?', 'Klik tombol titik tiga di pojok kanan atas dan silahkan pilih tombol pesanan'),
(7, 'Two', 'Pesanan', 'Bagaimana Cara Pesan Lewat API?', 'Silahkan membuka halaman api documentation karena kami sudah memberikan contohnya'),
(8, 'Three', 'Pesanan', 'Bagaimana Jika Pesanan Saya Berstatus Error Tapi Dana Belum Kembali?', 'Silahkan menghubungi cs bantuan untuk mengkonsultasikan masalah yang anda hadapi'),
(9, 'One', 'Sosial Media', 'Bagaimana Cara Membuat Pesanan Layanan Sosial Media?', 'Silahkan pilih tombol sosial media kemudian isi form berdasarkan pesanan yang anda inginkan'),
(10, 'Two', 'Sosial Media', 'Kategori Apa Saja Yang Di Sediakan Pada Layanan Sosial Media?', 'Kami menyediakan beberapa kategori untuk media sosial terpopuler seperti instagram, facebook, youtube, dll'),
(11, 'Three', 'Sosial Media', 'Bagaimana Cara Melihat Daftar Harga Layanan Sosial Media?', 'Silahkan pergi ke menu daftar harga dan pilih menu sosial media untuk melihat daftar harga sosial media secara lengkap'),
(12, 'Four', 'Sosial Media', 'Status Apa Saja Yang Disediakan Layanan Sosial Media?', 'PENDING : Orderan sedang berada dalam antrian\r\n\r\nPROCESSING : Orderan sedang diproses\r\nSUKSESS : Orderan telah sukses diterima oleh target\r\n\r\nERROR : Orderan gagal diterima oleh target (Saldo refund full)\r\n\r\nPARTIAL : Orderan terkirim sebagian pada target (Saldo refund sebagian)'),
(13, 'Five', 'Sosial Media', 'Bagaimana Jika Status Saya Error/Partial Tetapi Dana Belum Kembali?', 'Pengembalian dana akan dilakukan jika terjadi error saat pemesanan atau partial yang berarti pesanan diproses sebagian dan saldo dikembalikan sebagian'),
(14, 'One', 'Top Up', 'Bagaimana Cara Membuat Pesanan Layanan Top Up?', 'Silahkan pilih layanan top up yang kami sediakan dan isi form pemesanan sesuai petunjuk kami'),
(15, 'Two', 'Top Up', 'Kategori Apa Saja Yang Di Sediakan Pada Layanan Top Up?', 'Kami menyediakan berbagai kategori pada layanan top up seperti pamet data, pulsa, voucher, dll'),
(16, 'Three', 'Top Up', 'Bagaimana Cara Melihat Daftar Harga Layanan Top Up?', 'Silahkan pergi ke menu daftar harga dan pilih menu top up untuk melihat layanan top up'),
(17, 'Four', 'Top Up', 'Status Apa Saja Yang Disediakan Layanan Top Up?', 'PENDING : Orderan sedang berada dalam antrian\r\n\r\nPROCESSING : Orderan sedang diproses\r\nSUKSESS : Orderan telah sukses diterima oleh target\r\n\r\nERROR : Orderan gagal diterima oleh target (Saldo refund full)\r\n\r\nPARTIAL : Orderan terkirim sebagian pada target (Saldo refund sebagian)'),
(18, 'Five', 'Top Up', 'Bagaimana Jika Status Saya Error Tetapi Dana Belum Kembali?', 'Silahkan menghubungi cs bantuan untuk memgkonfirmasi pesanan anda'),
(19, 'One', 'Isi Saldo', 'Bagaimana Cara Isi Saldo?', 'Cari tombol isi saldo pada halaman utama panel'),
(20, 'Two', 'Isi Saldo', 'Tipe Pembayaran Apa Saja Yang Di Sediakan Pada Fitur Isi Saldo?', 'Kami menyediakan 2 metode pembayaran yaitu secara otomatis dan secara manual'),
(21, 'Three', 'Isi Saldo', 'Saya Sudah Transfer Sesuai Invoice Isi Saldo Tetapi Status Pending Terus?', 'Jika dalam waktu 1-2 jam tetap berstatus pending silahkan menghubungi cs bantuan untuk mendapatkan jawaban atas permasalahan anda'),
(22, 'Four', 'Isi Saldo', 'Bagaimana Jika Saya Isi Saldo Via Transfer Bank Namun Tidak Transfer Sesuai 3 Kode Unik?', 'Silahkan menghubungi cs bantuan supaya anda mendapatkan jawaban atas permasalahan yang anda hadapi'),
(23, 'One', 'Koin', 'Bagaimana Cara Mendapatkan Koin?', 'Terus bertransaksi dan undang teman sebanyak mungkin'),
(24, 'Two', 'Koin', 'Apa Saja Yang Disediakan Pada Layanan Koin?', 'Anda bisa saja mendapatkan koin pada saat anda melakukan transaksi atau pada saat anda membagikan referal anda kepada teman anda'),
(25, 'Three', 'Koin', 'Bagaimana Cara Tarik Koin Ke Saldo?', 'Klik tarik koin pada halama utama panel'),
(30, 'One', 'Pengembalian Dana', 'Bagaimana Jika Status Saya Error/Partial Tapi Saldo Belum Kembali?', 'Pengembalian dana akan dilakukan jika terjadi error saat pemesanan atau partial yang berarti pesanan diproses sebagian dan saldo dikembalikan sebagian'),
(31, 'Two', 'Pengembalian Dana', 'Status Saya Error Tapi Saldo Saya Kembali Tidak Sama?', 'Pengembalian dana akan dilakukan jika terjadi error saat pemesanan atau partial yang berarti pesanan diproses sebagian dan saldo dikembalikan sebagian'),
(32, 'One', 'Status', 'Tipe Status Apa Saja Yang Ada?', 'PENDING : Orderan sedang berada dalam antrian\r\n\r\nPROCESSING : Orderan sedang diproses\r\nSUKSESS : Orderan telah sukses diterima oleh target\r\n\r\nERROR : Orderan gagal diterima oleh target (Saldo refund full)\r\n\r\nPARTIAL : Orderan terkirim sebagian pada target (Saldo refund sebagian)'),
(33, 'One', 'API Dokumentasi', 'Apa Itu API Dokumentasi?', 'API (Application program interface) adalah service yang menyediakan data dari server yang di request oleh client yang biasanya dalam format json, API ini adalah bagian yang paling penting dalam sebuah aplikasi Mobile / web frontend. Design API yang jelas akan memudahkan kita dalam mendevelop aplikasi.');

-- --------------------------------------------------------

--
-- Table structure for table `pesan_tiket`
--

CREATE TABLE `pesan_tiket` (
  `id` int(10) NOT NULL,
  `id_tiket` int(10) NOT NULL,
  `pengirim` enum('Member','Admin') COLLATE utf8_swedish_ci NOT NULL,
  `user` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `pesan` text COLLATE utf8_swedish_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `update_terakhir` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pesan_tsel`
--

CREATE TABLE `pesan_tsel` (
  `id` int(11) NOT NULL,
  `isi` varchar(255) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `status` enum('UNREAD','READ') NOT NULL,
  `date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `promo_layanan`
--

CREATE TABLE `promo_layanan` (
  `id` int(10) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `layanan` varchar(100) NOT NULL,
  `harga_normal` int(11) NOT NULL,
  `harga_promo` int(11) NOT NULL,
  `tipe` enum('Sosial Media','Top Up') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `provider`
--

CREATE TABLE `provider` (
  `id` int(10) NOT NULL,
  `code` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `link` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `api_key` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `api_id` varchar(50) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `provider`
--

INSERT INTO `provider` (`id`, `code`, `link`, `api_key`, `api_id`) VALUES
(1, 'MEDANPEDIA', 'https://medanpedia.co.id/api/order', '536497-7f7d71-f61bba-cd8f0c-0f4000', '8919');

-- --------------------------------------------------------

--
-- Table structure for table `provider_pulsa`
--

CREATE TABLE `provider_pulsa` (
  `id` int(10) NOT NULL,
  `code` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `link` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `api_key` varchar(1100) COLLATE utf8_swedish_ci NOT NULL,
  `api_id` varchar(100) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `provider_pulsa`
--

INSERT INTO `provider_pulsa` (`id`, `code`, `link`, `api_key`, `api_id`) VALUES
(3, 'DG-PULSA', 'https://www.atlantic-pedia.co.id/api/pulsa', 'b8ddd005eaf29c4194303263e4d560e2090cca92e2150e297f8120934ae84df8', '');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_referral`
--

CREATE TABLE `riwayat_referral` (
  `id` int(10) NOT NULL,
  `username` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `uplink` varchar(200) COLLATE utf8_swedish_ci NOT NULL,
  `kode` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `jumlah` varchar(25) COLLATE utf8_swedish_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `riwayat_referral`
--

INSERT INTO `riwayat_referral` (`id`, `username`, `uplink`, `kode`, `jumlah`, `date`, `time`) VALUES
(8, 'kincaipayment', '', 'MK-8208', '', '2021-09-15', '19:26:44');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_saldo_koin`
--

CREATE TABLE `riwayat_saldo_koin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `tipe` enum('Koin','Saldo') NOT NULL,
  `aksi` enum('Penambahan Saldo','Pengurangan Saldo','Penambahan Koin','Pengurangan Koin') NOT NULL,
  `nominal` double NOT NULL,
  `pesan` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `riwayat_saldo_koin`
--

INSERT INTO `riwayat_saldo_koin` (`id`, `username`, `tipe`, `aksi`, `nominal`, `pesan`, `date`, `time`) VALUES
(19, '', 'Koin', 'Penambahan Koin', 0, 'Mendapatkan Koin Melalui Referral Akun Dengan Nama Pengguna :  kincaipayment', '2021-09-15', '19:26:44');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_transfer`
--

CREATE TABLE `riwayat_transfer` (
  `id` int(10) NOT NULL,
  `tipe` varchar(25) COLLATE utf8_swedish_ci NOT NULL,
  `pengirim` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `penerima` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `jumlah` double NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `semua_pembelian`
--

CREATE TABLE `semua_pembelian` (
  `id` int(10) NOT NULL,
  `id_order` varchar(50) NOT NULL,
  `id_pesan` varchar(10) NOT NULL,
  `user` varchar(50) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `layanan` varchar(100) NOT NULL,
  `harga` double NOT NULL,
  `target` varchar(50) NOT NULL,
  `status` enum('Pending','Processing','Error','Success') NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `place_from` enum('API','WEB') NOT NULL,
  `refund` enum('0','1') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `setting_harga_untung`
--

CREATE TABLE `setting_harga_untung` (
  `id` int(11) NOT NULL,
  `kategori` enum('WEBSITE','API') NOT NULL,
  `tipe` enum('Sosial Media','Top Up') NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting_harga_untung`
--

INSERT INTO `setting_harga_untung` (`id`, `kategori`, `tipe`, `harga`) VALUES
(1, 'WEBSITE', 'Sosial Media', 19999),
(2, 'API', 'Sosial Media', 10999),
(3, 'WEBSITE', 'Top Up', 199),
(4, 'API', 'Top Up', 109);

-- --------------------------------------------------------

--
-- Table structure for table `setting_koin`
--

CREATE TABLE `setting_koin` (
  `id` int(4) NOT NULL,
  `tipe` varchar(50) NOT NULL,
  `minimal` varchar(50) NOT NULL,
  `rate` varchar(25) NOT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting_koin`
--

INSERT INTO `setting_koin` (`id`, `tipe`, `minimal`, `rate`, `status`) VALUES
(1, 'Tarik Koin Ke Saldo', '5000', '0.17', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `setting_koin_didapat`
--

CREATE TABLE `setting_koin_didapat` (
  `id` int(11) NOT NULL,
  `rate` varchar(10) NOT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting_koin_didapat`
--

INSERT INTO `setting_koin_didapat` (`id`, `rate`, `status`) VALUES
(1, '0.0005', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `setting_rate`
--

CREATE TABLE `setting_rate` (
  `id` int(11) NOT NULL,
  `tipe` enum('Sosial Media','Top Up','Pascabayar') NOT NULL,
  `rate` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting_rate`
--

INSERT INTO `setting_rate` (`id`, `tipe`, `rate`) VALUES
(1, 'Sosial Media', 2000),
(2, 'Top Up', 5000),
(3, 'Pascabayar', 5000);

-- --------------------------------------------------------

--
-- Table structure for table `setting_referral`
--

CREATE TABLE `setting_referral` (
  `id` int(4) NOT NULL,
  `jumlah` varchar(25) NOT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting_referral`
--

INSERT INTO `setting_referral` (`id`, `jumlah`, `status`) VALUES
(1, '0', 'Tidak Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `setting_web`
--

CREATE TABLE `setting_web` (
  `id` int(11) NOT NULL,
  `short_title` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `deskripsi_web` text NOT NULL,
  `kontak_utama` text NOT NULL,
  `lokasi` varchar(200) NOT NULL,
  `kode_pos` varchar(25) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting_web`
--

INSERT INTO `setting_web` (`id`, `short_title`, `title`, `deskripsi_web`, `kontak_utama`, `lokasi`, `kode_pos`, `date`, `time`) VALUES
(1, 'Kincai Payment', 'Kincai Payment - Panel SMM, PPOB, Voucher, E-Payment dan Games', 'Kincai Payment - Menyediakan Jasa Pemasaran Media Sosial (SMM) dan Produk Digital PPOB Multi Payments Terlengkap, Berkualitas, Cepat dan Aman.', '+6282377823390', 'Kincai Media, Jl. Stadion Pancasila, Koto Panap, Tanah Kampung, Sungai Penuh, Jambi, Indonesia', '37111', '2019-01-03', '16:06:10');

-- --------------------------------------------------------

--
-- Table structure for table `tiket`
--

CREATE TABLE `tiket` (
  `id` int(10) NOT NULL,
  `user` varchar(50) NOT NULL,
  `subjek` varchar(250) NOT NULL,
  `pesan` text NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `update_terakhir` datetime NOT NULL,
  `status` enum('Pending','Responded','Waiting','Closed') NOT NULL,
  `this_user` int(1) NOT NULL,
  `this_admin` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `top_depo`
--

CREATE TABLE `top_depo` (
  `id` int(10) NOT NULL,
  `method` varchar(200) COLLATE utf8_swedish_ci NOT NULL,
  `username` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `jumlah` int(250) NOT NULL,
  `total` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `top_layanan`
--

CREATE TABLE `top_layanan` (
  `id` int(10) NOT NULL,
  `method` varchar(200) COLLATE utf8_swedish_ci NOT NULL,
  `layanan` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `jumlah` int(100) NOT NULL,
  `total` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `top_users`
--

CREATE TABLE `top_users` (
  `id` int(10) NOT NULL,
  `method` varchar(200) COLLATE utf8_swedish_ci NOT NULL,
  `username` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `jumlah` int(250) NOT NULL,
  `total` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `nama_depan` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `nama_belakang` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `nama` text COLLATE utf8_swedish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `username` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `saldo_sosmed` int(10) NOT NULL,
  `saldo_top_up` int(10) NOT NULL,
  `pemakaian_saldo` double NOT NULL,
  `level` enum('Member','Developers') COLLATE utf8_swedish_ci NOT NULL,
  `status` enum('Aktif','Tidak Aktif') COLLATE utf8_swedish_ci NOT NULL,
  `status_akun` set('Sudah Verifikasi','Belum Verifikasi') COLLATE utf8_swedish_ci NOT NULL,
  `pin` int(6) NOT NULL,
  `api_key` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `uplink` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `uplink_referral` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `koin` double NOT NULL,
  `no_hp` varchar(25) COLLATE utf8_swedish_ci NOT NULL,
  `kode_verifikasi` varchar(10) COLLATE utf8_swedish_ci NOT NULL,
  `kode_referral` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `random_kode` varchar(20) COLLATE utf8_swedish_ci NOT NULL,
  `read_news` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama_depan`, `nama_belakang`, `nama`, `email`, `username`, `password`, `saldo_sosmed`, `saldo_top_up`, `pemakaian_saldo`, `level`, `status`, `status_akun`, `pin`, `api_key`, `uplink`, `uplink_referral`, `date`, `time`, `koin`, `no_hp`, `kode_verifikasi`, `kode_referral`, `random_kode`, `read_news`) VALUES
(1, 'Kincai', 'Payment', 'Kincai Payment', '401xdssh@gmail.com', 'kincaipayment', '$2y$10$iMRH6KmbhhcDaHTBLtQfPuipxZu5Qs7zfYz6Uy5z6ZnxIvYwtvtBW', 0, 400713, 0, 'Developers', 'Aktif', 'Sudah Verifikasi', 666666, 'DkIbSGkT43oTSKLD5h6M', 'Pendaftaran Gratis', '', '2021-09-15', '19:24:33', 0, '082377823390', '019420', 'MK-8208', 'zqWRu78gWG3526489010', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aktifitas`
--
ALTER TABLE `aktifitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bca`
--
ALTER TABLE `bca`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cek_akun`
--
ALTER TABLE `cek_akun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposit`
--
ALTER TABLE `deposit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `harga_kode_undangan`
--
ALTER TABLE `harga_kode_undangan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori_layanan`
--
ALTER TABLE `kategori_layanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ketentuan_layanan`
--
ALTER TABLE `ketentuan_layanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kode_undangan`
--
ALTER TABLE `kode_undangan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kontak_admin`
--
ALTER TABLE `kontak_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kontak_website`
--
ALTER TABLE `kontak_website`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `layanan_pascabayar`
--
ALTER TABLE `layanan_pascabayar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `layanan_pulsa`
--
ALTER TABLE `layanan_pulsa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `layanan_sosmed`
--
ALTER TABLE `layanan_sosmed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `metode_depo`
--
ALTER TABLE `metode_depo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mutasi`
--
ALTER TABLE `mutasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mutasi_bank`
--
ALTER TABLE `mutasi_bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembelian_pascabayar`
--
ALTER TABLE `pembelian_pascabayar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembelian_pulsa`
--
ALTER TABLE `pembelian_pulsa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembelian_sosmed`
--
ALTER TABLE `pembelian_sosmed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pertanyaan_umum`
--
ALTER TABLE `pertanyaan_umum`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesan_tiket`
--
ALTER TABLE `pesan_tiket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesan_tsel`
--
ALTER TABLE `pesan_tsel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promo_layanan`
--
ALTER TABLE `promo_layanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provider`
--
ALTER TABLE `provider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provider_pulsa`
--
ALTER TABLE `provider_pulsa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `riwayat_referral`
--
ALTER TABLE `riwayat_referral`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `riwayat_saldo_koin`
--
ALTER TABLE `riwayat_saldo_koin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `riwayat_transfer`
--
ALTER TABLE `riwayat_transfer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `semua_pembelian`
--
ALTER TABLE `semua_pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting_harga_untung`
--
ALTER TABLE `setting_harga_untung`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting_koin`
--
ALTER TABLE `setting_koin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting_koin_didapat`
--
ALTER TABLE `setting_koin_didapat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting_rate`
--
ALTER TABLE `setting_rate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting_referral`
--
ALTER TABLE `setting_referral`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting_web`
--
ALTER TABLE `setting_web`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tiket`
--
ALTER TABLE `tiket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `top_depo`
--
ALTER TABLE `top_depo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `top_layanan`
--
ALTER TABLE `top_layanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `top_users`
--
ALTER TABLE `top_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aktifitas`
--
ALTER TABLE `aktifitas`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cek_akun`
--
ALTER TABLE `cek_akun`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `deposit`
--
ALTER TABLE `deposit`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `harga_kode_undangan`
--
ALTER TABLE `harga_kode_undangan`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kategori_layanan`
--
ALTER TABLE `kategori_layanan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT for table `ketentuan_layanan`
--
ALTER TABLE `ketentuan_layanan`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kode_undangan`
--
ALTER TABLE `kode_undangan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `layanan_pascabayar`
--
ALTER TABLE `layanan_pascabayar`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `layanan_pulsa`
--
ALTER TABLE `layanan_pulsa`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=951;

--
-- AUTO_INCREMENT for table `layanan_sosmed`
--
ALTER TABLE `layanan_sosmed`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=308;

--
-- AUTO_INCREMENT for table `metode_depo`
--
ALTER TABLE `metode_depo`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mutasi`
--
ALTER TABLE `mutasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mutasi_bank`
--
ALTER TABLE `mutasi_bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pembelian_pascabayar`
--
ALTER TABLE `pembelian_pascabayar`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pembelian_pulsa`
--
ALTER TABLE `pembelian_pulsa`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pembelian_sosmed`
--
ALTER TABLE `pembelian_sosmed`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pertanyaan_umum`
--
ALTER TABLE `pertanyaan_umum`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `pesan_tiket`
--
ALTER TABLE `pesan_tiket`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pesan_tsel`
--
ALTER TABLE `pesan_tsel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `promo_layanan`
--
ALTER TABLE `promo_layanan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `provider`
--
ALTER TABLE `provider`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `provider_pulsa`
--
ALTER TABLE `provider_pulsa`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `riwayat_referral`
--
ALTER TABLE `riwayat_referral`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `riwayat_saldo_koin`
--
ALTER TABLE `riwayat_saldo_koin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `riwayat_transfer`
--
ALTER TABLE `riwayat_transfer`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `semua_pembelian`
--
ALTER TABLE `semua_pembelian`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=225;

--
-- AUTO_INCREMENT for table `setting_harga_untung`
--
ALTER TABLE `setting_harga_untung`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `setting_koin`
--
ALTER TABLE `setting_koin`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `setting_koin_didapat`
--
ALTER TABLE `setting_koin_didapat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `setting_rate`
--
ALTER TABLE `setting_rate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `setting_web`
--
ALTER TABLE `setting_web`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tiket`
--
ALTER TABLE `tiket`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `top_depo`
--
ALTER TABLE `top_depo`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `top_layanan`
--
ALTER TABLE `top_layanan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `top_users`
--
ALTER TABLE `top_users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

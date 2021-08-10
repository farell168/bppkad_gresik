-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Agu 2021 pada 06.26
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_bppkad_gresik`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_clustering`
--

CREATE TABLE `tb_clustering` (
  `id_clustering` int(11) NOT NULL,
  `no_pajak` varchar(100) NOT NULL,
  `cluster` char(2) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_clustering`
--

INSERT INTO `tb_clustering` (`id_clustering`, `no_pajak`, `cluster`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, '1', 'C6', 'Golongan Pajak Rumah Kos', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(2, '2', 'C4', 'Golongan Pajak Perhotelan / Apartemen', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(3, '3', 'C5', 'Golongan Pajak Homestay / Villa', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(4, '4', 'C3', 'Golongan Pajak Hiburan Lain-Lain', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(5, '5', 'C6', 'Golongan Pajak Rumah Kos', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(6, '6', 'C6', 'Golongan Pajak Rumah Kos', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(7, '7', 'C5', 'Golongan Pajak Homestay / Villa', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(8, '8', 'C6', 'Golongan Pajak Rumah Kos', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(9, '9', 'C1', 'Golongan Pajak Hiburan Olahraga', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(10, '10', 'C2', 'Golongan Pajak Hiburan Wisata', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(11, '11', 'C4', 'Golongan Pajak Perhotelan / Apartemen', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(12, '12', 'C3', 'Golongan Pajak Hiburan Lain-Lain', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(13, '13', 'C2', 'Golongan Pajak Hiburan Wisata', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(14, '14', 'C3', 'Golongan Pajak Hiburan Lain-Lain', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(15, '15', 'C1', 'Golongan Pajak Hiburan Olahraga', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(16, '16', 'C1', 'Golongan Pajak Hiburan Olahraga', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(17, '17', 'C1', 'Golongan Pajak Hiburan Olahraga', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(18, '18', 'C1', 'Golongan Pajak Hiburan Olahraga', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(19, '19', 'C1', 'Golongan Pajak Hiburan Olahraga', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(20, '20', 'C6', 'Golongan Pajak Rumah Kos', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(21, '21', 'C1', 'Golongan Pajak Hiburan Olahraga', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(22, '22', 'C3', 'Golongan Pajak Hiburan Lain-Lain', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(23, '23', 'C1', 'Golongan Pajak Hiburan Olahraga', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(24, '24', 'C1', 'Golongan Pajak Hiburan Olahraga', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(25, '25', 'C3', 'Golongan Pajak Hiburan Lain-Lain', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(26, '26', 'C2', 'Golongan Pajak Hiburan Wisata', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(27, '27', 'C6', 'Golongan Pajak Rumah Kos', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(28, '28', 'C4', 'Golongan Pajak Perhotelan / Apartemen', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(29, '29', 'C1', 'Golongan Pajak Hiburan Olahraga', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(30, '30', 'C1', 'Golongan Pajak Hiburan Olahraga', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(31, '31', 'C5', 'Golongan Pajak Homestay / Villa', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(32, '32', 'C2', 'Golongan Pajak Hiburan Wisata', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(33, '33', 'C6', 'Golongan Pajak Rumah Kos', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(34, '34', 'C6', 'Golongan Pajak Rumah Kos', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(35, '35', 'C2', 'Golongan Pajak Hiburan Wisata', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(36, '36', 'C1', 'Golongan Pajak Hiburan Olahraga', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(37, '37', 'C1', 'Golongan Pajak Hiburan Olahraga', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(38, '38', 'C1', 'Golongan Pajak Hiburan Olahraga', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(39, '39', 'C4', 'Golongan Pajak Perhotelan / Apartemen', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(40, '40', 'C1', 'Golongan Pajak Hiburan Olahraga', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(41, '41', 'C2', 'Golongan Pajak Hiburan Wisata', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(42, '42', 'C1', 'Golongan Pajak Hiburan Olahraga', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(43, '43', 'C2', 'Golongan Pajak Hiburan Wisata', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(44, '44', 'C8', 'Golongan Pajak Restoran', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(45, '45', 'C6', 'Golongan Pajak Rumah Kos', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(46, '46', 'C7', 'Golongan Pajak Cafe', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(47, '47', 'C6', 'Golongan Pajak Rumah Kos', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(48, '48', 'C6', 'Golongan Pajak Rumah Kos', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(49, '49', 'C4', 'Golongan Pajak Perhotelan / Apartemen', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(50, '50', 'C7', 'Golongan Pajak Cafe', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(51, '51', 'C8', 'Golongan Pajak Restoran', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(52, '52', 'C8', 'Golongan Pajak Restoran', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(53, '53', 'C7', 'Golongan Pajak Cafe', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(54, '54', 'C8', 'Golongan Pajak Restoran', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(55, '55', 'C8', 'Golongan Pajak Restoran', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(56, '56', 'C7', 'Golongan Pajak Cafe', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(57, '57', 'C8', 'Golongan Pajak Restoran', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(58, '58', 'C8', 'Golongan Pajak Restoran', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(59, '59', 'C8', 'Golongan Pajak Restoran', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(60, '60', 'C8', 'Golongan Pajak Restoran', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(61, '61', 'C7', 'Golongan Pajak Cafe', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(62, '62', 'C7', 'Golongan Pajak Cafe', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(63, '63', 'C7', 'Golongan Pajak Cafe', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(64, '64', 'C7', 'Golongan Pajak Cafe', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(65, '65', 'C7', 'Golongan Pajak Cafe', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(66, '66', 'C8', 'Golongan Pajak Restoran', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(67, '67', 'C7', 'Golongan Pajak Cafe', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(68, '68', 'C8', 'Golongan Pajak Restoran', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(69, '69', 'C7', 'Golongan Pajak Cafe', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(70, '70', 'C8', 'Golongan Pajak Restoran', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(71, '71', 'C8', 'Golongan Pajak Restoran', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(72, '72', 'C8', 'Golongan Pajak Restoran', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(73, '73', 'C7', 'Golongan Pajak Cafe', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(74, '74', 'C8', 'Golongan Pajak Restoran', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(75, '75', 'C7', 'Golongan Pajak Cafe', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(76, '76', 'C8', 'Golongan Pajak Restoran', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(77, '77', 'C8', 'Golongan Pajak Restoran', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(78, '78', 'C7', 'Golongan Pajak Cafe', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(79, '79', 'C7', 'Golongan Pajak Cafe', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(80, '80', 'C7', 'Golongan Pajak Cafe', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(81, '81', 'C8', 'Golongan Pajak Restoran', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(82, '82', 'C8', 'Golongan Pajak Restoran', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(83, '83', 'C8', 'Golongan Pajak Restoran', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(84, '84', 'C8', 'Golongan Pajak Restoran', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(85, '85', 'C7', 'Golongan Pajak Cafe', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(86, '86', 'C8', 'Golongan Pajak Restoran', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(87, '87', 'C7', 'Golongan Pajak Cafe', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(88, '88', 'C8', 'Golongan Pajak Restoran', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(89, '89', 'C8', 'Golongan Pajak Restoran', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(90, '90', 'C8', 'Golongan Pajak Restoran', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(91, '91', 'C8', 'Golongan Pajak Restoran', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(92, '92', 'C8', 'Golongan Pajak Restoran', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(93, '93', 'C8', 'Golongan Pajak Restoran', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(94, '94', 'C8', 'Golongan Pajak Restoran', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(95, '95', 'C7', 'Golongan Pajak Cafe', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(96, '96', 'C8', 'Golongan Pajak Restoran', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(97, '97', 'C7', 'Golongan Pajak Cafe', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(98, '98', 'C7', 'Golongan Pajak Cafe', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(99, '99', 'C7', 'Golongan Pajak Cafe', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(100, '100', 'C7', 'Golongan Pajak Cafe', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(101, '101', 'C8', 'Golongan Pajak Restoran', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(102, '102', 'C8', 'Golongan Pajak Restoran', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(103, '103', 'C7', 'Golongan Pajak Cafe', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(104, '104', 'C8', 'Golongan Pajak Restoran', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(105, '105', 'C7', 'Golongan Pajak Cafe', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(106, '106', 'C8', 'Golongan Pajak Restoran', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(107, '107', 'C8', 'Golongan Pajak Restoran', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(108, '108', 'C7', 'Golongan Pajak Cafe', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(109, '109', 'C7', 'Golongan Pajak Cafe', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(110, '110', 'C7', 'Golongan Pajak Cafe', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(111, '111', 'C7', 'Golongan Pajak Cafe', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(112, '112', 'C8', 'Golongan Pajak Restoran', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(113, '113', 'C7', 'Golongan Pajak Cafe', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(114, '114', 'C7', 'Golongan Pajak Cafe', '2021-07-28 03:02:44', '2021-07-28 03:02:44'),
(115, '115', 'C8', 'Golongan Pajak Restoran', '2021-07-28 03:02:44', '2021-07-28 03:02:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_objek_pajak`
--

CREATE TABLE `tb_objek_pajak` (
  `id` int(11) NOT NULL,
  `no_pajak` varchar(30) NOT NULL,
  `tanggal_bayar` date DEFAULT current_timestamp(),
  `alamat_pajak` varchar(100) DEFAULT NULL,
  `kecamatan` varchar(30) DEFAULT NULL,
  `nama_pemilik` varchar(100) DEFAULT NULL,
  `no_tlpn` varchar(30) DEFAULT NULL,
  `luas_lahan` float DEFAULT NULL,
  `daya_tampung` float DEFAULT NULL,
  `jumlah_pembangkit` int(11) DEFAULT NULL,
  `kapasitas_pemakaian` float DEFAULT NULL,
  `sumber_daya` int(11) DEFAULT NULL,
  `jumlah_kamar` int(11) NOT NULL,
  `jumlah_meja` int(11) NOT NULL,
  `jumlah_sarana_layanan` int(11) NOT NULL,
  `jumlah_lantai` int(11) NOT NULL,
  `kebutuhan_keamanan_tambahan` int(11) NOT NULL,
  `potensi_kecelakaan` int(11) NOT NULL,
  `kebutuhan_tenaga_medis_darurat` int(11) NOT NULL,
  `tarif` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_objek_pajak`
--

INSERT INTO `tb_objek_pajak` (`id`, `no_pajak`, `tanggal_bayar`, `alamat_pajak`, `kecamatan`, `nama_pemilik`, `no_tlpn`, `luas_lahan`, `daya_tampung`, `jumlah_pembangkit`, `kapasitas_pemakaian`, `sumber_daya`, `jumlah_kamar`, `jumlah_meja`, `jumlah_sarana_layanan`, `jumlah_lantai`, `kebutuhan_keamanan_tambahan`, `potensi_kecelakaan`, `kebutuhan_tenaga_medis_darurat`, `tarif`, `created_at`, `updated_at`) VALUES
(1, '35250200003716', '2019-02-24', 'Jl. Hos Cokroaminoto', 'Gresik', 'Bahagia', '-', 0.565, 0.3, 0, 3.6, 1, 15, 0, 2, 2, 1, 1, 1, 172350, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(2, '35250200016814', '2019-06-08', 'Jl. Arief Rahman Hakim no 79', 'Kebomas', 'SAPTANAWA', '-', 13, 1.35, 2, 66, 2, 40, 0, 15, 4, 4, 2, 2, 26043065, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(3, '35250200019214', '2019-02-25', 'Jl. Dr Wahidin SH', 'Kebomas', 'Bhineka', '-', 0.726, 0.25, 1, 16.5, 3, 10, 0, 1, 1, 2, 1, 1, 2872100, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(4, '35250200026114', '2019-02-17', 'Jl. RA. Kartini', 'Kebomas', 'Hiburan Sarikat Jaya\n', '-', 0.625, 0.6, 2, 7.7, 1, 0, 0, 9, 1, 5, 4, 4, 30000, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(5, '35250200030517', '2019-03-13', 'Sungai Teluk', 'Sangkapura', 'RP Intan', '-', 0.45, 0.16, 0, 3.6, 1, 16, 0, 2, 2, 1, 1, 1, 25000, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(6, '35250200030617', '2019-02-24', 'Dsn. Laut Sungai, Sawah Mulyo', 'Panceng', 'Bahagia', '-', 0.52, 0.15, 0, 3.6, 1, 15, 0, 2, 2, 1, 1, 1, 20000, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(7, '35250200052616', '2019-02-27', 'JL. RADEN SANTRI', 'Gresik', 'PUTRA JAYA', '-', 0.625, 0.2, 1, 13.2, 3, 10, 0, 1, 1, 2, 1, 1, 4011500, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(8, '35250200053517', '2019-03-26', 'DS.SUNGAI TELUK', 'Sangkapura', 'H.ABDUL CHALIK', '-', 0.365, 0.1, 0, 3.6, 1, 10, 0, 2, 1, 1, 1, 1, 125000, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(9, '35250200055011', '2019-02-14', 'DS.TAMBAK BERAS', 'Cerme', 'PENGELOLA KOLAM PANCING', '-', 24, 1.3, 0, 13.2, 1, 0, 0, 5, 1, 3, 3, 2, 120000, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(10, '35250200060303', '2019-02-12', 'DS.DELEGAN', 'Panceng', 'WISATA DELEGAN', '-', 32.571, 20, 2, 82.5, 2, 0, 0, 11, 1, 4, 5, 4, 1000000, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(11, '35250200066614', '2019-02-13', 'JL. DR WAHIDIN SH', 'Kebomas', 'PT. RAYA BUMI NUSANTARA', '-', 18.332, 2.5, 2, 41.5, 2, 55, 0, 20, 11, 1, 2, 2, 127887951, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(12, '35250200070310', '2019-02-07', 'JL.BROTONEGORO BARAT 132', 'Manyar', 'HIBURAN CILUK BAA\n', '-', 0.56, 0.5, 0, 7.7, 1, 0, 0, 11, 1, 2, 1, 2, 977000, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(13, '35250200076601', '2019-02-04', 'JL.RY.LOWAYU', 'Dukun', 'MALINDO\n', '-', 47, 25, 2, 82.5, 2, 0, 0, 12, 1, 4, 4, 4, 1744000, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(14, '35250200082213', '2019-06-02', 'Paragon Plaza A-15', 'Menganti', 'MAMAMIA RESTO DAN FAMILY', '-', 0.7, 0.45, 0, 7.7, 1, 0, 0, 1, 1, 2, 1, 2, 150000, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(15, '35250200083310', '2019-02-19', 'JL. BROTONEGORO', 'Manyar', 'HIDAYAT\n', '-', 11.482, 1.1, 1, 16.5, 3, 0, 0, 6, 1, 2, 2, 2, 1365000, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(16, '35250200084613', '2019-04-20', 'DS. HULA\'AN', 'Menganti', 'DWI UTOMO', '-', 14, 1, 0, 13.2, 1, 0, 0, 5, 1, 2, 2, 2, 126000, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(17, '35250200087702', '2019-02-11', 'DS KEDUNG PRING', 'Balongpanggang', 'SSC\n', '-', 8.274, 1.15, 1, 16.5, 2, 0, 0, 6, 1, 2, 2, 2, 100000, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(18, '35250200128600', '2019-01-11', 'DS. BALANDONO LAMONGAN', '-', 'SUUDI / TAMAN RIA PROMOSINDO\n', '-', 11, 10, 0, 13.2, 1, 0, 0, 1, 1, 2, 2, 2, 100000, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(19, '35250200137210', '2019-10-20', 'JL. RAYA SEMBAYAT SELATAN', 'Manyar', 'SEMBAYAT SERBAGUNA SPORT', '-', 9.451, 0.9, 0, 13.2, 1, 0, 0, 6, 1, 2, 2, 2, 300000, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(20, '35250200153717', '2019-02-24', 'DS.SUNGAI TELUK', 'Sangkapura', 'H.TAYYIB', '-', 0.4, 0.1, 0, 3.6, 1, 10, 0, 2, 1, 1, 1, 1, 100000, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(21, '35250200164613', '2019-03-19', 'DS.HULAAN', 'Menganti', 'PT.DUA DAYA SAKTI / LADIVA', '-', 9.6, 1, 1, 13.2, 1, 0, 0, 5, 1, 2, 2, 2, 500000, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(22, '35250200196510', '2019-02-12', 'JL.KALIMANTAN NO.35', 'Manyar', 'ALYA ', '-', 0.6, 0.5, 0, 7.7, 1, 0, 0, 1, 1, 2, 2, 2, 1000000, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(23, '35250200196814', '2019-02-17', 'JL. RA. KARTINI NO.150', 'Kebomas', 'HALIM ', '-', 12.307, 0.7, 0, 16.5, 3, 0, 0, 11, 1, 2, 2, 2, 900000, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(24, '35250200201814', '2019-03-16', 'JL.KARTINI NO.142-144', 'Kebomas', 'TIARA', '-', 13, 1.5, 0, 13.2, 1, 0, 0, 7, 1, 3, 2, 2, 500000, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(25, '35250200204513', '2019-02-04', 'JL.RAYA BOBOH', 'Menganti', 'VIRGO ', '-', 0.56, 0.6, 0, 7.7, 1, 0, 0, 6, 1, 2, 2, 2, 1536000, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(26, '35250200307710', '2019-01-14', 'JL. RANTAU I GKB SUKOMULYO', 'Manyar', 'DYNASTY WATER WORLD', '-', 41.562, 22, 2, 41.5, 2, 0, 0, 15, 1, 4, 5, 4, 13000000, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(27, '35250200342017', '2019-02-24', 'DS.SAWAHMULYA', 'Panceng', 'H.GUFRAN', '-', 0.473, 0.18, 0, 3.6, 1, 9, 0, 2, 1, 1, 1, 1, 15000, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(28, '35250200345516', '2019-02-10', 'JL. PANGLIMA SUDIRMAN NO 01', 'Gresik', 'PESONA GRESIK', '-', 16.58, 3.7, 2, 66, 2, 85, 0, 25, 15, 4, 2, 2, 55508035, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(29, '35250200351510', '2019-04-27', 'JL KALIMATAN', 'Manyar', 'DOREMI LAND', '-', 21, 9, 1, 41.5, 3, 0, 0, 10, 1, 2, 2, 2, 300000, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(30, '35250200354200', '2019-04-20', 'KEDIRI', '-', 'PUTRA CAHAYA', '-', 10, 1.2, 1, 23, 3, 0, 0, 6, 1, 2, 2, 2, 126000, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(31, '35250200381914', '2019-02-11', 'JL. DR WAHIDIN SH, KOMPLK RUKO', 'Kebomas', 'GRAB', '-', 0.5, 0.25, 1, 16.5, 3, 10, 0, 1, 1, 2, 1, 1, 2501170, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(32, '35250200394713', '2019-03-19', 'JL.PUTAT LOR', 'Menganti', 'SURYA WATER BOOM', '-', 50, 25, 3, 82.5, 2, 0, 0, 17, 1, 1, 1, 1, 500000, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(33, '35250200405517', '2019-03-26', 'DS.SAWAHMULYA', 'Panceng', 'MIRANDA', '-', 0.6, 0.1, 0, 3.6, 1, 10, 0, 2, 2, 1, 1, 1, 250000, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(34, '35250200410714', '2019-02-12', 'JL. DR. WAHIDIN SHD 788 RUKO', 'Kebomas', 'LESTARI', '-', 0.425, 0.2, 0, 3.6, 1, 10, 0, 2, 1, 1, 1, 1, 17000, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(35, '35250200432912', '2019-02-24', 'DESA MASANGAN RT.10 RW.05', 'Bungah', 'WISATA BAJAK LAUT', '-', 40, 15, 2, 82.5, 2, 0, 0, 12, 1, 4, 4, 4, 1542000, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(36, '35250200481012', '2019-01-20', 'DS BUNGAH', 'Bungah', 'TIGA PUTRA ', '-', 25, 4, 0, 13.2, 1, 0, 0, 5, 1, 2, 2, 2, 1400000, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(37, '35250200481109', '2019-02-28', 'DS NGAWEN', 'Sidayu', 'DANI SPORT CENTER (DSC)\n', '-', 13, 1.17, 1, 23, 2, 0, 0, 5, 1, 2, 2, 2, 300000, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(38, '35250200542514', '2019-02-07', 'JL.DR.WAHIDIN SH. ICON MALL', 'Kebomas', 'PT.GRAHA LAYAR PRIMA (cgv)\n', '-', 32.571, 5, 1, 13.2, 3, 0, 0, 5, 1, 3, 3, 3, 50696136, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(39, '35250200544910', '2019-02-12', 'JL. KALIMANTAN 12A, GKB', 'Manyar', 'PT. BUMI METRO WISATA', '-', 15, 3.5, 2, 66, 2, 70, 0, 20, 10, 4, 2, 2, 73061800, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(40, '35250200545714', '2019-02-07', 'JL. DR. WAHIDIN SUDIROHUSODO', 'Kebomas', 'PT. TRANS REKRESINDO', '-', 13, 4, 1, 23, 3, 0, 0, 8, 1, 2, 1, 2, 12570833, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(41, '35250200554114', '2019-02-07', 'JL.DR.WAHIDIN SH (ICOL MALL)', 'Kebomas', 'HAPPY TIME GRESIK', '-', 47, 10, 3, 41.5, 2, 0, 0, 16, 1, 4, 3, 3, 18120000, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(42, '35250200556712', '2019-01-20', 'DS.BUNGAH', 'Bungah', 'TAMAN RIA (SUGENG)', '-', 20, 5, 0, 13.2, 1, 0, 0, 5, 1, 2, 2, 2, 1400000, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(43, '35250200562914', '2019-02-10', 'JL.SUMATRA GKB', 'Manyar', 'PT.NUSANTARA SEJAHTERA RAYA', '-', 47, 10, 3, 41.5, 2, 0, 0, 14, 1, 4, 4, 3, 19192800, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(44, '35250200643200', '2019-02-10', 'JL TEBET TIMUR III NO 15 JAKARTA', 'Tebet, Jakarta', 'PT JCO DONUT & COFFE\n', '-', 6.5, 0.7, 1, 11, 3, 0, 21, 25, 2, 2, 2, 1, 16250618, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(45, '35250200656917', '2019-02-24', 'DS.SUNGAI TELUK', 'Sangkapura', 'HALIMAH (senja)', '-', 0.525, 0.15, 0, 3.6, 1, 15, 0, 2, 2, 1, 1, 1, 50000, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(46, '35250200662500', '2019-02-14', 'JL. KENJERAN NO. 209', 'Tambaksari, Surabaya', 'PT. SAYYIDATI SEJAHTERAH\n', '-', 0.55, 0.25, 0, 2.3, 1, 0, 7, 13, 1, 2, 1, 1, 4061907, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(47, '35250200705617', '2019-02-24', 'DESA SUNGAIRUJING', 'Sangkapura', 'BUANG SARI', '-', 0.483, 0.14, 0, 3.6, 1, 14, 0, 2, 2, 1, 1, 1, 50000, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(48, '35250200714117', '2019-02-23', 'SAWAHMULYA', 'Panceng', 'H. EFENDI / MOTEL PUJASERA', '-', 0.517, 0.2, 0, 3.6, 1, 10, 0, 2, 1, 1, 1, 1, 50000, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(49, '35250200732214', '2019-08-31', 'JL. SUMATRA NO 1-5, GKB', 'Kebomas', 'ASTON INN GRESIK', '-', 13.283, 2.75, 2, 41.5, 2, 55, 0, 20, 11, 4, 2, 2, 43901864, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(50, '35250200797600', '2019-03-03', 'DS. KEDUNGRUKEM BENJENG', 'Benjeng', 'PRAMBANAN\n', '-', 0.579, 0.2, 0, 3.6, 1, 0, 5, 14, 1, 2, 1, 1, 1500000, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(51, '35250200816900', '2019-04-14', 'JL AMBENG AMBENG', 'Duduk Sampeyan', 'PT. INDOMARCO PRISMATAMA\n', '-', 5, 0.65, 1, 7.7, 3, 0, 20, 22, 2, 2, 2, 1, 14461046, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(52, '35250200952000', '2019-02-10', 'JL. JAWA, GKB', 'Manyar', 'BEBEK GORENG H SLAMET\n', '-', 6.675, 0.6, 1, 11, 3, 0, 20, 23, 1, 2, 2, 1, 22052003, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(53, '35250200990600', '2019-02-06', 'DS. DADAP KUNING KEC. CERME', 'Cerme', 'TRANS CAFE\n', '-', 0.45, 0.15, 0, 1.3, 1, 0, 8, 10, 1, 2, 1, 1, 4457920, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(54, '35250201009900', '2019-02-27', 'JL. SULAWESI NO 2, GKB', 'Gresik', 'DEPOT KOBER MIE SETAN\n', '-', 9.216, 0.8, 1, 13.2, 3, 0, 25, 19, 2, 2, 2, 1, 46630550, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(55, '35250201029200', '2019-03-11', 'JL. JAWA 108 GKB', 'Manyar', 'AYAM PENYET SURABAYA\n', '-', 5.521, 0.5, 1, 11, 3, 0, 20, 21, 1, 2, 2, 1, 23068200, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(56, '35250201048500', '2019-02-10', 'JL. KALIMANTAN 193 GKB', 'Manyar', 'GIANT FRIED CHICKEN (GFC)\n', '-', 0.58, 0.2, 0, 2.3, 1, 0, 5, 15, 1, 2, 1, 1, 5575302, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(57, '35250201067800', '2019-07-15', 'JL. KALIMANTAN 187 B', 'Manyar', 'ICHI SUSHI\n', '-', 6.168, 0.55, 1, 7.7, 3, 0, 15, 18, 1, 2, 2, 1, 17033548, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(58, '35250201106400', '2019-02-10', 'JL.JAWA NO.105 GKB', 'Manyar', 'IGA KARTO &\n', '-', 6.954, 0.7, 1, 7.7, 3, 0, 20, 20, 1, 2, 2, 1, 12610982, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(59, '35250201125700', '2019-02-06', 'Jl. Jawa No. 49 GKB', 'Manyar', 'CV. KULINER PRIMA NUSANTARA ', '-', 7.871, 0.75, 1, 11, 3, 0, 20, 21, 2, 2, 2, 1, 11801000, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(60, '35250201145000', '2019-02-07', 'JL JAWA GKB', 'Manyar', 'ANGKRINGAN JOGJA\n', '-', 5.471, 0.5, 1, 7.7, 3, 0, 15, 19, 1, 2, 2, 1, 13972000, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(61, '35250201241500', '2019-02-04', 'JL.JAWA NO.110 GKB', 'Manyar', 'PIZZA COMBI\n', '-', 0.625, 0.3, 0, 2.3, 1, 0, 6, 12, 1, 2, 1, 1, 3067100, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(62, '35250201338000', '2019-03-03', 'DESA CERME LOR', 'Cerme', 'ROCKET CHICKEN CERME', '-', 0.613, 0.25, 0, 2.3, 1, 0, 7, 12, 1, 2, 1, 1, 1000000, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(63, '35250201357300', '2019-02-11', 'JL. RAYA PELEM WATU', 'Menganti', 'MONA BEBEK', '-', 0.593, 0.2, 0, 1.3, 1, 0, 7, 14, 1, 2, 1, 1, 1500000, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(64, '35250201473100', '2019-02-25', 'JL. RAYA WONOKOYO NO 9', 'Menganti', 'KEDAI GUBUG KOPI', '-', 0.576, 0.15, 0, 2.3, 1, 0, 6, 13, 1, 2, 1, 1, 2784500, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(65, '35250201492400', '2019-02-20', 'Jl. Veteran', 'Kebomas', 'RM.PAK ELAN I', '-', 0.631, 0.2, 0, 2.3, 1, 0, 7, 11, 1, 2, 1, 1, 4095400, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(66, '35250201531000', '2019-03-06', 'Jl. Veteran', 'Kebomas', 'RM P Elan II', '-', 8.281, 0.75, 1, 13.2, 3, 0, 20, 17, 1, 2, 2, 1, 52102000, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(67, '35250201550300', '2019-02-17', 'Jl. Dr Wahidin SH', 'Kebomas', 'Depot Sumatra V', '-', 0.702, 0.25, 0, 2.3, 1, 0, 8, 15, 1, 2, 1, 1, 2250000, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(68, '35250201569600', '2019-02-18', 'Jl. Veteran', 'Kebomas', 'Mc DONALDS', '-', 6.743, 0.6, 1, 11, 3, 0, 20, 22, 2, 2, 2, 1, 208305977, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(69, '35250201588900', '2019-02-10', 'Jl. Dr Wahidin SH', 'Kebomas', 'Warung Nasi Krawu Buk Timan', '-', 0.684, 0.2, 0, 2.3, 1, 0, 7, 12, 1, 2, 1, 1, 8250000, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(70, '35250201608200', '2019-02-26', 'JL DR WAHIDIN SUDIRO HUSODO', 'Kebomas', 'RM APUNG RAHMAWATI', '-', 6.439, 0.5, 1, 7.7, 3, 0, 20, 19, 1, 2, 2, 1, 70513700, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(71, '35250201627500', '2019-02-06', 'JL. VETERAN 157', 'Kebomas', 'IKAN BAKAR CIANJUR', '-', 7.114, 0.65, 1, 11, 3, 0, 23, 16, 2, 2, 2, 1, 81926554, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(72, '35250201646800', '2019-02-18', 'JL.VETERAN', 'Kebomas', 'THE LEGEND RESTO', '-', 6.293, 0.6, 1, 7.7, 3, 0, 27, 20, 2, 2, 2, 1, 30324209, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(73, '35250201666100', '2019-02-06', 'JL. VETERAN', 'Kebomas', 'LESEHAN SEGOROMADU', '-', 0.72, 0.3, 0, 3.6, 1, 0, 9, 8, 1, 2, 1, 1, 5100600, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(74, '35250201762600', '2019-02-07', 'JL. RA KARTINI', 'Kebomas', 'PT SARIMELATI KENCANA,PIZZA', '-', 8.72, 0.7, 1, 13.2, 3, 0, 24, 23, 2, 2, 2, 1, 115737338, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(75, '35250201781900', '2019-02-19', 'JL. ARIEF RAHMAN HAKIM', 'Kebomas', 'M2M FASTFOOD INDONESIA', '-', 0.741, 0.28, 0, 3.6, 1, 0, 9, 10, 1, 2, 1, 1, 2500000, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(76, '35250201820500', '2019-02-13', 'JL Dr.WAHIDIN SH No.138 GRESIK', 'Kebomas', 'KFC', '-', 6.112, 0.55, 1, 11, 3, 0, 17, 24, 1, 2, 2, 1, 49811488, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(77, '35250201839800', '2019-02-17', 'GREEN GARDEN KAV. A1 - 3', 'Kebomas', 'RESTORAN HANDAYANI', '-', 5.993, 0.55, 1, 11, 3, 0, 19, 21, 2, 2, 2, 1, 20901151, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(78, '35250201859100', '2019-03-09', 'JL.DR.WAHIDIN SH 120', 'Kebomas', 'DEPOT PAK D', '-', 0.678, 0.22, 0, 2.3, 1, 0, 8, 11, 1, 2, 1, 1, 1438600, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(79, '35250201878400', '2019-02-05', 'JL.DR.WAHIDIN SH NO.138 NO.234', 'Kebomas', 'DEPOT MADIUN BU RUDY', '-', 0.637, 0.18, 0, 1.3, 1, 0, 9, 12, 1, 2, 1, 1, 4700380, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(80, '35250201897700', '2019-03-17', 'Jl. Dr. Wahidin Sudirohusodo No. 111', 'Kebomas', 'WARUNK UPNORMAL GRESIK', '-', 0.7, 0.18, 0, 2.3, 1, 0, 10, 9, 1, 2, 1, 1, 4713500, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(81, '35250201936300', '2019-02-11', 'JL.DR. WAHIDIN SUDIROHUSODO', 'Kebomas', 'PT.PRIMA USAHA ERA MANDIRI (A', '-', 6.168, 0.55, 1, 7.7, 3, 0, 18, 18, 1, 2, 2, 1, 15885182, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(82, '35250201974900', '2019-02-10', 'KOMPLEK ICON MALL', 'Kebomas', 'BURGER KING', '-', 6.954, 0.6, 1, 11, 3, 0, 20, 19, 2, 2, 2, 1, 44240998, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(83, '35250201994200', '2019-02-06', 'ICON MALL GRESIKLT GF 02', 'Kebomas', 'PT YOSINOYA ', '-', 7.871, 0.62, 1, 7.7, 3, 0, 25, 21, 2, 2, 2, 1, 41638830, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(84, '35250202013500', '2019-02-10', 'JL. DR. WAHIDIN SH', 'Kebomas', 'MIE MAPAN', '-', 5.471, 0.6, 0, 11, 3, 0, 17, 20, 1, 2, 2, 1, 13691343, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(85, '35250202032800', '2019-02-04', 'ICON MALL', 'Kebomas', 'RM NASI GORENG 69', '-', 0.596, 0.16, 0, 1.3, 1, 0, 8, 12, 1, 2, 1, 1, 9701400, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(86, '35250202052100', '2019-02-10', 'JL. SUMATERA, GKB (GRESS MALL)', 'Kebomas', 'A & W RESTAURAN\'S', '-', 5.15, 0.5, 1, 7.7, 3, 0, 20, 19, 2, 2, 2, 1, 13901910, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(87, '35250202071400', '2019-02-12', 'ICON MALL GRESIK', 'Kebomas', 'MOKKO FACTORY', '-', 0.684, 0.2, 0, 2.3, 1, 0, 8, 12, 1, 2, 1, 1, 9586000, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(88, '35250202090700', '2019-02-12', 'JL. DR. WAHIDIN', 'Kebomas', 'TRANSMART GRESIK', '-', 5, 0.5, 1, 13.2, 3, 0, 15, 17, 1, 2, 2, 1, 25459384, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(89, '35250202110000', '2019-02-10', 'JL.SUMATRA GKB', 'Kebomas', 'PT.NUSANTARA SEJAHTERA RAYA', '-', 6.675, 0.5, 1, 11, 3, 0, 19, 18, 1, 2, 2, 1, 31692273, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(90, '35250202129300', '2019-02-10', 'GRESS MALL , JL. SUMATERA, GKB', 'Kebomas', 'RESTORAN KAMPOENG TIMBEL /', '-', 6.439, 0.5, 1, 11, 3, 0, 20, 20, 1, 2, 2, 1, 22549073, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(91, '35250202148600', '2019-02-25', 'JL. Sumatera 6F No. B-02', 'Kebomas', 'CV. KOPI MAS KARTIKA ( EXCELSO', '-', 7.114, 0.7, 1, 13.2, 3, 0, 22, 15, 2, 2, 2, 1, 17409398, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(92, '35250202167900', '2019-02-13', 'GRESS MALL, GKB, RANDU', 'Kebomas', 'PT FOOD BEVERAGES INDONESIA', '-', 6.293, 0.6, 1, 7.7, 3, 0, 18, 15, 1, 2, 2, 1, 47861161, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(93, '35250202187200', '2019-02-07', 'ICON MALL, GRESIK', 'Kebomas', 'PT RICHEESE KULINER INDONESIA', '-', 6.112, 0.55, 1, 7.7, 3, 0, 15, 16, 2, 2, 2, 1, 64148991, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(94, '35250202206500', '2019-02-06', 'ICON MALL', 'Kebomas', 'RESTORAN SOLARIA', '-', 5.993, 0.55, 1, 7.7, 3, 0, 21, 15, 1, 2, 2, 1, 43871344, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(95, '35250202225800', '2019-02-06', 'JL.SUMATRA  / GRESS MALL', 'Kebomas', 'PENYETAN COK', '-', 0.45, 0.16, 0, 1.3, 1, 0, 7, 12, 1, 2, 1, 1, 9959000, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(96, '35250202245100', '2019-02-06', 'JL. SUMATERA, GKB (GRESS MALL)', 'Kebomas', 'SOLARIA', '-', 7.114, 0.55, 1, 11, 3, 0, 24, 19, 2, 2, 2, 1, 36110062, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(97, '35250202264400', '2019-02-12', 'JL. PUTRI CEMPO', 'Kebomas', 'LUMINOS', '-', 0.524, 0.2, 0, 2.3, 1, 0, 6, 9, 1, 2, 1, 1, 3926859, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(98, '35250202283700', '2019-02-10', 'JL. SUMATERA NO 46, GKB', 'Kebomas', 'POSISI COFFE', '-', 0.574, 0.22, 0, 2.3, 1, 0, 8, 10, 1, 2, 1, 1, 4238039, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(99, '35250202303000', '2019-05-15', 'JL. DR WAHIDIN SUDIRO HUSODO', 'Kebomas', 'STARBUCKS', '-', 0.672, 0.2, 0, 2.3, 1, 0, 10, 14, 1, 2, 1, 1, 1663200, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(100, '35250202322300', '2019-02-07', 'JL. DR. WAHIDIN SH ICON MALL 2F', 'Kebomas', 'TEH BREAK ( OSMOND', '-', 0.711, 0.21, 0, 2.3, 1, 0, 11, 10, 1, 2, 1, 1, 1000000, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(101, '35250202341600', '2019-02-10', 'JL. KALIMANTAN 192, GKB', 'Manyar', 'KAMPOENG STEAK', '-', 5.15, 0.54, 1, 11, 3, 0, 17, 17, 1, 2, 2, 1, 33556074, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(102, '35250202360900', '2019-02-18', 'Jl. Raya Bunder No. 1A Gresik', 'Duduk Sampeyan', 'RESTO JOYO HARTONO', '-', 6.293, 0.62, 1, 7.7, 3, 0, 20, 19, 1, 2, 2, 1, 29182819, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(103, '35250202380200', '2019-01-13', 'ICON MALL Lt LG 678A, GRESIK', 'Kebomas', 'PT. BUMI BERKAH BOGA (KOPI)', '-', 0.752, 0.24, 0, 3.6, 1, 0, 11, 13, 1, 2, 1, 1, 10049637, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(104, '35250202592500', '2019-02-10', 'JL. A. YANI', 'Gresik', 'KANTIN GRAHA SARANA', '-', 6.954, 0.58, 1, 7.7, 3, 0, 24, 20, 2, 2, 2, 1, 16927036, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(105, '35250202611800', '2019-02-11', 'JL. PANGLIMA SUDIRMAN', 'Gresik', 'PIT STOP CAFÉ', '-', 0.691, 0.18, 0, 3.6, 1, 0, 9, 10, 1, 2, 1, 1, 3271582, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(106, '35250202650400', '2019-02-28', 'JL.RAYA CERME LOR', 'Cerme', 'WARUNG INTARUM', '-', 6.811, 0.58, 1, 11, 3, 0, 24, 19, 2, 2, 2, 1, 12339200, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(107, '35250202669700', '2019-02-10', 'ICON MALL, JL DR WAHIDIN', 'Gresik', 'CALIFORNIA FRIED CHICKEN ( CFC)', '-', 7.102, 0.62, 1, 13.2, 3, 0, 26, 21, 2, 2, 2, 1, 16849337, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(108, '35250202689000', '2019-03-12', 'JL. JAWA NO 86-88', 'Manyar', 'WARUNG KOPI AGP', '-', 0.45, 0.18, 0, 2.3, 1, 0, 6, 13, 1, 2, 1, 1, 5508650, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(109, '35250202708300', '2019-02-25', 'DESA KRIKILAN RT.15 RW.06', 'Driyorejo', 'GUN\'S CAFÉ', '-', 0.714, 0.26, 0, 2.3, 1, 0, 8, 13, 1, 2, 1, 1, 1000000, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(110, '35250202727600', '2019-03-17', 'JL. USMAN SADAR', 'Gresik', 'MBLEDEQ CAFE & RESTO', '-', 0.62, 0.2, 0, 1.3, 1, 0, 7, 13, 1, 2, 1, 1, 2350000, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(111, '35250202746900', '2019-02-24', 'JL. PANGLIMA SUDIRMAN No. 1', 'Gresik', 'ONE PLACE', '-', 0.574, 0.2, 0, 1.3, 1, 0, 8, 11, 1, 2, 1, 1, 1636070, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(112, '35250202766200', '2019-02-12', 'JL DR SOETOMO 130', 'Kebomas', 'RESTO AYAM GORENG NELONGSO', '-', 5.992, 0.55, 1, 13.2, 3, 0, 20, 21, 1, 2, 2, 1, 15952000, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(113, '35250202785500', '2019-02-24', 'ICON MALL, GRESIK', 'Kebomas', 'PT TORICO MAJU MAKMUR', '-', 0.615, 0.19, 0, 1.3, 1, 0, 9, 11, 1, 2, 1, 1, 1234250, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(114, '35250202804800', '2019-03-05', 'JL. Gub.Suryo', 'Gresik', 'ROTI BOY', '-', 0.589, 0.2, 0, 1.3, 1, 0, 8, 12, 1, 2, 1, 1, 5688016, '2021-07-17 13:42:40', '2021-07-17 13:42:40'),
(115, '35250202824100', '2019-02-20', 'JL. PANGLIMA SUDIRMAN No. 52', 'Gresik', 'JOKO PRASETYO / PADANG\nJL. PANGLIMA SUDIRMAN No. 52', '-', 7.412, 0.6, 1, 13.2, 3, 0, 22, 19, 1, 2, 2, 1, 22960300, '2021-07-17 13:42:40', '2021-07-17 13:42:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `nip` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`nip`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(35250988888888, 'Darmaji Aji', 'sarkan12@gmail.com', '2021-07-27 20:03:27', '$2y$10$1WeYZselOseiHDKSpZDHqeY6TuyWCRW7uxKii0gZCJTXJcvezmCiS', NULL, '2021-07-27 20:03:27', '2021-07-27 20:03:27'),
(3509211611990013, 'Farell Senoaji', 'andra.sevenvold@gmail.com', '2021-06-17 00:08:19', '$2y$10$ZBmulyLurr1BUHiBfQERTuScjUjqQt0mwQJDHEBpBeFSnYseEu1ZG', NULL, '2021-06-17 00:08:19', '2021-06-17 00:08:19');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_clustering`
--
ALTER TABLE `tb_clustering`
  ADD PRIMARY KEY (`id_clustering`);

--
-- Indeks untuk tabel `tb_objek_pajak`
--
ALTER TABLE `tb_objek_pajak`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`nip`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_clustering`
--
ALTER TABLE `tb_clustering`
  MODIFY `id_clustering` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT untuk tabel `tb_objek_pajak`
--
ALTER TABLE `tb_objek_pajak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

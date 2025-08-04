-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Agu 2024 pada 03.21
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpus`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `general_number` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `koleksi` varchar(255) DEFAULT NULL,
  `material_type` varchar(255) DEFAULT NULL,
  `book_number` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `jilid` varchar(255) DEFAULT NULL,
  `edition` varchar(255) DEFAULT NULL,
  `cetakan` varchar(255) DEFAULT NULL,
  `lssn` varchar(255) DEFAULT NULL,
  `regulation_number` varchar(255) DEFAULT NULL,
  `regulation_type` varchar(255) DEFAULT NULL,
  `regulation_year` varchar(255) DEFAULT NULL,
  `regulation_place` varchar(255) DEFAULT NULL,
  `magazine_number` varchar(255) DEFAULT NULL,
  `volume_number` varchar(255) DEFAULT NULL,
  `publication_period` varchar(255) DEFAULT NULL,
  `publication_place` varchar(255) DEFAULT NULL,
  `publisher` varchar(255) DEFAULT NULL,
  `publication_year` varchar(255) DEFAULT NULL,
  `classification_number` varchar(255) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `books`
--

INSERT INTO `books` (`id`, `general_number`, `title`, `koleksi`, `material_type`, `book_number`, `author`, `jilid`, `edition`, `cetakan`, `lssn`, `regulation_number`, `regulation_type`, `regulation_year`, `regulation_place`, `magazine_number`, `volume_number`, `publication_period`, `publication_place`, `publisher`, `publication_year`, `classification_number`, `source`, `description`, `cover_image`) VALUES
(3, '5', 'Keputusan Jaksa Agung Republik Indonesia No 158 Tahun 2023 tentang Tim Optimalisasi Pemberitahuan di Lingkungan Kejaksaan Republik Indonesia', 'Koleksi Inti', 'Peraturan', '-', '-', NULL, '', NULL, '', '809', 'Keputusan', '158 Tahun 2023', 'Jakarta/No.158', '-', '-', '-', 'Jakarta', 'Jaksa Agung Republik indonesia', '2023', '348', 'Print Out Sendiri dari JDiH', '', 'CamScanner 31-07-2024 08.57.jpg'),
(7, '348', 'Himpunan Peraturan Perundang-Undangan', 'Koleksi Dasar', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'CamScanner 31-07-2024 08.57.jpg'),
(8, '', '', 'Koleksi Pendukung', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'CamScanner 31-07-2024 08.57.jpg'),
(12, '000', 'Metode Penelitian Sosial', 'Koleksi Spesifik', 'Buku', '836', 'Dr. Ulber Silalahi, MA.', '', '-', '', '979-1073-61-9', '898', '-', '-', '-', '-', '-', '-', 'Bandung', 'PT Refika Aditama', '2009', '-', '-', '', 'CamScanner 31-07-2024 08.57.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`, `email`, `role`) VALUES
(2, '', 'admin', '$2y$10$XMExBofk6zmjlucEx8.ye.N6Ttd.7Qa8f6GzTo4ozFpcr6oUzVFVW', '', 1),
(3, '', 'user', '$2y$10$0AWGgbDzb02l10qKhAQk4uGTSxHkd.J5MZQm9RLsrFq5MKJ1TMEYC', '', 0),
(4, 'Pengguna', 'pengguna', '$2y$10$tLaL1F8xMGDApTaOqi1U2uTsFw5giED6ond0VIlXvaazmRPT7b/Cy', 'pengguna12@gmail.com', 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

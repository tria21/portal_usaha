-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2022 at 01:53 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portal_umkm`
--

-- --------------------------------------------------------

--
-- Table structure for table `berandas`
--

CREATE TABLE `berandas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `isi_beranda` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi_tambahan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `berandas`
--

INSERT INTO `berandas` (`id`, `isi_beranda`, `deskripsi_tambahan`, `created_at`, `updated_at`) VALUES
(1, '<h3><strong>Kriteria usaha mikro, kecil, dan menengah (UMKM)</strong></h3><p>&nbsp;</p><p>1. Kriteria Usaha Mikro adalah sebagai berikut:</p><ul><li>Memiliki kekayaan bersih paling banyak Rp 50 juta&nbsp;tidak termasuk tanah dan bangunan tempat usaha.</li><li>Memiliki hasil penjualan tahunan paling banyak Rp 300 juta.</li></ul><p>&nbsp;</p><p>2. Kriteria Usaha Kecil adalah sebagai berikut:</p><ul><li>Memiliki kekayaan bersih lebih dari Rp 50 juta sampai dengan paling banyak Rp 500 juta tidak termasuk tanah dan bangunan tempat usaha.</li><li>Memiliki hasil penjualan tahunan lebih dari Rp 300 juta sampai dengan paling banyak Rp 2,5 miliar .</li></ul><p>&nbsp;</p><p>3. Kriteria Usaha Menengah adalah sebagai berikut:</p><ul><li>Memiliki kekayaan bersih lebih dari Rp 500 juta&nbsp;sampai dengan paling banyak Rp 10 miliar tidak termasuk tanah dan bangunan tempat usaha.</li><li>Memiliki hasil penjualan tahunan lebih dari Rp2.5 miliar&nbsp;sampai dengan paling banyak Rp 50 miliar.</li></ul>', 'Menurut PP No. 7 Tahun 2021', '2022-06-06 21:55:37', '2022-06-06 21:55:37');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galeris`
--

CREATE TABLE `galeris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `caption_gambar` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galeris`
--

INSERT INTO `galeris` (`id`, `image`, `caption_gambar`, `created_at`, `updated_at`) VALUES
(1, '1654573045417.jpg', 'Batik Cap Khas Jombang', '2022-06-06 20:37:27', '2022-06-06 21:43:36'),
(2, '1654576977843.webp', 'Proses Pembuatan Batik Di Kecamatan Gudo', '2022-06-06 21:42:57', '2022-06-06 21:44:12'),
(3, '1654577099959.png', 'Kerajinan Rotan Homemade', '2022-06-06 21:44:59', '2022-06-06 21:44:59');

-- --------------------------------------------------------

--
-- Table structure for table `komentars`
--

CREATE TABLE `komentars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_artikel` bigint(20) UNSIGNED NOT NULL,
  `isi_komentar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_komentar_utama` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_user` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `komentars`
--

INSERT INTO `komentars` (`id`, `id_user`, `id_artikel`, `isi_komentar`, `id_komentar_utama`, `nama_user`, `created_at`, `updated_at`) VALUES
(11, 3, 2, 'Bagus euy', '0', 'Caca', '2022-06-06 00:22:35', '2022-06-06 00:22:35'),
(12, 3, 2, 'Lanjutkan', '0', 'Caca', '2022-06-06 01:02:11', '2022-06-06 01:02:11');

-- --------------------------------------------------------

--
-- Table structure for table `konten_artikels`
--

CREATE TABLE `konten_artikels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caption_gambar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi_artikel` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `penulis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `konten_artikels`
--

INSERT INTO `konten_artikels` (`id`, `id_user`, `judul`, `gambar`, `caption_gambar`, `kategori`, `isi_artikel`, `penulis`, `role`, `created_at`, `updated_at`) VALUES
(1, 1, 'Cara Cek Penerima & Syarat Daftar BLT UMKM Rp1,2 Juta', '1654352379859.jpg', 'Suasana pendaftaran BLT UMKM', 'Bantuan', '<p>Jumlah dana yang diterima pelaku usaha pada program BPUM 2021 ini yakni Rp1,2 juta kepada 9,8 juta UMKM. Angka ini berkurang dibandingkan dengan tahun lalu, yaitu Rp2,4 juta.</p><p>Untuk pengecekan program BPUM atau BLT UMKM dapat dilakukan melalui PT Bank Rakyat Indonesia (Persero) Tbk. tepatnya melalui e-form BRI.</p><p>Berikut cara cek penerima BPUM atau BLT UMKM :</p><ol><li>Klik e-form BRI (<a href=\"https://eform.bri.co.id/bpum\">https://eform.bri.co.id/bpum</a>)</li><li>Masukkan nomor KTP dan kode verifikasi</li><li>Klik proses inquiry</li><li>Jika sudah masuk, Anda akan menerima pemberitahuan apakah sudah mendapatkan bantuan atau tidak</li><li>Jika terdaftar sebagai penerima, pelaku usaha mikro bisa mendatangi kantor BRI untuk mencairkan BLT UMKM Rp 1,2 juta. Bantuan juga bisa langsung ditransfer ke rekening penerima.</li></ol><p>Syarat mencairkan BPUM atau BLT UMKM :</p><ol><li>Membawa buku tabungan</li><li>Membawa Kartu ATM</li><li>Membawa KTP</li><li>Membawa Surat Pernyataan yang ditandatangani oleh aparat Desa setempat</li><li>Notifikasi (SMS) pemberitahuan penerima Banpres Produktif (BPUM) sendiri tidak hanya terbatas pada mereka yang telah memiliki rekening BRI.</li></ol>', 'Admin', '3', '2022-06-04 07:19:39', '2022-06-04 07:19:39'),
(2, 4, 'Ingin Beli Batik? Ini Tips Memilih Batik Berkualitas Baik', '1654354786713.png', 'Canting yang digunakan untuk membatik', 'Tips', '<p>Jika kamu pecinta kain, khususnya batik, memilih kain batik yang berkualitas tinggi tentu menjadi nilai penting sebelum membeli kain tersebut. Kualitas kain batik akan berpengaruh terhadap kenyamanan saat memakainya. Umumnya semakin baik kualitas batik, harganya pun akan semakin tinggi. Jika kamu sebagai pemula masih bingung cara menentukan kualitas batik yang baik, berikut ini 5 cara yang harus kamu ketahui dalam memilih kain batik berkualitas tinggi.</p><p><strong>1. Ketahui jenis batik yang akan dibeli</strong></p><p>Sebelum membeli, perhatikan jenis batik yang kamu taksir. Ada jenis batik tulis dan batik cap atau cetak. Biasanya batik tulis memiliki kualitas yang lebih baik dibanding batik cap. Batik tulis memerlukan proses produksi yang lebih lama dan dibuat langsung dengan tangan sehingga lebih rumit serta membutuhkan keterampilan khusus.</p><p>Hal ini yang membuat batik tulis memiliki kualitas lebih dibanding batik cap. Batik tulis biasanya juga dibuat dengan jumlah terbatas yang membuatnya semakin ekslusif. Sementara batik cap dapat dibuat dalam jumlah banyak. Proses pembuatan batik tulis pun merupakan cara yang paling tradisional sehingga memiliki nilai historis dan estetika yang lebih.</p><p><strong>2. Bahan batik mempengaruhi kualitas kenyamanan</strong></p><p>Setiap kain batik memiliki jenis bahan berbeda-beda. Jenis bahan sangat mempengaruhi kualitas batik tersebut. Sebaiknya Pilih jenis bahan batik yang sesuai dengan kebutuhanmu, misalnya untuk acara formal atau pesta kamu bisa memilih bahan batik sutra.</p><p>Atau, untuk acara sehari-hari kamu bisa memilih batik berbahan katun yang mudah menyerap keringat. Selain itu ada banyak lagi jenis bahan yang biasa digunakan untuk pembuatan batik, seperti kain serat nanas, kain paris, dan kain mori. Semakin berkualitas jenis bahan mempengaruhi kualitas batik itu sendiri.</p>', 'Salsabila', '1', '2022-06-04 07:59:46', '2022-06-04 07:59:46');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2022_04_06_040550_create_users_table', 1),
(5, '2022_05_28_033749_create_berandas_table', 1),
(6, '2022_05_28_070819_create_galeris_table', 1),
(7, '2022_06_03_071300_create_konten_artikels_table', 1),
(8, '2022_06_03_071428_create_sosmeds_table', 1),
(9, '2022_06_03_071556_create_komentars_table', 1),
(11, '2022_06_04_123634_create_notifikasis_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notifikasis`
--

CREATE TABLE `notifikasis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_komentar` bigint(20) UNSIGNED NOT NULL,
  `id_artikel` bigint(20) UNSIGNED NOT NULL,
  `is_read_admin` tinyint(1) NOT NULL,
  `is_read_pemilik` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifikasis`
--

INSERT INTO `notifikasis` (`id`, `id_komentar`, `id_artikel`, `is_read_admin`, `is_read_pemilik`, `created_at`, `updated_at`) VALUES
(1, 11, 2, 1, 1, '2022-06-06 00:22:36', '2022-06-06 22:11:52'),
(2, 12, 2, 1, 1, '2022-06-06 01:02:11', '2022-06-06 22:11:52');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sosmeds`
--

CREATE TABLE `sosmeds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `nama_sosmed` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_sosmed` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sosmeds`
--

INSERT INTO `sosmeds` (`id`, `id_user`, `nama_sosmed`, `link_sosmed`, `created_at`, `updated_at`) VALUES
(1, 4, 'Google Maps', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.927950051231!2d112.26502371415322!3d-7.690881778285347!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e78683f8ad6959d%3A0xc235e054eccc95c7!2sKantor%20Kecamatan%20Ngoro!5e0!3m2!1sid!2sid!4v1654353804899!5m2!1sid!2sid\"', '2022-06-04 07:51:52', '2022-06-06 08:16:20'),
(2, 4, 'Instagram', 'https://www.instagram.com/salsabilaand__/', '2022-06-06 08:30:05', '2022-06-06 08:30:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_usaha` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_usaha` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_usaha` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `nama_usaha`, `jenis_usaha`, `alamat_usaha`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'portalusahamikrojbg@gmail.com', '$2y$10$rJG73XF6K55Dohcr26NZVuzyBW/WMga6wfUK.2hXRRxcMuvDYtVrO', '3', NULL, NULL, NULL, NULL, '2022-06-04 07:00:23', '2022-06-04 07:00:23'),
(3, 'Caca', 'salsabilarachmaaninda@gmail.com', '$2y$10$NW5NbWSbLiKEExAKre/nQOHlbSTEatX3AvhIIImpJgQ3lNdYzDVrW', '2', NULL, NULL, NULL, NULL, '2022-06-04 07:26:01', '2022-06-04 07:26:01'),
(4, 'Salsabila', 'salsabilarand@gmail.com', '$2y$10$ruOxgiu2Ujxyqe5hqkXSZuyt/3ZBS54QlDJaCagk11091qFMO/toa', '1', 'Batik Khas Jombang', 'Industri Pengolahan', 'Ngoro-Jombang', 'nglorot-kain-batik-cap-infopublik.id_.png', '2022-06-04 07:32:01', '2022-06-04 07:38:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berandas`
--
ALTER TABLE `berandas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `galeris`
--
ALTER TABLE `galeris`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `komentars`
--
ALTER TABLE `komentars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `komentars_id_user_foreign` (`id_user`),
  ADD KEY `komentars_id_artikel_foreign` (`id_artikel`);

--
-- Indexes for table `konten_artikels`
--
ALTER TABLE `konten_artikels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `konten_artikels_id_user_foreign` (`id_user`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifikasis`
--
ALTER TABLE `notifikasis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifikasis_id_komentar_foreign` (`id_komentar`),
  ADD KEY `notifikasis_id_artikel_foreign` (`id_artikel`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sosmeds`
--
ALTER TABLE `sosmeds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sosmeds_id_user_foreign` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `berandas`
--
ALTER TABLE `berandas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galeris`
--
ALTER TABLE `galeris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `komentars`
--
ALTER TABLE `komentars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `konten_artikels`
--
ALTER TABLE `konten_artikels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `notifikasis`
--
ALTER TABLE `notifikasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sosmeds`
--
ALTER TABLE `sosmeds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `komentars`
--
ALTER TABLE `komentars`
  ADD CONSTRAINT `komentars_id_artikel_foreign` FOREIGN KEY (`id_artikel`) REFERENCES `konten_artikels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `komentars_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `konten_artikels`
--
ALTER TABLE `konten_artikels`
  ADD CONSTRAINT `konten_artikels_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifikasis`
--
ALTER TABLE `notifikasis`
  ADD CONSTRAINT `notifikasis_id_artikel_foreign` FOREIGN KEY (`id_artikel`) REFERENCES `konten_artikels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notifikasis_id_komentar_foreign` FOREIGN KEY (`id_komentar`) REFERENCES `komentars` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sosmeds`
--
ALTER TABLE `sosmeds`
  ADD CONSTRAINT `sosmeds_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

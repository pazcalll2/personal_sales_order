-- Adminer 4.7.7 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

CREATE DATABASE `ecommerce_agsatu` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `ecommerce_agsatu`;

DROP TABLE IF EXISTS `agents`;
CREATE TABLE `agents` (
  `id` bigint(20) unsigned NOT NULL,
  `limit` bigint(20) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `agents_id_foreign` FOREIGN KEY (`id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `agents` (`id`, `limit`, `created_at`, `updated_at`) VALUES
(2,	1000000000,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(7,	2000000000,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19');

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categories_parent_id_foreign` (`parent_id`),
  CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `categories` (`id`, `name`, `parent_id`, `created_at`, `updated_at`) VALUES
(1,	'Makanan & Minuman',	NULL,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(2,	'Menu Sarapan',	1,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(3,	'Sereal',	2,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(4,	'Selai & Olesan',	2,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(5,	'Madu & Olesan',	2,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(6,	'Menu Sarapan Lainnya',	2,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(7,	'Roti & Kue',	1,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(8,	'Roti',	7,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(9,	'Kue Kering',	7,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(10,	'Bolu & Cake',	7,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(11,	'Susu & Olahan',	1,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(12,	'Susu Segar & Yoghurt',	11,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(13,	'Susu UHT',	11,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(14,	'Susu Bubuk',	11,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(15,	'Mentega & Margarin',	11,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(16,	'Keju',	11,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(17,	'Susu Kental Manis',	11,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(18,	'Susu & Olahan Lainnya',	11,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(19,	'Bahan Pokok',	1,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(20,	'Beras',	19,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(21,	'Minyak',	19,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(22,	'Telur',	19,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(23,	'Gula',	19,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(24,	'Mie Kering',	19,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(25,	'Pasta',	19,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(26,	'Kecap & Sambal',	19,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(27,	'Penyedap Rasa',	19,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(28,	'Tepung & Premix',	19,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(29,	'Bahan Baking',	19,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(30,	'Bahan Pokok Lainnya',	19,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(31,	'Makanan Kering',	19,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(32,	'Makanan Instan',	1,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(33,	'Mie & Pasta Instan',	32,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(34,	'Cemilan Instan',	32,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(35,	'Bumbu Instan',	32,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(36,	'Makanan Instan Lainnya',	32,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(37,	'Makanan Kaleng',	1,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(38,	'Makanan Kaleng Sayur',	37,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(39,	'Makanan Kaleng Daging',	37,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(40,	'Makanan Kaleng Buah',	37,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(41,	'Makanan Kaleng Hasil Laut',	37,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(42,	'Makanan Siap Saji',	1,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(43,	'Makanan Ringan',	1,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(44,	'Biskuit & Kue Kering',	43,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(45,	'Kripik & Kerupuk',	43,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(46,	'Kacang',	43,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(47,	'Biji-bijian',	43,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(48,	'Buah Kering',	43,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(49,	'Makanan Ringan Manis Lainnya',	43,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(50,	'Makanan Ringan Asin Lainnya',	43,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(51,	'Makanan Ringan Lainnya',	43,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(52,	'Makanan Beku',	1,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(53,	'Es Krim',	52,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(54,	'Makanan Asin Beku',	52,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(55,	'Makanan Manis Beku',	52,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(56,	'Makanan Beku Lainnya',	52,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(57,	'Cokelat & Permen',	1,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(58,	'Cokelat',	57,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(59,	'Permen',	57,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(60,	'Cokelat & Permen Lainnya',	57,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(61,	'Minuman',	1,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(62,	'Kopi',	61,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(63,	'Teh',	61,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(64,	'Jus & Sirup',	61,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(65,	'Minuman Nutrisi',	61,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(66,	'Minuman Soda',	61,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(67,	'Minuman Bubuk',	61,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(68,	'Makanan Segar',	1,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(69,	'Sayuran Segar',	68,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(70,	'Buah Segar',	68,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(71,	'Daging Segar',	68,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(72,	'Hasil Laut Segar',	68,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(73,	'Makanan & Minuman Lainnya',	1,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(74,	'Perawatan & Kecantikan',	NULL,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(75,	'Alat Kecantikan',	74,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(76,	'Brush',	75,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(77,	'Make Up Sponge',	75,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(78,	'Cetakan Alis',	75,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(79,	'Penjepit Bulu Mata',	75,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(80,	'Pinset & Silet',	75,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(81,	'Alat Perawat Wajah',	75,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(82,	'Penghilang Butu Rambut',	75,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(83,	'Rautan',	75,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(84,	'Alat Pelangsing',	75,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(85,	'Alat Kecantikan Lainnya',	75,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(86,	'Kosmetik Mata',	74,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(87,	'Primer Mata',	86,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(88,	'Eyebrow',	86,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(89,	'Eyeliner',	86,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(90,	'Eyeshadow',	86,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(91,	'Maskara',	86,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(92,	'Bulu Mata',	86,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(93,	'Skot Mata',	86,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(94,	'Kosmetik Mata Lainnya',	86,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(95,	'Kosmetik Wajah',	74,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(96,	'Primer',	95,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(97,	'BB & CC Cream',	95,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(98,	'Foundation',	95,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(99,	'Bedak',	95,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(100,	'Concealer',	95,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(101,	'Blush On',	95,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(102,	'Contour',	95,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(103,	'Highlighter',	95,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(104,	'Palette Wajah',	95,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(105,	'Setting Spray',	95,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(106,	'Kosmetik Wajah Lainnya',	95,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(107,	'Kosmetik Bibir',	74,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(108,	'Lipstik',	107,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(109,	'Lip Gloss',	107,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(110,	'Lip Liner',	107,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(111,	'Lip Tint',	107,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(112,	'Kosmetik Bibir Lainnya',	107,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(113,	'Alat Rambut',	74,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(114,	'Sisir',	113,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(115,	'Hair Dryer',	113,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(116,	'Catokan / Pengeriting Rambut',	113,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19');

DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `customers_id_foreign` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `customers` (`id`, `created_at`, `updated_at`) VALUES
(3,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19');

DROP TABLE IF EXISTS `drivers`;
CREATE TABLE `drivers` (
  `id` bigint(20) unsigned NOT NULL,
  `status` enum('ACTIVE','NON-ACTIVE') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `drivers_id_foreign` FOREIGN KEY (`id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `drivers` (`id`, `status`, `created_at`, `updated_at`) VALUES
(4,	'ACTIVE',	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(5,	'NON-ACTIVE',	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(6,	'ACTIVE',	'2021-09-04 10:27:12',	NULL);

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `forecasts`;
CREATE TABLE `forecasts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_product` bigint(20) unsigned NOT NULL,
  `id_agent` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `forecasts_id_product_foreign` (`id_product`),
  KEY `forecasts_id_agent_foreign` (`id_agent`),
  CONSTRAINT `forecasts_id_agent_foreign` FOREIGN KEY (`id_agent`) REFERENCES `agents` (`id`) ON DELETE CASCADE,
  CONSTRAINT `forecasts_id_product_foreign` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `images_product_id_foreign` (`product_id`),
  CONSTRAINT `images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `images` (`id`, `path`, `product_id`, `created_at`, `updated_at`) VALUES
(1,	'1.jpg',	1,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(2,	'2.jpg',	2,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(3,	'3.jpg',	3,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(4,	'4.jpg',	4,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(5,	'5.jpg',	5,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(6,	'6.jpg',	6,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(7,	'7.jpg',	7,	'2021-09-01 23:32:20',	'2021-09-01 23:32:20'),
(8,	'8.jpg',	8,	'2021-09-01 23:32:20',	'2021-09-01 23:32:20'),
(9,	'9.jpg',	9,	'2021-09-01 23:32:20',	'2021-09-01 23:32:20'),
(10,	'10.jpg',	10,	'2021-09-01 23:32:20',	'2021-09-01 23:32:20'),
(11,	'11.jpg',	11,	'2021-09-01 23:32:20',	'2021-09-01 23:32:20'),
(12,	'11.jpg',	12,	'2021-09-01 23:32:20',	'2021-09-01 23:32:20');

DROP TABLE IF EXISTS `log_stocks`;
CREATE TABLE `log_stocks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `stock_id` bigint(20) unsigned DEFAULT NULL,
  `type` enum('IN','OUT') COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `before` int(11) NOT NULL,
  `current` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `log_stocks_stock_id_foreign` (`stock_id`),
  CONSTRAINT `log_stocks_stock_id_foreign` FOREIGN KEY (`stock_id`) REFERENCES `stocks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `log_stocks` (`id`, `stock_id`, `type`, `note`, `before`, `current`, `created_at`, `updated_at`) VALUES
(1,	1,	'IN',	'Stock awal produk',	11,	11,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(2,	2,	'IN',	'Stock awal produk',	46,	46,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(3,	3,	'IN',	'Stock awal produk',	46,	46,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(4,	4,	'IN',	'Stock awal produk',	46,	46,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(5,	4,	'IN',	'Stock awal produk',	46,	46,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(6,	6,	'IN',	'Stock awal produk',	46,	46,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(7,	7,	'IN',	'Stock awal produk',	46,	46,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(8,	8,	'IN',	'Stock awal produk',	46,	46,	'2021-09-01 23:32:20',	'2021-09-01 23:32:20'),
(9,	9,	'IN',	'Stock awal produk',	46,	46,	'2021-09-01 23:32:20',	'2021-09-01 23:32:20'),
(10,	10,	'IN',	'Stock awal produk',	46,	46,	'2021-09-01 23:32:20',	'2021-09-01 23:32:20'),
(11,	11,	'IN',	'Stock awal produk',	46,	46,	'2021-09-01 23:32:20',	'2021-09-01 23:32:20'),
(12,	12,	'IN',	'Stock awal produk',	46,	46,	'2021-09-01 23:32:20',	'2021-09-01 23:32:20'),
(36,	2,	'OUT',	'Barang dibeli oleh AGENT dengan nama : PT. DeSh4dow',	100,	90,	'2021-09-12 03:13:37',	'2021-09-12 03:13:37'),
(37,	4,	'OUT',	'Barang dibeli oleh AGENT dengan nama : PT. DeSh4dow',	4687,	4667,	'2021-09-12 03:13:37',	'2021-09-12 03:13:37');

DROP TABLE IF EXISTS `mapping_menus`;
CREATE TABLE `mapping_menus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `group` enum('ALL','ADMINISTRATOR','AGENT','CUSTOMER') COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mapping_menus_menu_id_foreign` (`menu_id`),
  CONSTRAINT `mapping_menus_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `mapping_menus` (`id`, `group`, `menu_id`, `created_at`, `updated_at`) VALUES
(1,	'ALL',	1,	NULL,	NULL),
(2,	'ADMINISTRATOR',	2,	NULL,	NULL),
(3,	'ADMINISTRATOR',	3,	NULL,	NULL),
(4,	'ADMINISTRATOR',	4,	NULL,	NULL),
(5,	'ADMINISTRATOR',	5,	NULL,	NULL),
(6,	'ADMINISTRATOR',	6,	NULL,	NULL),
(7,	'ADMINISTRATOR',	7,	NULL,	NULL),
(8,	'ADMINISTRATOR',	8,	NULL,	NULL),
(9,	'ADMINISTRATOR',	9,	NULL,	NULL),
(10,	'ADMINISTRATOR',	10,	NULL,	NULL),
(11,	'ALL',	11,	NULL,	NULL),
(12,	'ALL',	13,	NULL,	NULL),
(13,	'ALL',	14,	NULL,	NULL),
(14,	'ALL',	15,	NULL,	NULL),
(15,	'ALL',	16,	NULL,	NULL),
(16,	'ALL',	17,	NULL,	NULL),
(17,	'ALL',	18,	NULL,	NULL),
(18,	'ALL',	19,	NULL,	NULL),
(19,	'ADMINISTRATOR',	22,	NULL,	NULL),
(20,	'ADMINISTRATOR',	23,	NULL,	NULL),
(21,	'ADMINISTRATOR',	24,	NULL,	NULL),
(22,	'ADMINISTRATOR',	25,	NULL,	NULL),
(23,	'ADMINISTRATOR',	26,	'2021-09-08 01:22:55',	NULL);

DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent` bigint(20) unsigned DEFAULT NULL,
  `urutan` int(11) NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `menus` (`id`, `nama`, `link`, `parent`, `urutan`, `icon`, `created_at`, `updated_at`) VALUES
(1,	'Dashboard',	'/dashboard',	NULL,	1,	'a',	NULL,	NULL),
(2,	'Setting',	'',	NULL,	200,	'a',	NULL,	NULL),
(3,	'Menu',	'/dashboard/menu',	2,	202,	'a',	NULL,	NULL),
(4,	'User',	'/dashboard/user',	2,	203,	'a',	NULL,	NULL),
(5,	'Produk',	'',	NULL,	110,	'a',	NULL,	NULL),
(6,	'Tambah Produk',	'/dashboard/produk/create',	5,	111,	'a',	NULL,	NULL),
(7,	'Data Produk',	'/dashboard/produk',	5,	112,	'a',	NULL,	NULL),
(8,	'Pesanan',	'',	NULL,	120,	'a',	NULL,	NULL),
(9,	'Pesanan Masuk',	'/dashboard/order/purchase-order',	8,	121,	'a',	NULL,	NULL),
(10,	'Perintah Kirim',	'/dashboard/order/perintah-kirim',	8,	122,	'a',	NULL,	NULL),
(11,	'Pesanan Ditunda',	'/dashboard/order/pending',	8,	123,	'a',	NULL,	NULL),
(13,	'Return',	'',	NULL,	130,	'a',	NULL,	NULL),
(14,	'Pengajuan Return',	'/dashboard/return/pesanan',	13,	131,	'a',	NULL,	NULL),
(15,	'Approval Return',	'/dashboard/return/approval',	13,	132,	'a',	NULL,	NULL),
(16,	'Tagihan',	'',	NULL,	140,	'a',	NULL,	NULL),
(17,	'Kirim Tagihan',	'dashboard/order/tagihan',	16,	141,	'a',	NULL,	NULL),
(18,	'Lihat Tagihan',	'/dashboard/return/approval',	16,	142,	'a',	NULL,	NULL),
(19,	'Bayar Tagihan',	'/dashboard/return/approval',	16,	143,	'a',	NULL,	NULL),
(22,	'Riwayat Pesanan',	'/dashboard/order/riwayat',	8,	125,	'a',	NULL,	NULL),
(23,	'Merek',	'/dashboard/master/merek',	2,	203,	'a',	NULL,	NULL),
(24,	'Kategori',	'/dashboard/master/kategori',	2,	204,	'a',	NULL,	NULL),
(25,	'Inventory',	'/dashboard/produk/inventory/stock',	5,	113,	'a',	NULL,	NULL),
(26,	'Pesanan Dalam Proses',	'/dashboard/order/proses',	8,	124,	'a',	'2021-09-08 01:22:17',	NULL);

DROP TABLE IF EXISTS `mereks`;
CREATE TABLE `mereks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_merek` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1,	'2014_10_12_000000_create_users_table',	1),
(2,	'2014_10_12_100000_create_password_resets_table',	1),
(3,	'2019_08_19_000000_create_failed_jobs_table',	1),
(4,	'2021_04_06_024711_create_agents_table',	1),
(5,	'2021_04_06_024903_create_customers_table',	1),
(6,	'2021_04_06_025121_create_products_table',	1),
(7,	'2021_04_06_025228_create_stocks_table',	1),
(8,	'2021_04_06_025455_create_purchase_orders_table',	1),
(9,	'2021_04_06_025744_create_orders_table',	1),
(10,	'2021_04_06_025853_create_pending_orders_table',	1),
(11,	'2021_04_06_025943_create_purchases_table',	1),
(12,	'2021_04_06_030029_create_forecasts_table',	1),
(13,	'2021_04_08_024031_create_menus_table',	1),
(14,	'2021_04_08_024233_create_mapping_menus_table',	1),
(15,	'2021_04_16_020435_create_images_table',	1),
(16,	'2021_05_03_030708_create_drivers_table',	1),
(17,	'2021_05_03_030709_create_trackings_table',	1),
(18,	'2021_05_03_075442_create_mereks_table',	1),
(19,	'2021_05_06_053454_create_log_stocks_table',	1),
(20,	'2021_09_07_015529_create_tagihan_table',	2),
(21,	'2021_09_09_024705_create_payment_table',	3),
(22,	'2021_09_09_034611_alter_tb_orders',	4);

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `po_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `qty` int(11) NOT NULL,
  `status` enum('AWAL PESAN','BELUM DISETUJUI','DISETUJUI SEBAGIAN','DISETUJUI SEMUA','PENDING','SENT','RETURN') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'AWAL PESAN',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tagihan_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_po_id_foreign` (`po_id`),
  KEY `orders_product_id_foreign` (`product_id`),
  KEY `tagihan_id` (`tagihan_id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`tagihan_id`) REFERENCES `tagihans` (`id`) ON DELETE SET NULL,
  CONSTRAINT `orders_po_id_foreign` FOREIGN KEY (`po_id`) REFERENCES `purchase_orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `orders_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `orders` (`id`, `po_id`, `product_id`, `qty`, `status`, `created_at`, `updated_at`, `tagihan_id`) VALUES
(57,	14,	2,	20,	'AWAL PESAN',	'2021-09-11 17:37:59',	'2021-09-11 17:37:59',	NULL),
(58,	14,	2,	10,	'DISETUJUI SEBAGIAN',	'2021-09-11 17:37:59',	'2021-09-12 01:38:43',	14),
(59,	14,	4,	20,	'AWAL PESAN',	'2021-09-11 17:37:59',	'2021-09-11 17:37:59',	NULL),
(60,	14,	4,	20,	'DISETUJUI SEMUA',	'2021-09-11 17:37:59',	'2021-09-12 01:38:43',	14),
(62,	14,	2,	10,	'PENDING',	'2021-09-12 01:36:01',	'2021-09-12 01:36:01',	NULL),
(75,	14,	2,	9,	'RETURN',	'2021-09-13 00:56:23',	'2021-09-13 00:56:23',	14);

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `po_id` bigint(20) unsigned NOT NULL,
  `tagihan_id` bigint(20) unsigned NOT NULL,
  `nominal_bayar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valid` tinyint(1) NOT NULL,
  `bukti_tf` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payment_po_id_foreign` (`po_id`),
  KEY `tagihan_id` (`tagihan_id`),
  CONSTRAINT `payment_po_id_foreign` FOREIGN KEY (`po_id`) REFERENCES `purchase_orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`tagihan_id`) REFERENCES `tagihans` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `pending_orders`;
CREATE TABLE `pending_orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` double NOT NULL,
  `merek` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` bigint(20) unsigned DEFAULT NULL,
  `jenis_berbahaya` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ditampilkan` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_kategori_foreign` (`kategori`),
  CONSTRAINT `products_kategori_foreign` FOREIGN KEY (`kategori`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `products` (`id`, `nama`, `deskripsi`, `harga`, `merek`, `kategori`, `jenis_berbahaya`, `ditampilkan`, `created_at`, `updated_at`) VALUES
(1,	'Body Shop Original parfum',	'1',	199000,	'The Body Shop',	2,	'YA',	0,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(2,	'Apple iPhone 12 Pro Max 128GB, Pacific Blue',	'Model HP : iPhone 12 Pro MaxKapasitas : 128GBTipe Kartu SIM : NanoKamera Depan : 12 MPKamera Belakang : 12 MP RAM : 6GB Ukuran Layar : 6, 7 inci Tipe Garansi : Garansi Resmi Warna : Pacific Blue Dimensi : 17,9 x 9, 7 x 2 9 cm Periode Garansi : 1 tahun Isi Kotak : � iPhone dengan iOS 14.� Kabel USB-C ke Lightning.� Buku Manual dan Dokumentasi lain.',	20499000,	'Iphone',	3,	'TIDAK',	0,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(3,	'Love Beauty & Planet Pure And Positive, Tea Tree Oil & Vetiver Body Wash 400Ml',	'Pure & Positive body wash kami memadukan kandungan Tea Tree Oil dengan keharuman mewah Vetiver, yang membersihkan polutan yang menempel pada tubuhmu dengan lembut, membuatmu merasa segar dan cantik alami. Body Wash ini dikemas dalam 100% botol daur ulang, vegan-certified, cruelty free, bebas dari pewarna, silikon, dan paraben. BPOM NA49180701747 Shelf Life 2 Tahun',	41700,	'Love Beauty & Planet',	15,	'TIDAK',	0,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(4,	'SYIFA VEST BASIC',	'Material Cotton Waffle All Size Fit To L Detail size: Ld / lingkar dada: 114cm Panjang baju bagian depan (dengan rib depan): 58cm Panjang baju bagian belakang (dengan rib belakang): 64cm Lingkar tangan: 60cm Lingkar leher vest: 68cm',	56788,	'Tidak Ada Merek',	20,	'TIDAK',	0,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(5,	'Roro Mendut Red Jelly Sleeping Mask',	'ORIGINAL RORO MENDUT RED JELLY Glowing Skincare Booster NA18200103743 Merupakan gel berbahan dasar herbal untuk perawatan kulit normal/ kering di pa gi & malam hari yang difokuskan untuk menjadikan kulit tampak lebih cerah, glowing dan lembut. Dapat digunakan: Wajah / TubuhMengandung Ekstrak Rosehip dan Aloe Vera Apa saja manfaat Red Jelly: - Mencerahkan - Menyamarkan noda hitam - Menjadikan kulit terasa lebih kencang - Meningkatkan elastisitas kulit - Menyamarkan pori-pori - Memberikan hidrasi pada kulit - Menjadikan kulit terasa lebih lembut Cara Penggunaan: 1. Pastikan kulit dalam kondisi bersih 2. Aplikasikan toner untuk memaksimalkan penyerapan nutrisi krim dan memudahkan pengaplikasian. 3. Ambil gel dan aplikasikan tipis-tipis secara merata 4. Lakukan hal rutin setiap pagi dan malam',	148410,	'Roro Mendut',	25,	'TIDAK',	0,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(6,	'Sandal Casual Pria Wanita Gunung Hiking Haji dan Umrah Jack V3 LAF Project',	'Material yang kami gunakan adalah material Premium.',	199000,	'LAF Project',	30,	'TIDAK',	0,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(7,	'KULOT JEANS',	'Bahan : jeans wash. All size fit to L. L.pingga : 60cm bisa melar sampai 70cm,( bagian belakang karet). L.paha : 54cm. Pj : 90cm',	265000,	'H&M',	32,	'TIDAK',	0,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(8,	'DAMELIA AZALEA SANDALS',	'Bergaransi 30 Hari. Alas super empuk, tidak akan kempes saat digunakan karena menggunakan Double Foam yang premium. Sol menggunakan non-slip sol, tidak akan licin.',	90000,	'Damelia',	33,	'TIDAK',	0,	'2021-09-01 23:32:20',	'2021-09-01 23:32:20'),
(9,	'Logitech B170 Wireless Mouse',	'Jenis Koneksi: 2.4 Ghz wireless. Jangkauan wireless: 10 m (32 kaki). Baterai: 1 x AA. Daya tahan baterai: 1 tahun.',	100000,	'Logitech',	40,	'TIDAK',	0,	'2021-09-01 23:32:20',	'2021-09-01 23:32:20'),
(10,	'COSRX AHA/BHA Clarifying Treatment Toner 150ml',	'pH Level 3.9 sesuai untuk AHA & BHA untuk bekerja dengan efektif. Eksfoliasi yang dapat digunakan sehari-hari, mencegah komedo. Membersihkan pori-pori dan menyeimbangkan kulit.',	120900,	'COSRX',	50,	'TIDAK',	0,	'2021-09-01 23:32:20',	'2021-09-01 23:32:20'),
(11,	'Lip Glaze BLP - Cranberry Cobbler',	'Let your lips take center stage with Cranberry Cobbler. The applicator allows you to shape and color your lips with this bold note at ease. This one is inspired by the crowd favorite, Burnt Cinnamon.',	139000,	'BLP Beauty',	50,	'TIDAK',	0,	'2021-09-01 23:32:20',	'2021-09-01 23:32:20'),
(12,	'Lip Glaze BLP - Cranberry Sober',	'Let your lips take center stage with Cranberry Cobbler. The applicator allows you to shape and color your lips with this bold note at ease. This one is inspired by the crowd favorite, Burnt Cinnamon.',	139000,	'BLP Beauty',	60,	'TIDAK',	0,	'2021-09-01 23:32:20',	'2021-09-01 23:32:20');

DROP TABLE IF EXISTS `purchases`;
CREATE TABLE `purchases` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `po_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `purchases_po_id_foreign` (`po_id`),
  CONSTRAINT `purchases_po_id_foreign` FOREIGN KEY (`po_id`) REFERENCES `purchase_orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `purchase_orders`;
CREATE TABLE `purchase_orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `no_nota` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from` bigint(20) unsigned DEFAULT NULL COMMENT 'pengirim (gudang)',
  `user_id` bigint(20) unsigned NOT NULL COMMENT 'pembeli',
  `jatuh_tempo` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `purchase_orders_user_id_foreign` (`user_id`),
  CONSTRAINT `purchase_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `purchase_orders` (`id`, `no_nota`, `from`, `user_id`, `jatuh_tempo`, `created_at`, `updated_at`) VALUES
(14,	'ORD-VG5jOVBRPT0=20210912003759',	NULL,	7,	'2021-09-17 17:00:00',	'2021-09-11 17:37:59',	'2021-09-12 03:13:37');

DROP TABLE IF EXISTS `stocks`;
CREATE TABLE `stocks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stocks_user_id_foreign` (`user_id`),
  KEY `stocks_product_id_foreign` (`product_id`),
  CONSTRAINT `stocks_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `stocks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `stocks` (`id`, `user_id`, `product_id`, `stock`, `created_at`, `updated_at`) VALUES
(1,	1,	1,	110,	'2021-09-01 23:32:19',	'2021-09-09 20:59:34'),
(2,	1,	2,	100,	'2021-09-01 23:32:19',	'2021-09-12 03:13:37'),
(3,	1,	3,	90,	'2021-09-01 23:32:19',	'2021-09-09 20:59:34'),
(4,	1,	4,	4687,	'2021-09-01 23:32:19',	'2021-09-12 03:13:37'),
(5,	1,	5,	1711,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(6,	1,	6,	13,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(7,	1,	7,	828,	'2021-09-01 23:32:19',	'2021-09-01 23:32:19'),
(8,	1,	8,	1013,	'2021-09-01 23:32:20',	'2021-09-01 23:32:20'),
(9,	1,	9,	9049,	'2021-09-01 23:32:20',	'2021-09-01 23:32:20'),
(10,	1,	10,	199,	'2021-09-01 23:32:20',	'2021-09-01 23:32:20'),
(11,	1,	11,	643,	'2021-09-01 23:32:20',	'2021-09-01 23:32:20'),
(12,	1,	12,	643,	'2021-09-01 23:32:20',	'2021-09-01 23:32:20');

DROP TABLE IF EXISTS `tagihans`;
CREATE TABLE `tagihans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `po_id` bigint(20) unsigned NOT NULL,
  `driver_id` bigint(20) unsigned DEFAULT NULL,
  `nominal_total` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('BELUM DIBAYAR','DIBAYAR SEBAGIAN','LUNAS') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tagihan_po_id_foreign` (`po_id`),
  KEY `driver_id` (`driver_id`),
  CONSTRAINT `tagihan_po_id_foreign` FOREIGN KEY (`po_id`) REFERENCES `purchase_orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tagihans_ibfk_1` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `tagihans` (`id`, `po_id`, `driver_id`, `nominal_total`, `status`, `created_at`, `updated_at`) VALUES
(14,	14,	4,	'206125760',	'BELUM DIBAYAR',	'2021-09-12 01:38:43',	'2021-09-12 03:13:37');

DROP TABLE IF EXISTS `trackings`;
CREATE TABLE `trackings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `status` enum('WAITING TO PICKUP','SENDING','ARRIVED','ARRIVED WITH RETURN') COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` enum('AGENT','CUSTOMER') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tagihan_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tagihan_id` (`tagihan_id`),
  CONSTRAINT `trackings_ibfk_2` FOREIGN KEY (`tagihan_id`) REFERENCES `tagihans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `trackings` (`id`, `status`, `target`, `created_at`, `updated_at`, `tagihan_id`) VALUES
(47,	'WAITING TO PICKUP',	'AGENT',	'2021-09-12 03:13:37',	'2021-09-12 03:13:37',	14),
(48,	'SENDING',	'AGENT',	'2021-09-12 23:47:25',	'2021-09-12 23:47:25',	14),
(52,	'ARRIVED WITH RETURN',	'AGENT',	'2021-09-13 00:56:23',	'2021-09-13 00:56:23',	14);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_handphone` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_id` enum('ADMINISTRATOR','AGENT','CUSTOMER','DRIVER') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `address`, `no_handphone`, `email`, `password`, `group_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1,	'Barokah Lancar Jaya',	'Jl Soehat, Jakarta',	'0812345678910',	'barokah@gmail.com',	'$2b$10$BXLVQH7sPvyh8UzaRuTL/OqMEVzeBylM110FL1yi8R02w.eXUzX1.',	'ADMINISTRATOR',	'wV3c6CBO0vGsz2eaLdsRWsuSCOikkx9LZifnuDIXkb2fWbJ3vmxzDLXQBdaF',	NULL,	NULL),
(2,	'Seru Lancar Jaya',	'Jl Soehat, Kediri',	'0812345678910',	'lancar@gmail.com',	'$2b$10$BXLVQH7sPvyh8UzaRuTL/OqMEVzeBylM110FL1yi8R02w.eXUzX1.',	'AGENT',	'o7hUmPs1TveaRNrL49Iku9oi3c39AuhBy3ZoDUDLenuhtZ1YBgOauWmn3YTr',	NULL,	NULL),
(3,	'Barokjaya',	'Jl Soehat, Malang',	'0812345678910',	'barok@gmail.com',	'$2b$10$BXLVQH7sPvyh8UzaRuTL/OqMEVzeBylM110FL1yi8R02w.eXUzX1.',	'CUSTOMER',	NULL,	NULL,	NULL),
(4,	'Mulyono Santosa',	'Jl Soehat, Bengkulu',	'0812345678910',	'mulyono@gmail.com',	'$2b$10$BXLVQH7sPvyh8UzaRuTL/OqMEVzeBylM110FL1yi8R02w.eXUzX1.',	'DRIVER',	NULL,	NULL,	NULL),
(5,	'Dodit Santoso',	'Jl Soehat, Sidoarjo',	'0812345678910',	'dodit@gmail.com',	'$2b$10$BXLVQH7sPvyh8UzaRuTL/OqMEVzeBylM110FL1yi8R02w.eXUzX1.',	'DRIVER',	NULL,	NULL,	NULL),
(6,	'Hari Setyadi',	'kediri',	'0812345678911',	'hari@gmail.com',	'$2b$10$BXLVQH7sPvyh8UzaRuTL/OqMEVzeBylM110FL1yi8R02w.eXUzX1.',	'DRIVER',	NULL,	'2021-09-04 10:25:18',	NULL),
(7,	'PT. Arya Abadi',	'Dsn di Kediri',	'089666171252',	'arya@gmail.com',	'$2b$10$BXLVQH7sPvyh8UzaRuTL/OqMEVzeBylM110FL1yi8R02w.eXUzX1.',	'AGENT',	NULL,	'2021-09-06 01:27:29',	NULL);

-- 2021-09-13 08:00:30

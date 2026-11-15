SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+07:00";

CREATE DATABASE IF NOT EXISTS `db_si_framework` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_si_framework`;

DROP TABLE IF EXISTS `user_role`;
CREATE TABLE `user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Member / Teknisi');

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL DEFAULT 'default.svg',
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT 1,
  `date_created` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(1, 'Biyan F R', 'admin@siframework.ac.id', 'default.svg', '$2y$12$MRzinpmmRzLYDtX1W/y9ZO/PuDx8ryH1LnrMN2zv6hLJshwyZkN8e', 1, 1, 1763180000),
(2, 'Teknisi Jaringan IT', 'teknisi@siframework.ac.id', 'default.svg', '$2y$12$MRzinpmmRzLYDtX1W/y9ZO/PuDx8ryH1LnrMN2zv6hLJshwyZkN8e', 2, 1, 1763180000);

DROP TABLE IF EXISTS `user_menu`;
CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Menu'),
(4, 'Inventaris'),
(5, 'Materi');

DROP TABLE IF EXISTS `user_sub_menu`;
CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `menu_id` (`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 1, 'Role & Hak Akses', 'admin/role', 'fas fa-fw fa-user-shield', 1),
(3, 2, 'Profil Saya', 'user', 'fas fa-fw fa-user', 1),
(4, 2, 'Edit Profil', 'user/edit', 'fas fa-fw fa-user-edit', 1),
(5, 2, 'Ubah Password', 'user/changepassword', 'fas fa-fw fa-key', 1),
(6, 3, 'Menu Management', 'menu', 'fas fa-fw fa-folder', 1),
(7, 3, 'Submenu Management', 'menu/submenu', 'fas fa-fw fa-folder-open', 1),
(8, 4, 'Data Inventaris IT (CRUD)', 'inventaris', 'fas fa-fw fa-network-wired', 1),
(9, 4, 'Laporan Inventaris', 'inventaris/laporan', 'fas fa-fw fa-print', 1),
(10, 5, 'Modul 7 Materi Kuliah', 'materi', 'fas fa-fw fa-graduation-cap', 1);

DROP TABLE IF EXISTS `user_access_menu`;
CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 2, 2),
(7, 2, 4),
(8, 2, 5);

DROP TABLE IF EXISTS `inventaris_it`;
CREATE TABLE `inventaris_it` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(32) NOT NULL,
  `nama_barang` varchar(150) NOT NULL,
  `kategori` varchar(64) NOT NULL,
  `lokasi` varchar(128) NOT NULL,
  `jumlah` int(11) NOT NULL DEFAULT 1,
  `kondisi` enum('Baik','Perlu Perbaikan','Rusak') NOT NULL DEFAULT 'Baik',
  `spesifikasi` text DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode_barang` (`kode_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `inventaris_it` (`id`, `kode_barang`, `nama_barang`, `kategori`, `lokasi`, `jumlah`, `kondisi`, `spesifikasi`, `updated_at`) VALUES
(1, 'INV-NET-001', 'Router MikroTik RB450Gx4 Gigabit', 'Router & Firewall', 'Ruang Server Utama Lt. 2', 4, 'Baik', '5 Port Gigabit Ethernet, Dual Core 716MHz, RAM 1GB, RouterOS Level 5, Konfigurasi VLAN & Hotspot.', '2026-11-15 08:30:00'),
(2, 'INV-CCTV-002', 'Hikvision NVR 16 Channel DS-7616NI-K2', 'CCTV & Keamanan', 'Pos Monitoring Keamanan', 2, 'Baik', '16 Channel IP Camera Input, Resolusi hingga 8MP, 2 SATA Interfaces (HDD 8TB Terpasang), HDMI/VGA Output.', '2026-11-15 09:00:00'),
(3, 'INV-CCTV-003', 'IP Camera Outdoor Hikvision Bullet 4MP PoE', 'CCTV & Keamanan', 'Tiang Highmast Area Parkir & Gerbang', 12, 'Baik', 'Resolusi 2560x1440, IR Night Vision 30m, Weatherproof IP67, Power over Ethernet (802.3af).', '2026-11-15 09:15:00'),
(4, 'INV-WLS-004', 'Ubiquiti LiteBeam M5 23dBi Outdoor CPE', 'Wireless & Radio', 'Tower Rooftop Gedung A (30 Meter)', 6, 'Baik', '5GHz Point-to-Point Wireless Bridge, 23dBi High-Gain Directional Antenna, AirMAX Technology.', '2026-11-15 09:45:00'),
(5, 'INV-FO-005', 'Kabel Fiber Optic Dropcore 1 Core Precon 150m', 'Fiber Optic & Kabel', 'Gudang Teknisi Lapangan', 15, 'Baik', 'Single Mode G.657A, Konektor SC-UPC terpasang pabrik, Kawat Seling Baja Messenger.', '2026-11-15 10:00:00'),
(6, 'INV-TOOL-006', 'Mini OTDR Fiber Optic Tester Multi-Fungsi', 'Alat Ukur & Teknisi', 'Ruang Teknisi Jaringan', 2, 'Perlu Perbaikan', 'Wavelength 1310/1550nm, OPM, VFL 10mW, Layar LCD 4.3 Inch (Perlu kalibrasi konektor adapter SC).', '2026-11-15 10:30:00'),
(7, 'INV-SW-007', 'Switch Managed PoE+ 24 Port Gigabit', 'Switch & Distribution', 'Panel Rak Server Gedung B', 3, 'Baik', '24 Port 10/100/1000Mbps PoE+ (Budget 250W) + 4 Slot SFP Uplink Fiber Optic, Support 802.1Q VLAN.', '2026-11-15 11:00:00');

COMMIT;

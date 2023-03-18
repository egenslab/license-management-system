-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2021 at 08:54 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `unflip_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tenant_id` int(25) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `tenant_id`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 8, 'egnotifications@gmail.com', '$2a$12$nmkDI3UJjED5fmMutkr5Eu4hV997zoYxSE/6gZn48JgdD4opGj6P.', NULL, NULL),
(2, 7, 'zahid@gmail.com', '$2a$12$nmkDI3UJjED5fmMutkr5Eu4hV997zoYxSE/6gZn48JgdD4opGj6P.', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `licenses`
--

CREATE TABLE `licenses` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `username` varchar(150) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `license_key` varchar(250) DEFAULT NULL,
  `user_type` varchar(150) DEFAULT NULL,
  `ip_details` text DEFAULT NULL,
  `website_url` text DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0 COMMENT '1=used,0=disbale',
  `plugin_activated_status` tinyint(10) DEFAULT NULL COMMENT '1=yes,2=no',
  `plugin_version` varchar(250) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `json` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `licenses`
--

INSERT INTO `licenses` (`id`, `name`, `email`, `username`, `image`, `license_key`, `user_type`, `ip_details`, `website_url`, `status`, `plugin_activated_status`, `plugin_version`, `created_at`, `updated_at`, `json`) VALUES
(1, 'Ema Smith', 'zahid@nestedit.com', 'ema0264', 'http://127.0.0.1:8000/assets/media/avatars/150-1.jpg', 'FXDSDXDFDXXSDDSD', 'administrator', '120.10.154.4', 'http://127.0.0.1:8000/admin/license', 1, 1, NULL, '2021-12-02 03:18:31', '2021-12-02 03:18:31', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `licenses`
--
ALTER TABLE `licenses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `licenses`
--
ALTER TABLE `licenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

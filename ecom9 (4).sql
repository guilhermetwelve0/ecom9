-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 08/07/2023 às 01:40
-- Versão do servidor: 10.4.27-MariaDB
-- Versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ecom9`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `admins`
--

INSERT INTO `admins` (`id`, `name`, `type`, `vendor_id`, `mobile`, `email`, `password`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Guilherme Cabral', 'superadmin', 0, '41995372945', 'admin@admin.com', '$2y$10$B3uGX7mGP24OutDq.9hZzOVYspdzKSnamJ4dslOFShS9pBF8mvvAW', '11309.png', 1, NULL, '2023-07-08 02:19:37'),
(2, 'John', 'vendor', 1, '97000000000', 'john@admin.com', '$2y$10$hBsyT23Qynl7iEH21EdkdOWxZulRLG3c5Rr6ScvZeA86TYM3fXI7a', '46773.jpg', 1, NULL, '2023-07-08 02:21:10');

-- --------------------------------------------------------

--
-- Estrutura para tabela `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `alt` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `banners`
--

INSERT INTO `banners` (`id`, `image`, `type`, `link`, `title`, `alt`, `status`, `created_at`, `updated_at`) VALUES
(1, '18904.png', 'Slider', 'spring-collection', 'spring-collection', 'spring-collection', 1, NULL, '2023-06-24 03:03:38'),
(2, '69122.png', 'Slider', 'tops', 'tops', 'tops', 1, NULL, '2023-06-24 03:46:33'),
(5, '63014.png', 'Fix', 'men', 'men', 'men', 1, '2023-06-23 23:31:58', '2023-06-24 03:17:07'),
(6, '84823.png', 'Fix', 'test', 'test', 'test', 1, '2023-06-24 03:51:27', '2023-06-24 04:09:10');

-- --------------------------------------------------------

--
-- Estrutura para tabela `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `brands`
--

INSERT INTO `brands` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Arrow', 1, NULL, '2023-06-17 23:14:20'),
(2, 'Gap', 1, NULL, '2023-06-17 20:42:02'),
(3, 'Lee', 1, NULL, '2023-06-17 20:42:04'),
(4, 'Samsung', 1, NULL, '2023-06-17 20:42:05'),
(5, 'LG', 1, NULL, '2023-05-07 00:20:01'),
(6, 'Lenovo', 1, NULL, NULL),
(7, 'MI', 1, NULL, '2023-06-17 20:42:07'),
(8, 'Others', 1, '2023-05-07 00:40:10', '2023-05-07 00:40:10');

-- --------------------------------------------------------

--
-- Estrutura para tabela `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_image` varchar(255) DEFAULT NULL,
  `category_discount` float NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `url` varchar(255) NOT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `section_id`, `category_name`, `category_image`, `category_discount`, `description`, `url`, `meta_title`, `meta_description`, `meta_keywords`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 'Men', '', 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', 'men', NULL, NULL, NULL, 1, NULL, '2023-07-01 03:08:23'),
(2, 0, 1, 'Women', '', 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', 'women', NULL, NULL, NULL, 1, NULL, '2023-07-01 02:57:53'),
(3, 0, 1, 'Kids', '', 0, '', 'kids', '', '', '', 1, NULL, '2023-05-04 01:35:58'),
(4, 0, 2, 'Mobiles', '', 10, NULL, 'mobiles', 'mobiles', 'mobiles', 'mobiles', 1, '2023-04-21 15:32:10', '2023-06-17 02:27:32'),
(5, 4, 2, 'Smartphones', '', 10, NULL, 'smartphones', 'smartphones', 'smartphones', 'smartphones', 1, '2023-04-21 18:41:13', '2023-06-17 02:28:15'),
(6, 1, 1, 'T-Shirts', '', 10, NULL, 'tshirts', 'tshirts', 'tshirts', 'tshirts', 1, '2023-04-21 20:02:41', '2023-07-01 02:53:17'),
(7, 1, 1, 'Shirts', '', 0, NULL, 'shirts', NULL, NULL, NULL, 1, '2023-05-04 01:13:16', '2023-05-04 01:13:16'),
(8, 2, 1, 'Tops', '', 0, NULL, 'tops', NULL, NULL, NULL, 1, '2023-05-04 01:30:57', '2023-05-04 01:30:57'),
(10, 0, 3, 'Refrigerators', '', 0, NULL, 'refrigerators', 'Refrigerators', NULL, NULL, 1, '2023-06-17 02:47:47', '2023-06-17 02:47:47');

-- --------------------------------------------------------

--
-- Estrutura para tabela `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `country_name` varchar(100) NOT NULL DEFAULT '',
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `countries`
--

INSERT INTO `countries` (`id`, `country_code`, `country_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'AF', 'Afghanistan', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(2, 'AL', 'Albania', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(3, 'DZ', 'Algeria', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(4, 'DS', 'American Samoa', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(5, 'AD', 'Andorra', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(6, 'AO', 'Angola', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(7, 'AI', 'Anguilla', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(8, 'AQ', 'Antarctica', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(9, 'AG', 'Antigua and Barbuda', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(10, 'AR', 'Argentina', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(11, 'AM', 'Armenia', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(12, 'AW', 'Aruba', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(13, 'AU', 'Australia', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(14, 'AT', 'Austria', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(15, 'AZ', 'Azerbaijan', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(16, 'BS', 'Bahamas', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(17, 'BH', 'Bahrain', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(18, 'BD', 'Bangladesh', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(19, 'BB', 'Barbados', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(20, 'BY', 'Belarus', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(21, 'BE', 'Belgium', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(22, 'BZ', 'Belize', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(23, 'BJ', 'Benin', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(24, 'BM', 'Bermuda', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(25, 'BT', 'Bhutan', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(26, 'BO', 'Bolivia', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(27, 'BA', 'Bosnia and Herzegovina', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(28, 'BW', 'Botswana', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(29, 'BV', 'Bouvet Island', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(30, 'BR', 'Brazil', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(31, 'IO', 'British Indian Ocean Territory', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(32, 'BN', 'Brunei Darussalam', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(33, 'BG', 'Bulgaria', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(34, 'BF', 'Burkina Faso', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(35, 'BI', 'Burundi', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(36, 'KH', 'Cambodia', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(37, 'CM', 'Cameroon', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(38, 'CA', 'Canada', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(39, 'CV', 'Cape Verde', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(40, 'KY', 'Cayman Islands', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(41, 'CF', 'Central African Republic', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(42, 'TD', 'Chad', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(43, 'CL', 'Chile', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(44, 'CN', 'China', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(45, 'CX', 'Christmas Island', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(46, 'CC', 'Cocos (Keeling) Islands', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(47, 'CO', 'Colombia', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(48, 'KM', 'Comoros', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(49, 'CD', 'Democratic Republic of the Congo', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(50, 'CG', 'Republic of Congo', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(51, 'CK', 'Cook Islands', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(52, 'CR', 'Costa Rica', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(53, 'HR', 'Croatia (Hrvatska)', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(54, 'CU', 'Cuba', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(55, 'CY', 'Cyprus', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(56, 'CZ', 'Czech Republic', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(57, 'DK', 'Denmark', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(58, 'DJ', 'Djibouti', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(59, 'DM', 'Dominica', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(60, 'DO', 'Dominican Republic', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(61, 'TP', 'East Timor', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(62, 'EC', 'Ecuador', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(63, 'EG', 'Egypt', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(64, 'SV', 'El Salvador', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(65, 'GQ', 'Equatorial Guinea', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(66, 'ER', 'Eritrea', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(67, 'EE', 'Estonia', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(68, 'ET', 'Ethiopia', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(69, 'FK', 'Falkland Islands (Malvinas)', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(70, 'FO', 'Faroe Islands', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(71, 'FJ', 'Fiji', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(72, 'FI', 'Finland', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(73, 'FR', 'France', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(74, 'FX', 'France, Metropolitan', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(75, 'GF', 'French Guiana', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(76, 'PF', 'French Polynesia', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(77, 'TF', 'French Southern Territories', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(78, 'GA', 'Gabon', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(79, 'GM', 'Gambia', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(80, 'GE', 'Georgia', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(81, 'DE', 'Germany', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(82, 'GH', 'Ghana', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(83, 'GI', 'Gibraltar', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(84, 'GK', 'Guernsey', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(85, 'GR', 'Greece', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(86, 'GL', 'Greenland', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(87, 'GD', 'Grenada', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(88, 'GP', 'Guadeloupe', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(89, 'GU', 'Guam', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(90, 'GT', 'Guatemala', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(91, 'GN', 'Guinea', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(92, 'GW', 'Guinea-Bissau', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(93, 'GY', 'Guyana', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(94, 'HT', 'Haiti', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(95, 'HM', 'Heard and Mc Donald Islands', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(96, 'HN', 'Honduras', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(97, 'HK', 'Hong Kong', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(98, 'HU', 'Hungary', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(99, 'IS', 'Iceland', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(100, 'IN', 'India', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(101, 'IM', 'Isle of Man', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(102, 'ID', 'Indonesia', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(103, 'IR', 'Iran (Islamic Republic of)', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(104, 'IQ', 'Iraq', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(105, 'IE', 'Ireland', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(106, 'IL', 'Israel', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(107, 'IT', 'Italy', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(108, 'CI', 'Ivory Coast', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(109, 'JE', 'Jersey', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(110, 'JM', 'Jamaica', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(111, 'JP', 'Japan', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(112, 'JO', 'Jordan', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(113, 'KZ', 'Kazakhstan', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(114, 'KE', 'Kenya', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(115, 'KI', 'Kiribati', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(116, 'KP', 'Korea, Democratic People\'s Republic of', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(117, 'KR', 'Korea, Republic of', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(118, 'XK', 'Kosovo', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(119, 'KW', 'Kuwait', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(120, 'KG', 'Kyrgyzstan', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(121, 'LA', 'Lao People\'s Democratic Republic', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(122, 'LV', 'Latvia', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(123, 'LB', 'Lebanon', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(124, 'LS', 'Lesotho', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(125, 'LR', 'Liberia', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(126, 'LY', 'Libyan Arab Jamahiriya', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(127, 'LI', 'Liechtenstein', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(128, 'LT', 'Lithuania', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(129, 'LU', 'Luxembourg', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(130, 'MO', 'Macau', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(131, 'MK', 'North Macedonia', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(132, 'MG', 'Madagascar', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(133, 'MW', 'Malawi', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(134, 'MY', 'Malaysia', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(135, 'MV', 'Maldives', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(136, 'ML', 'Mali', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(137, 'MT', 'Malta', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(138, 'MH', 'Marshall Islands', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(139, 'MQ', 'Martinique', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(140, 'MR', 'Mauritania', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(141, 'MU', 'Mauritius', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(142, 'TY', 'Mayotte', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(143, 'MX', 'Mexico', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(144, 'FM', 'Micronesia, Federated States of', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(145, 'MD', 'Moldova, Republic of', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(146, 'MC', 'Monaco', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(147, 'MN', 'Mongolia', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(148, 'ME', 'Montenegro', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(149, 'MS', 'Montserrat', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(150, 'MA', 'Morocco', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(151, 'MZ', 'Mozambique', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(152, 'MM', 'Myanmar', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(153, 'NA', 'Namibia', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(154, 'NR', 'Nauru', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(155, 'NP', 'Nepal', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(156, 'NL', 'Netherlands', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(157, 'AN', 'Netherlands Antilles', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(158, 'NC', 'New Caledonia', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(159, 'NZ', 'New Zealand', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(160, 'NI', 'Nicaragua', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(161, 'NE', 'Niger', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(162, 'NG', 'Nigeria', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(163, 'NU', 'Niue', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(164, 'NF', 'Norfolk Island', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(165, 'MP', 'Northern Mariana Islands', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(166, 'NO', 'Norway', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(167, 'OM', 'Oman', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(168, 'PK', 'Pakistan', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(169, 'PW', 'Palau', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(170, 'PS', 'Palestine', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(171, 'PA', 'Panama', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(172, 'PG', 'Papua New Guinea', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(173, 'PY', 'Paraguay', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(174, 'PE', 'Peru', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(175, 'PH', 'Philippines', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(176, 'PN', 'Pitcairn', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(177, 'PL', 'Poland', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(178, 'PT', 'Portugal', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(179, 'PR', 'Puerto Rico', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(180, 'QA', 'Qatar', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(181, 'RE', 'Reunion', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(182, 'RO', 'Romania', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(183, 'RU', 'Russian Federation', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(184, 'RW', 'Rwanda', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(185, 'KN', 'Saint Kitts and Nevis', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(186, 'LC', 'Saint Lucia', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(187, 'VC', 'Saint Vincent and the Grenadines', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(188, 'WS', 'Samoa', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(189, 'SM', 'San Marino', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(190, 'ST', 'Sao Tome and Principe', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(191, 'SA', 'Saudi Arabia', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(192, 'SN', 'Senegal', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(193, 'RS', 'Serbia', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(194, 'SC', 'Seychelles', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(195, 'SL', 'Sierra Leone', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(196, 'SG', 'Singapore', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(197, 'SK', 'Slovakia', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(198, 'SI', 'Slovenia', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(199, 'SB', 'Solomon Islands', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(200, 'SO', 'Somalia', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(201, 'ZA', 'South Africa', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(202, 'GS', 'South Georgia South Sandwich Islands', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(203, 'SS', 'South Sudan', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(204, 'ES', 'Spain', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(205, 'LK', 'Sri Lanka', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(206, 'SH', 'St. Helena', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(207, 'PM', 'St. Pierre and Miquelon', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(208, 'SD', 'Sudan', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(209, 'SR', 'Suriname', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(210, 'SJ', 'Svalbard and Jan Mayen Islands', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(211, 'SZ', 'Eswatini', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(212, 'SE', 'Sweden', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(213, 'CH', 'Switzerland', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(214, 'SY', 'Syrian Arab Republic', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(215, 'TW', 'Taiwan', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(216, 'TJ', 'Tajikistan', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(217, 'TZ', 'Tanzania, United Republic of', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(218, 'TH', 'Thailand', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(219, 'TG', 'Togo', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(220, 'TK', 'Tokelau', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(221, 'TO', 'Tonga', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(222, 'TT', 'Trinidad and Tobago', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(223, 'TN', 'Tunisia', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(224, 'TR', 'Turkey', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(225, 'TM', 'Turkmenistan', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(226, 'TC', 'Turks and Caicos Islands', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(227, 'TV', 'Tuvalu', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(228, 'UG', 'Uganda', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(229, 'UA', 'Ukraine', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(230, 'AE', 'United Arab Emirates', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(231, 'GB', 'United Kingdom', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(232, 'US', 'United States', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(233, 'UM', 'United States minor outlying islands', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(234, 'UY', 'Uruguay', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(235, 'UZ', 'Uzbekistan', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(236, 'VU', 'Vanuatu', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(237, 'VA', 'Vatican City State', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(238, 'VE', 'Venezuela', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(239, 'VN', 'Vietnam', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(240, 'VG', 'Virgin Islands (British)', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(241, 'VI', 'Virgin Islands (U.S.)', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(242, 'WF', 'Wallis and Futuna Islands', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(243, 'EH', 'Western Sahara', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(244, 'YE', 'Yemen', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(245, 'ZM', 'Zambia', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11'),
(246, 'ZW', 'Zimbabwe', 1, '2023-04-08 10:06:04', '2023-04-08 13:08:11');

-- --------------------------------------------------------

--
-- Estrutura para tabela `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_02_12_170056_create_vendors_table', 1),
(6, '2023_02_12_170712_create_admins_table', 1),
(7, '2023_02_21_192431_create_vendors_business_details_table', 2),
(8, '2023_02_21_220706_create_vendors_bank_details', 3),
(9, '2023_04_08_163741_create_sections_table', 4),
(10, '2023_04_08_194654_create_section_table', 5),
(11, '2023_04_10_204835_create_categories_table', 6),
(12, '2023_05_05_222134_create_brands_table', 7),
(13, '2023_05_07_013001_create_products_table', 8),
(14, '2023_05_21_205754_create_products_attributes_table', 9),
(15, '2023_06_04_180925_create_products_images_table', 10),
(16, '2023_06_17_015804_create_banners_table', 11),
(17, '2023_06_23_230554_update_banners_table', 12),
(18, '2023_06_24_225952_update_products_table', 13),
(19, '2023_07_05_211703_create_products_filters_table', 14),
(20, '2023_07_05_212357_create_products_filters_values_table', 15);

-- --------------------------------------------------------

--
-- Estrutura para tabela `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `section_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `admin_type` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `product_color` varchar(255) NOT NULL,
  `product_price` float NOT NULL,
  `product_discount` float NOT NULL,
  `product_weight` int(11) NOT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `product_video` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `operating_system` varchar(255) DEFAULT NULL,
  `screen_size` varchar(255) DEFAULT NULL,
  `ocassion` varchar(255) DEFAULT NULL,
  `fit` varchar(255) DEFAULT NULL,
  `pattern` varchar(255) DEFAULT NULL,
  `sleeve` varchar(255) DEFAULT NULL,
  `ram` varchar(255) DEFAULT NULL,
  `fabric` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `is_featured` enum('No','Yes') NOT NULL,
  `is_bestseller` enum('No','Yes') NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `products`
--

INSERT INTO `products` (`id`, `section_id`, `category_id`, `brand_id`, `vendor_id`, `admin_id`, `admin_type`, `product_name`, `product_code`, `product_color`, `product_price`, `product_discount`, `product_weight`, `product_image`, `product_video`, `description`, `operating_system`, `screen_size`, `ocassion`, `fit`, `pattern`, `sleeve`, `ram`, `fabric`, `meta_title`, `meta_description`, `meta_keywords`, `is_featured`, `is_bestseller`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 5, 7, 0, 1, 'superadmin', 'Redmi Note 11', 'RN11', 'Blue', 15000, 10, 500, '48564.jpg', '49601.mp4', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Yes', 'Yes', 1, NULL, '2023-07-08 02:27:21'),
(2, 1, 6, 3, 0, 1, 'superadmin', 'Red Casual T-Shirt', 'RC001', 'Red', 1000, 0, 100, '97540.jpg', '41225.mp4', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Pure Cotton T-Shirt', 'this is pure cotton t', 'cotton t-shirt red tshirt', 'Yes', 'Yes', 1, '2023-05-20 16:49:48', '2023-07-04 00:01:22'),
(3, 1, 6, 3, 0, 1, 'superadmin', 'Arrow T-Shirt', 'AT011', 'Red', 1000, 0, 100, '7165.jpg', '39799.mp4', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Pure Cotton T-Shirt1', 'this is pure cotton t-shirt1', 'cotton t-shirt,red tshirt', 'Yes', 'Yes', 1, '2023-05-20 19:38:52', '2023-07-05 01:03:04'),
(4, 1, 6, 3, 0, 1, 'superadmin', 'Blue T-Shirt', 'BT01', 'Blue', 1000, 0, 100, '13152.png', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Yes', 'Yes', 1, '2023-06-24 23:45:47', '2023-07-05 01:03:16'),
(5, 1, 6, 2, 0, 1, 'superadmin', 'Green T-Shirt', 'GT01', 'Green', 800, 0, 100, '23745.png', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Yes', 'Yes', 1, '2023-06-24 23:48:09', '2023-07-05 01:03:28'),
(6, 1, 6, 1, 0, 1, 'superadmin', 'Blue T-Shirt', 'BS01', 'Blue', 2000, 10, 100, '49588.jpg', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Yes', 'Yes', 1, '2023-06-30 00:17:55', '2023-07-02 23:23:42');

-- --------------------------------------------------------

--
-- Estrutura para tabela `products_attributes`
--

CREATE TABLE `products_attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(255) NOT NULL,
  `price` double(8,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `products_attributes`
--

INSERT INTO `products_attributes` (`id`, `product_id`, `size`, `price`, `stock`, `sku`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'Small', 1100.00, 11, 'BT001-S', 1, '2023-06-03 16:08:44', '2023-06-04 05:08:39'),
(2, 2, 'Medium', 1200.00, 12, 'BT001-M', 1, '2023-06-03 16:14:31', '2023-06-04 05:08:40'),
(3, 2, 'Large', 1300.00, 13, 'BT001-L', 1, '2023-06-03 16:16:56', '2023-06-04 05:08:40');

-- --------------------------------------------------------

--
-- Estrutura para tabela `products_filters`
--

CREATE TABLE `products_filters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cat_ids` varchar(255) NOT NULL,
  `filter_name` varchar(255) NOT NULL,
  `filter_column` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `products_filters`
--

INSERT INTO `products_filters` (`id`, `cat_ids`, `filter_name`, `filter_column`, `status`, `created_at`, `updated_at`) VALUES
(1, '1,6,7,2,8,3', 'Fabric', 'fabric', 1, '2023-07-08 00:15:35', '2023-07-08 00:15:35'),
(2, '4,5', 'RAM', 'ram', 1, '2023-07-08 00:16:41', '2023-07-08 00:16:41'),
(3, '1,6,7,2,8,3', 'Sleeve', 'sleeve', 1, '2023-07-08 00:25:38', '2023-07-08 00:25:38'),
(4, '1,6,7,2,8,3', 'Pattern', 'pattern', 1, '2023-07-08 00:26:15', '2023-07-08 00:26:15'),
(5, '1,6,7,2,8,3', 'Fit', 'fit', 1, '2023-07-08 00:26:49', '2023-07-08 00:26:49'),
(6, '1,6,7,2,8,3', 'Occasion', 'ocassion', 1, '2023-07-08 00:27:54', '2023-07-08 00:27:54'),
(7, '4,5', 'Screen Size', 'screen_size', 1, '2023-07-08 01:29:58', '2023-07-08 01:29:58'),
(8, '4,5', 'Operating System', 'operating_system', 1, '2023-07-08 01:52:01', '2023-07-08 01:52:01');

-- --------------------------------------------------------

--
-- Estrutura para tabela `products_filters_values`
--

CREATE TABLE `products_filters_values` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `filter_id` int(11) NOT NULL,
  `filter_value` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `products_filters_values`
--

INSERT INTO `products_filters_values` (`id`, `filter_id`, `filter_value`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'cotton', 1, '2023-07-08 01:12:40', '2023-07-08 01:12:40'),
(2, 1, 'Polyester', 1, '2023-07-08 01:13:38', '2023-07-08 01:13:38'),
(3, 1, 'Wool', 1, '2023-07-08 01:14:00', '2023-07-08 01:14:00'),
(4, 3, 'Full Sleeve', 1, '2023-07-08 01:14:30', '2023-07-08 01:14:30'),
(5, 3, 'Half Sleeve', 1, '2023-07-08 01:24:33', '2023-07-08 01:26:14'),
(6, 3, 'Short Sleeve', 1, '2023-07-08 01:25:08', '2023-07-08 01:25:08'),
(7, 2, '4GB', 1, '2023-07-08 01:28:03', '2023-07-08 01:28:03'),
(8, 2, '8GB', 1, '2023-07-08 01:28:22', '2023-07-08 01:28:22'),
(9, 7, 'Up to 3.9 in', 1, '2023-07-08 01:30:50', '2023-07-08 01:30:50'),
(10, 7, '4 to 4.4 in', 1, '2023-07-08 01:51:05', '2023-07-08 01:51:05'),
(11, 8, 'Android', 1, '2023-07-08 01:52:32', '2023-07-08 01:52:32'),
(12, 8, 'iOS', 1, '2023-07-08 01:53:03', '2023-07-08 01:53:03'),
(13, 8, 'Windows', 1, '2023-07-08 01:53:30', '2023-07-08 01:53:30'),
(14, 7, '4.5 to 4.9 in', 1, '2023-07-08 01:56:02', '2023-07-08 01:56:02'),
(15, 7, '5 to 5.4 in', 1, '2023-07-08 01:56:20', '2023-07-08 01:56:20'),
(16, 7, '5.5 in & above', 1, '2023-07-08 01:56:45', '2023-07-08 01:56:45');

-- --------------------------------------------------------

--
-- Estrutura para tabela `products_images`
--

CREATE TABLE `products_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `products_images`
--

INSERT INTO `products_images` (`id`, `product_id`, `image`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, 'vestido.jpg65587.jpg', 1, '2023-06-07 04:39:03', '2023-06-08 00:07:26'),
(3, 1, 'vans.jpg99955.jpg', 1, '2023-06-07 04:39:03', '2023-06-15 14:56:17');

-- --------------------------------------------------------

--
-- Estrutura para tabela `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `sections`
--

INSERT INTO `sections` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Clothing', 1, NULL, '2023-07-08 02:22:49'),
(2, 'Electronics', 1, NULL, '2023-04-09 01:55:14'),
(3, 'Appliances\r\n', 1, NULL, '2023-06-17 02:53:31');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@admin.com', NULL, '2c43c95d0f764aaea9a7ce3caa48803725a887f48cb3472b7087b0ba8ed98805', NULL, '2023-04-01 04:20:43', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `vendors`
--

CREATE TABLE `vendors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `pincode` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `vendors`
--

INSERT INTO `vendors` (`id`, `name`, `address`, `city`, `state`, `country`, `pincode`, `mobile`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'John', 'CP-11245', 'Mumbai', 'Maharashtra', 'India', '2435356', '97000000000', 'john@admin.com', 0, NULL, '2023-04-17 07:18:42');

-- --------------------------------------------------------

--
-- Estrutura para tabela `vendors_bank_details`
--

CREATE TABLE `vendors_bank_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `account_holder_name` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `bank_ifsc_code` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `vendors_bank_details`
--

INSERT INTO `vendors_bank_details` (`id`, `vendor_id`, `account_holder_name`, `bank_name`, `account_number`, `bank_ifsc_code`, `created_at`, `updated_at`) VALUES
(1, 1, 'John Cena', 'ICICI', '0243530500022', '24353563', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `vendors_business_details`
--

CREATE TABLE `vendors_business_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `shop_name` varchar(255) NOT NULL,
  `shop_address` varchar(255) NOT NULL,
  `shop_city` varchar(255) NOT NULL,
  `shop_state` varchar(255) NOT NULL,
  `shop_country` varchar(255) NOT NULL,
  `shop_pincode` varchar(255) NOT NULL,
  `shop_mobile` varchar(255) NOT NULL,
  `shop_website` varchar(255) NOT NULL,
  `shop_email` varchar(255) NOT NULL,
  `address_proof` varchar(255) NOT NULL,
  `address_proof_image` varchar(255) NOT NULL,
  `business_license_number` varchar(255) NOT NULL,
  `gst_number` varchar(255) NOT NULL,
  `pan_number` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `vendors_business_details`
--

INSERT INTO `vendors_business_details` (`id`, `vendor_id`, `shop_name`, `shop_address`, `shop_city`, `shop_state`, `shop_country`, `shop_pincode`, `shop_mobile`, `shop_website`, `shop_email`, `address_proof`, `address_proof_image`, `business_license_number`, `gst_number`, `pan_number`, `created_at`, `updated_at`) VALUES
(1, 1, 'John Electronics Store', '1234-SCF', 'New Delhi', 'Delhi', 'Mauritius', '110001', '41995372945', 'sitemakers.in', 'john@admin.com', 'Passport', '97309.jpg', '13243535', '446466446', '242355346', NULL, '2023-06-15 06:32:36');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Índices de tabela `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Índices de tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Índices de tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Índices de tabela `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `products_attributes`
--
ALTER TABLE `products_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `products_filters`
--
ALTER TABLE `products_filters`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `products_filters_values`
--
ALTER TABLE `products_filters_values`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `products_images`
--
ALTER TABLE `products_images`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Índices de tabela `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vendors_email_unique` (`email`);

--
-- Índices de tabela `vendors_bank_details`
--
ALTER TABLE `vendors_bank_details`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `vendors_business_details`
--
ALTER TABLE `vendors_business_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `products_attributes`
--
ALTER TABLE `products_attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `products_filters`
--
ALTER TABLE `products_filters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `products_filters_values`
--
ALTER TABLE `products_filters_values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `products_images`
--
ALTER TABLE `products_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `vendors_bank_details`
--
ALTER TABLE `vendors_bank_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `vendors_business_details`
--
ALTER TABLE `vendors_business_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

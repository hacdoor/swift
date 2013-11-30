-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2013 at 10:00 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `swift`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `realname` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_admin_group1` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `email`, `realname`, `is_active`, `create_time`, `update_time`, `group_id`) VALUES
(1, 'Superadmin', '937ff079b20cb082632a42fb7eb03689aa6367df', 'superadmin@example.com', 'Super Administrator', 1, '2013-09-19 13:20:00', '2013-11-20 13:10:26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin_permission`
--

CREATE TABLE IF NOT EXISTS `admin_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `allow` tinyint(1) NOT NULL DEFAULT '1',
  `admin_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_table1_admin1` (`admin_id`),
  KEY `fk_table1_permission2` (`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE IF NOT EXISTS `content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `teaser` text,
  `body` text,
  `picture` varchar(255) DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `publish_time` datetime NOT NULL,
  `slug` varchar(255) NOT NULL,
  `weight` int(11) NOT NULL DEFAULT '10',
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  `content_type_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_UNIQUE` (`slug`),
  KEY `fk_content_content_type` (`content_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `content_type`
--

CREATE TABLE IF NOT EXISTS `content_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `slug` varchar(255) NOT NULL,
  `has_event` tinyint(1) DEFAULT NULL,
  `has_comment` tinyint(1) DEFAULT NULL,
  `default_sort` text,
  `list_size` int(11) DEFAULT NULL,
  `teaser_length` int(11) DEFAULT NULL,
  `title_filter` text,
  `teaser_filter` text,
  `body_filter` text,
  `moderate_comment` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_UNIQUE` (`slug`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `content_type`
--

INSERT INTO `content_type` (`id`, `name`, `description`, `slug`, `has_event`, `has_comment`, `default_sort`, `list_size`, `teaser_length`, `title_filter`, `teaser_filter`, `body_filter`, `moderate_comment`) VALUES
(1, 'Page', '', 'page', 1, NULL, '', NULL, NULL, '', '', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `slug` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  UNIQUE KEY `slug_UNIQUE` (`slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`id`, `name`, `description`, `slug`) VALUES
(1, 'Superadmin', 'Super Administrator', 'superadmin');

-- --------------------------------------------------------

--
-- Table structure for table `group_permission`
--

CREATE TABLE IF NOT EXISTS `group_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `allow` tinyint(1) NOT NULL DEFAULT '1',
  `group_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_table1_group1` (`group_id`),
  KEY `fk_table1_permission1` (`permission_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `group_permission`
--

INSERT INTO `group_permission` (`id`, `allow`, `group_id`, `permission_id`) VALUES
(1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `infolain`
--

CREATE TABLE IF NOT EXISTS `infolain` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `infSendersCorrespondent` varchar(140) DEFAULT NULL,
  `infReceiverCorrespondent` varchar(140) DEFAULT NULL,
  `infThirdReimbursementInstitution` varchar(140) DEFAULT NULL,
  `infIntermediaryInstitution` varchar(140) DEFAULT NULL,
  `infBeneficiaryCustomerAccountInstitution` varchar(140) DEFAULT NULL,
  `remittanceInformation` varchar(140) DEFAULT NULL,
  `senderToReceiverInformation` varchar(210) DEFAULT NULL,
  `regulatoryReporting` varchar(105) DEFAULT NULL,
  `envelopeContents` varchar(100) DEFAULT NULL,
  `swift_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_infoLain_swift1` (`swift_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `infolain`
--

INSERT INTO `infolain` (`id`, `infSendersCorrespondent`, `infReceiverCorrespondent`, `infThirdReimbursementInstitution`, `infIntermediaryInstitution`, `infBeneficiaryCustomerAccountInstitution`, `remittanceInformation`, `senderToReceiverInformation`, `regulatoryReporting`, `envelopeContents`, `swift_id`) VALUES
(1, 'nmn,mn', '', 'mbmnbm', '', '', '', '', '', '', 153),
(2, '', '', '', '', '', '', '', '', '', 146),
(3, '', '', '', '', '', '', '', '', '', 147),
(4, '', '', '', '', '', '', '', '', '', 148);

-- --------------------------------------------------------

--
-- Table structure for table `kabupaten`
--

CREATE TABLE IF NOT EXISTS `kabupaten` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `no_kota` int(11) NOT NULL,
  `propinsi_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_kabupaten_propinsi1` (`propinsi_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=441 ;

--
-- Dumping data for table `kabupaten`
--

INSERT INTO `kabupaten` (`id`, `nama`, `no_kota`, `propinsi_id`) VALUES
(1, 'Kabupaten Simeulue', 1101, 11),
(2, 'Kabupaten Aceh Singkil', 1102, 11),
(3, 'Kabupaten Aceh Selatan', 1103, 11),
(4, 'Kabupaten Aceh Tenggara', 1104, 11),
(5, 'Kabupaten Aceh Timur', 1105, 11),
(6, 'Kabupaten Aceh Tengah', 1106, 11),
(7, 'Kabupaten Aceh Barat', 1107, 11),
(8, 'Kabupaten Aceh Besar', 1108, 11),
(9, 'Kabupaten Pidie', 1109, 11),
(10, 'Kabupaten Bireuen', 1110, 11),
(11, 'Kabupaten Aceh Utara', 1111, 11),
(12, 'Kabupaten Aceh Barat Daya', 1112, 11),
(13, 'Kabupaten Gayo Lues', 1113, 11),
(14, 'Kabupaten Aceh Tamiang', 1114, 11),
(15, 'Kabupaten Nagan Raya', 1115, 11),
(16, 'Kabupaten Aceh Jaya', 1116, 11),
(17, 'Kabupaten Bener Meriah', 1117, 11),
(18, 'Banda Aceh', 1171, 11),
(19, 'Sabang', 1172, 11),
(20, 'Langsa', 1173, 11),
(21, 'Lhoksumawe', 1174, 11),
(22, 'Kabupaten Nias', 1201, 12),
(23, 'Kabupaten Mandailing Natal', 1202, 12),
(24, 'Kabupaten Tapanuli Selatan', 1203, 12),
(25, 'Kabupaten Tapanuli Tengah', 1204, 12),
(26, 'Kabupaten Tapanuli Utara', 1205, 12),
(27, 'Kabupaten Toba Samosir', 1206, 12),
(28, 'Kabupaten Labuhan Batu', 1207, 12),
(29, 'Kabupaten Asahan', 1208, 12),
(30, 'Kabupaten Simalungun', 1209, 12),
(31, 'Kabupaten Dairi', 1210, 12),
(32, 'Kabupaten Karo', 1211, 12),
(33, 'Kabupaten Deli Serdang', 1212, 12),
(34, 'Kabupaten Langkat', 1213, 12),
(35, 'Kabupaten Nias Selatan', 1214, 12),
(36, 'Kabupaten Humbang Hasundutan', 1215, 12),
(37, 'Kabupaten Papak Bharat', 1216, 12),
(38, 'Kabupaten Samosir', 1217, 12),
(39, 'Kabupaten Serdang Bedagai', 1218, 12),
(40, 'Sibolga', 1271, 12),
(41, 'Tanjung Balai', 1272, 12),
(42, 'Pematang Siantar', 1273, 12),
(43, 'Tebing Tinggi', 1274, 12),
(44, 'Medan', 1275, 12),
(45, 'Binjai', 1276, 12),
(46, 'Padang Sidempuan', 1277, 12),
(47, 'Kabupaten Kepulauan Mentawai', 1301, 13),
(48, 'Kabupaten Pesisir Selatan', 1302, 13),
(49, 'Kabupaten Solok', 1303, 13),
(50, 'Kabupaten Sawahlunto/sijunjung', 1304, 13),
(51, 'Kabupaten Tanah Datar', 1305, 13),
(52, 'Kabupaten Padang Pariaman', 1306, 13),
(53, 'Kabupaten Agam', 1307, 13),
(54, 'Kabupaten Lima Puluh Koto', 1308, 13),
(55, 'Kabupaten Pasaman', 1309, 13),
(56, 'Kabupaten Solok Selatan', 1310, 13),
(57, 'Kabupaten Dharmasraya', 1311, 13),
(58, 'Kabupaten Pasaman Barat', 1312, 13),
(59, 'Padang', 1371, 13),
(60, 'Solok', 1372, 13),
(61, 'Sawah Lunto', 1373, 13),
(62, 'Padang Panjang', 1374, 13),
(63, 'Bukittinggi', 1375, 13),
(64, 'Payakumbuh', 1376, 13),
(65, 'Pariaman', 1377, 13),
(66, 'Kabupaten Kuantan Singingi', 1401, 14),
(67, 'Kabupaten Indragiri Hulu', 1402, 14),
(68, 'Kabupaten Indragiri Hilir', 1403, 14),
(69, 'Kabupaten Pelalawan', 1404, 14),
(70, 'Kabupaten Siak', 1405, 14),
(71, 'Kabupaten Kampar', 1406, 14),
(72, 'Kabupaten Rokan Hulu', 1407, 14),
(73, 'Kabupaten Bengkalis', 1408, 14),
(74, 'Kabupaten Rokan Hilir', 1409, 14),
(75, 'Pekan Baru', 1471, 14),
(76, 'D U M A I', 1473, 14),
(77, 'Kabupaten Kerinci', 1501, 15),
(78, 'Kabupaten Merangin', 1502, 15),
(79, 'Kabupaten Sarolangun', 1503, 15),
(80, 'Kabupaten Batanghari', 1504, 15),
(81, 'Kabupaten Muaro Jambi', 1505, 15),
(82, 'Kabupaten Tanjung Jabung Timur', 1506, 15),
(83, 'Kabupaten Tanjung Jabung Barat', 1507, 15),
(84, 'Kabupaten Tebo', 1508, 15),
(85, 'Kabupaten Bungo', 1509, 15),
(86, 'Jambi', 1571, 15),
(87, 'Kabupaten Oku', 1601, 16),
(88, 'Kabupaten Oki', 1602, 16),
(89, 'Kabupaten Muara Enim', 1603, 16),
(90, 'Kabupaten Lahat', 1604, 16),
(91, 'Kabupaten Musi Rawas', 1605, 16),
(92, 'Kabupaten Musi Banyu Asin', 1606, 16),
(93, 'Kabupaten Banyu Asin', 1607, 16),
(94, 'Kabupaten Oku Selatan', 1608, 16),
(95, 'Kabupaten Oku Timur', 1609, 16),
(96, 'Kabupaten Ogan Ilir', 1610, 16),
(97, 'Palembang', 1671, 16),
(98, 'Prabumulih', 1672, 16),
(99, 'Pagar Alam', 1673, 16),
(100, 'Lubuk Lingga', 1674, 16),
(101, 'Kabupaten Bengkulu Selatan', 1701, 17),
(102, 'Kabupaten Rejang Lebong', 1702, 17),
(103, 'Kabupaten Bengkulu Utara', 1703, 17),
(104, 'Kabupaten Kaur', 1704, 17),
(105, 'Kabupaten Seluma', 1705, 17),
(106, 'Kabupaten Mukomuko', 1706, 17),
(107, 'Kabupaten Lebong', 1707, 17),
(108, 'Kabupaten Kepahing', 1708, 17),
(109, 'Bengkulu', 1771, 17),
(110, 'Kabupaten Lampung Barat', 1801, 18),
(111, 'Kabupaten Tanggamus', 1802, 18),
(112, 'Kabupaten Lampung Selatan', 1803, 18),
(113, 'Kabupaten Lampung Timur', 1804, 18),
(114, 'Kabupaten Lampung Tengah', 1805, 18),
(115, 'Kabupaten Lampung Utara', 1806, 18),
(116, 'Kabupaten Way Kanan', 1807, 18),
(117, 'Kabupaten Tulang Bawang', 1808, 18),
(118, 'Bandar Lampung', 1871, 18),
(119, 'Metro', 1872, 18),
(120, 'Kabupaten Bangka', 1901, 19),
(121, 'Kabupaten Belitung', 1902, 19),
(122, 'Kabupaten Bangka Barat', 1903, 19),
(123, 'Kabupaten Bangka Tengah', 1904, 19),
(124, 'Kabupaten Bangka Selatan', 1905, 19),
(125, 'Kabupaten Belitung Timur', 1906, 19),
(126, 'Pangkal Pinang', 1971, 19),
(127, 'Kabupaten Karimun', 2101, 21),
(128, 'Kabupaten Kepulauan Riau', 2102, 21),
(129, 'Kabupaten Natuna', 2103, 21),
(130, 'Kabupaten Lingga', 2104, 21),
(131, 'B A T A M', 2171, 21),
(132, 'Tanjung Pinang', 2172, 21),
(133, 'Jakarta Selatan', 3171, 31),
(134, 'Jakarta Timur', 3172, 31),
(135, 'Jakarta Pusat', 3173, 31),
(136, 'Jakarta Barat', 3174, 31),
(137, 'Jakarta Utara', 3175, 31),
(138, 'Kabupaten Bogor', 3201, 32),
(139, 'Kabupaten Sukabumi', 3202, 32),
(140, 'Kabupaten Cianjur', 3203, 32),
(141, 'Kabupaten Bandung', 3204, 32),
(142, 'Kabupaten Garut', 3205, 32),
(143, 'Kabupaten Tasikmalaya', 3206, 32),
(144, 'Kabupaten Ciamis', 3207, 32),
(145, 'Kabupaten Kuningan', 3208, 32),
(146, 'Kabupaten Cirebon', 3209, 32),
(147, 'Kabupaten Majalengka', 3210, 32),
(148, 'Kabupaten Sumedang', 3211, 32),
(149, 'Kabupaten Indramayu', 3212, 32),
(150, 'Kabupaten Subang', 3213, 32),
(151, 'Kabupaten Purwakarta', 3214, 32),
(152, 'Kabupaten Karawang', 3215, 32),
(153, 'Kabupaten Bekasi', 3216, 32),
(154, 'Bogor', 3271, 32),
(155, 'Sukabumi', 3272, 32),
(156, 'Bandung', 3273, 32),
(157, 'Cirebon', 3274, 32),
(158, 'Bekasi', 3275, 32),
(159, 'Depok', 3276, 32),
(160, 'Cimahi', 3277, 32),
(161, 'Tasikmalaya', 3278, 32),
(162, 'Banjar', 3279, 32),
(163, 'Kabupaten Cilacap', 3301, 33),
(164, 'Kabupaten Banyumas', 3302, 33),
(165, 'Kabupaten Purbalingga', 3303, 33),
(166, 'Kabupaten Banjarnegara', 3304, 33),
(167, 'Kabupaten Kebumen', 3305, 33),
(168, 'Kabupaten Purworejo', 3306, 33),
(169, 'Kabupaten Wonosobo', 3307, 33),
(170, 'Kabupaten Magelang', 3308, 33),
(171, 'Kabupaten Boyolali', 3309, 33),
(172, 'Kabupaten Klaten', 3310, 33),
(173, 'Kabupaten Sukoharjo', 3311, 33),
(174, 'Kabupaten Wonogiri', 3312, 33),
(175, 'Kabupaten Karanganyar', 3313, 33),
(176, 'Kabupaten Sragen', 3314, 33),
(177, 'Kabupaten Grobogan', 3315, 33),
(178, 'Kabupaten Blora', 3316, 33),
(179, 'Kabupaten Rembang', 3317, 33),
(180, 'Kabupaten Pati', 3318, 33),
(181, 'Kabupaten Kudus', 3319, 33),
(182, 'Kabupaten Jepara', 3320, 33),
(183, 'Kabupaten Demak', 3321, 33),
(184, 'Kabupaten Semarang', 3322, 33),
(185, 'Kabupaten Temanggung', 3323, 33),
(186, 'Kabupaten Kendal', 3324, 33),
(187, 'Kabupaten Batang', 3325, 33),
(188, 'Kabupaten Pekalongan', 3326, 33),
(189, 'Kabupaten Pemalang', 3327, 33),
(190, 'Kabupaten Tegal', 3328, 33),
(191, 'Kabupaten Brebes', 3329, 33),
(192, 'Magelang', 3371, 33),
(193, 'Surakarta', 3372, 33),
(194, 'Salatiga', 3373, 33),
(195, 'Semarang', 3374, 33),
(196, 'Pekalongan', 3375, 33),
(197, 'Tegal', 3376, 33),
(198, 'Kabupaten Kulon Progo', 3401, 34),
(199, 'Kabupaten Bantul', 3402, 34),
(200, 'Kabupaten Gunung Kidul', 3403, 34),
(201, 'Kabupaten Sleman', 3404, 34),
(202, 'Yogyakarta', 3471, 34),
(203, 'Kabupaten Pacitan', 3501, 35),
(204, 'Kabupaten Ponorogo', 3502, 35),
(205, 'Kabupaten Trenggalek', 3503, 35),
(206, 'Kabupaten Tulungagung', 3504, 35),
(207, 'Kabupaten Blitar', 3505, 35),
(208, 'Kabupaten Kediri', 3506, 35),
(209, 'Kabupaten Malang', 3507, 35),
(210, 'Kabupaten Lumajang', 3508, 35),
(211, 'Kabupaten Jember', 3509, 35),
(212, 'Kabupaten Banyuwangi', 3510, 35),
(213, 'Kabupaten Bondowoso', 3511, 35),
(214, 'Kabupaten Situbondo', 3512, 35),
(215, 'Kabupaten Probolinggo', 3513, 35),
(216, 'Kabupaten Pasuruan', 3514, 35),
(217, 'Kabupaten Sidoarjo', 3515, 35),
(218, 'Kabupaten Mojokerto', 3516, 35),
(219, 'Kabupaten Jombang', 3517, 35),
(220, 'Kabupaten Nganjuk', 3518, 35),
(221, 'Kabupaten Madiun', 3519, 35),
(222, 'Kabupaten Magetan', 3520, 35),
(223, 'Kabupaten Ngawi', 3521, 35),
(224, 'Kabupaten Bojonegoro', 3522, 35),
(225, 'Kabupaten Tuban', 3523, 35),
(226, 'Kabupaten Lamongan', 3524, 35),
(227, 'Kabupaten Gresik', 3525, 35),
(228, 'Kabupaten Bangkalan', 3526, 35),
(229, 'Kabupaten Sampang', 3527, 35),
(230, 'Kabupaten Pamekasan', 3528, 35),
(231, 'Kabupaten Sumenep', 3529, 35),
(232, 'Kediri', 3571, 35),
(233, 'Blitar', 3572, 35),
(234, 'Malang', 3573, 35),
(235, 'Probolinggo', 3574, 35),
(236, 'Pasuruan', 3575, 35),
(237, 'Mojokerto', 3576, 35),
(238, 'Madiun', 3577, 35),
(239, 'Surabaya', 3578, 35),
(240, 'Batu', 3579, 35),
(241, 'Kabupaten Pandeglang', 3601, 36),
(242, 'Kabupaten Lebak', 3602, 36),
(243, 'Kabupaten Tangerang', 3603, 36),
(244, 'Kabupaten Serang', 3604, 36),
(245, 'Tangerang', 3671, 36),
(246, 'Cilegon', 3672, 36),
(247, 'Kabupaten Jembrana', 5101, 51),
(248, 'Kabupaten Tabanan', 5102, 51),
(249, 'Kabupaten Badung', 5103, 51),
(250, 'Kabupaten Gianyar', 5104, 51),
(251, 'Kabupaten Klungkung', 5105, 51),
(252, 'Kabupaten Bangli', 5106, 51),
(253, 'Kabupaten Karangasem', 5107, 51),
(254, 'Kabupaten Buleleng', 5108, 51),
(255, 'Denpasar', 5171, 51),
(256, 'Kabupaten Lombok Barat', 5201, 52),
(257, 'Kabupaten Lombok Tengah', 5202, 52),
(258, 'Kabupaten Lombok Timur', 5203, 52),
(259, 'Kabupaten Sumbawa', 5204, 52),
(260, 'Kabupaten Dompu', 5205, 52),
(261, 'Kabupaten Bima', 5206, 52),
(262, 'Kabupaten Sumbawa Barat', 5207, 52),
(263, 'Mataram', 5271, 52),
(264, 'Bima', 5272, 52),
(265, 'Kabupaten Sumba Barat', 5301, 53),
(266, 'Kabupaten Sumba Timur', 5302, 53),
(267, 'Kabupaten Kupang', 5303, 53),
(268, 'Kabupaten Timor Tengah Selatan', 5304, 53),
(269, 'Kabupaten Timor Tengah Utara', 5305, 53),
(270, 'Kabupaten Belu', 5306, 53),
(271, 'Kabupaten Alor', 5307, 53),
(272, 'Kabupaten Lembata', 5308, 53),
(273, 'Kabupaten Flores Timur', 5309, 53),
(274, 'Kabupaten Sikka', 5310, 53),
(275, 'Kabupaten Ende', 5311, 53),
(276, 'Kabupaten Ngada', 5312, 53),
(277, 'Kabupaten Manggarai', 5313, 53),
(278, 'Kabupaten Rote Ndao', 5314, 53),
(279, 'Kabupaten Manggarai Barat', 5315, 53),
(280, 'Kupang', 5371, 53),
(281, 'Kabupaten Sambas', 6101, 61),
(282, 'Kabupaten Bengkayang', 6102, 61),
(283, 'Kabupaten Landak', 6103, 61),
(284, 'Kabupaten Pontianak', 6104, 61),
(285, 'Kabupaten Sanggau', 6105, 61),
(286, 'Kabupaten Ketapang', 6106, 61),
(287, 'Kabupaten Sintang', 6107, 61),
(288, 'Kabupaten Kapuas Hulu', 6108, 61),
(289, 'Kabupaten Sekadau', 6109, 61),
(290, 'Kabupaten Melawai', 6110, 61),
(291, 'Pontianak', 6171, 61),
(292, 'Singkawang', 6172, 61),
(293, 'Kabupaten Kotawaringin Barat', 6201, 62),
(294, 'Kabupaten Kotawaringin Timur', 6202, 62),
(295, 'Kabupaten Kapuas', 6203, 62),
(296, 'Kabupaten Barito Selatan', 6204, 62),
(297, 'Kabupaten Barito Utara', 6205, 62),
(298, 'Kabupaten Sukamara', 6206, 62),
(299, 'Kabupaten Lamandau', 6207, 62),
(300, 'Kabupaten Seruyan', 6208, 62),
(301, 'Kabupaten Katingan', 6209, 62),
(302, 'Kabupaten Pulang Pisau', 6210, 62),
(303, 'Kabupaten Gunung Mas', 6211, 62),
(304, 'Kabupaten Barito Timur', 6212, 62),
(305, 'Kabupaten Murung Raya', 6213, 62),
(306, 'Palangka Raya', 6271, 62),
(307, 'Kabupaten Tanah Laut', 6301, 63),
(308, 'Kabupaten Kotabaru', 6302, 63),
(309, 'Kabupaten Banjar', 6303, 63),
(310, 'Kabupaten Barito Kuala', 6304, 63),
(311, 'Kabupaten Tapin', 6305, 63),
(312, 'Kabupaten Hulu Sungai Selatan', 6306, 63),
(313, 'Kabupaten Hulu Sungai Tengah', 6307, 63),
(314, 'Kabupaten Hulu Sungai Utara', 6308, 63),
(315, 'Kabupaten Tabalong', 6309, 63),
(316, 'Kabupaten Tanah Bumbu', 6310, 63),
(317, 'Kabupaten Balangan', 6311, 63),
(318, 'Banjarmasin', 6371, 63),
(319, 'Banjarbaru', 6372, 63),
(320, 'Kabupaten Pasir', 6401, 64),
(321, 'Kabupaten Kutai Barat', 6402, 64),
(322, 'Kabupaten Kutai Kartanegara', 6403, 64),
(323, 'Kabupaten Kutai Timur', 6404, 64),
(324, 'Kabupaten Berau', 6405, 64),
(325, 'Kabupaten Malinau', 6406, 64),
(326, 'Kabupaten Bulongan', 6407, 64),
(327, 'Kabupaten Nunukan', 6408, 64),
(328, 'Kabupaten Penajam Paser Utara', 6409, 64),
(329, 'Balikpapan', 6471, 64),
(330, 'Samarinda', 6472, 64),
(331, 'Tarakan', 6473, 64),
(332, 'Bontang', 6474, 64),
(333, 'Kabupaten Bolaang Mongondow', 7101, 71),
(334, 'Kabupaten Minahasa', 7102, 71),
(335, 'Kabupaten Kepulauan Sangihe', 7103, 71),
(336, 'Kabupaten Kepualuan Talaud', 7104, 71),
(337, 'Kabupaten Minahasa Selatan', 7105, 71),
(338, 'Kabupaten Minahasa Utara', 7106, 71),
(339, 'Manado', 7171, 71),
(340, 'Bitung', 7172, 71),
(341, 'Tomohon', 7173, 71),
(342, 'Kabupaten Banggai Kepulauan', 7201, 72),
(343, 'Kabupaten Banggai', 7202, 72),
(344, 'Kabupaten Morowali', 7203, 72),
(345, 'Kabupaten Poso', 7204, 72),
(346, 'Kabupaten Donggala', 7205, 72),
(347, 'Kabupaten Toli-toli', 7206, 72),
(348, 'Kabupaten Buol', 7207, 72),
(349, 'Kabupaten Parigi Moutong', 7208, 72),
(350, 'Kabupaten Tojo Una-una', 7209, 72),
(351, 'Palu', 7271, 72),
(352, 'Kabupaten Selayar', 7301, 73),
(353, 'Kabupaten Bulukumba', 7302, 73),
(354, 'Kabupaten Bantaeng', 7303, 73),
(355, 'Kabupaten Jeneponto', 7304, 73),
(356, 'Kabupaten Takalar', 7305, 73),
(357, 'Kabupaten Gowa', 7306, 73),
(358, 'Kabupaten Sinjai', 7307, 73),
(359, 'Kabupaten Maros', 7308, 73),
(360, 'Kabupaten Pangkajene Kepulauan', 7309, 73),
(361, 'Kabupaten Barru', 7310, 73),
(362, 'Kabupaten Bone', 7311, 73),
(363, 'Kabupaten Soppeng', 7312, 73),
(364, 'Kabupaten Wajo', 7313, 73),
(365, 'Kabupaten Sidenreng Rappang', 7314, 73),
(366, 'Kabupaten Pinrang', 7315, 73),
(367, 'Kabupaten Enrekang', 7316, 73),
(368, 'Kabupaten Luwu', 7317, 73),
(369, 'Kabupaten Tana Toraja', 7318, 73),
(370, 'Kabupaten Polewali Mamasa', 7319, 73),
(371, 'Kabupaten Majene', 7320, 73),
(372, 'Kabupaten Mamuju', 7321, 73),
(373, 'Kabupaten Luwu Utara', 7322, 73),
(374, 'Kabupaten Mamasa', 7323, 73),
(375, 'Kabupaten Mamuju Utara', 7324, 73),
(376, 'Kabupaten Luwu Timur', 7325, 73),
(377, 'Ujung Pandang', 7371, 73),
(378, 'Pare-pare', 7372, 73),
(379, 'Palopo', 7373, 73),
(380, 'Kabupaten Buton', 7401, 74),
(381, 'Kabupaten Muna', 7402, 74),
(382, 'Kabupaten Konawe', 7403, 74),
(383, 'Kabupaten Kolaka', 7404, 74),
(384, 'Kabupaten Konawe Selatan', 7405, 74),
(385, 'Kabupaten Bombana', 7406, 74),
(386, 'Kabupaten Wakatobi', 7407, 74),
(387, 'Kabupaten Kolaka Utara', 7408, 74),
(388, 'Kendari', 7471, 74),
(389, 'Bau Bau', 7472, 74),
(390, 'Kabupaten Boalemo', 7501, 75),
(391, 'Kabupaten Gorontalo', 7502, 75),
(392, 'Kabupaten Pohuwato', 7503, 75),
(393, 'Kabupaten Bone Bolango', 7504, 75),
(394, 'Gorontalo', 7571, 75),
(395, 'Kabupaten Maluku Tenggara Bara', 8101, 81),
(396, 'Kabupaten Maluku Tenggara', 8102, 81),
(397, 'Kabupaten Maluku Tengah', 8103, 81),
(398, 'Kabupaten Buru', 8104, 81),
(399, 'Kabupaten Kepulauan Aru', 8105, 81),
(400, 'Kabupaten Seram Bagian Barat', 8106, 81),
(401, 'Kabupaten Seram Bagian Timur', 8107, 81),
(402, 'Ambon', 8171, 81),
(403, 'Kabupaten Halmahera Barat', 8201, 82),
(404, 'Kabupaten Halmahera Tengah', 8202, 82),
(405, 'Kabupaten Kepulauan Sula', 8203, 82),
(406, 'Kabupaten Halmahera Selatan', 8204, 82),
(407, 'Kabupaten Halmahera Utara', 8205, 82),
(408, 'Kabupaten Halmahera Timur', 8206, 82),
(409, 'Ternate', 8271, 82),
(410, 'Tidore Kepulauan', 8272, 82),
(411, 'Kabupaten Merauke', 9401, 94),
(412, 'Kabupaten Jayawijaya', 9402, 94),
(413, 'Kabupaten Jayapura', 9403, 94),
(414, 'Kabupaten Nabire', 9404, 94),
(415, 'Kabupaten Fakfak', 9405, 94),
(416, 'Kabupaten Sorong', 9406, 94),
(417, 'Kabupaten Manokwari', 9407, 94),
(418, 'Kabupaten Yapen Waropen', 9408, 94),
(419, 'Kabupaten Biak Numfor', 9409, 94),
(420, 'Kabupaten Paniai', 9410, 94),
(421, 'Kabupaten Puncak Jaya', 9411, 94),
(422, 'Kabupaten Mimika', 9412, 94),
(423, 'Kabupaten Boven Digoel', 9413, 94),
(424, 'Kabupaten Mappi', 9414, 94),
(425, 'Kabupaten Asmat', 9415, 94),
(426, 'Kabupaten Yahukimo', 9416, 94),
(427, 'Kabupaten Pegunungan Bintang', 9417, 94),
(428, 'Kabupaten Tolikara', 9418, 94),
(429, 'Kabupaten Sarmi', 9419, 94),
(430, 'Kabupaten Keerom', 9420, 94),
(431, 'Kabupaten Kaimana', 9421, 94),
(432, 'Kabupaten Sorong Selatan', 9422, 94),
(433, 'Kabupaten Raja Ampat', 9423, 94),
(434, 'Kabupaten Teluk Bintuni', 9424, 94),
(435, 'Kabupaten Teluk Wondama', 9425, 94),
(436, 'Kabupaten Waropen', 9426, 94),
(437, 'Kabupaten Supiori', 9427, 94),
(438, 'Jayapura', 9471, 94),
(439, 'Sorong', 9472, 94),
(440, 'Lain-lain', 9999, 96);

-- --------------------------------------------------------

--
-- Table structure for table `logaktifitas`
--

CREATE TABLE IF NOT EXISTS `logaktifitas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `dataType` varchar(100) NOT NULL,
  `dataId` int(11) NOT NULL,
  `dataAction` varchar(45) NOT NULL,
  `remark` text NOT NULL,
  `ip` varchar(45) NOT NULL,
  `userAgent` varchar(140) NOT NULL,
  `create` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `matauang`
--

CREATE TABLE IF NOT EXISTS `matauang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `simbol` varchar(3) NOT NULL,
  `kurs` double NOT NULL,
  `negara_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=175 ;

--
-- Dumping data for table `matauang`
--

INSERT INTO `matauang` (`id`, `nama`, `simbol`, `kurs`, `negara_id`) VALUES
(2, 'Australian Dollar', 'AUD', 0, 17),
(3, 'Brunei Dollar', 'BND', 0, NULL),
(4, 'Canadian Dollar', 'CAD', 0, NULL),
(5, 'Swiss Franc', 'CHF', 0, NULL),
(6, 'Chinese Yuan', 'CNY', 0, NULL),
(7, 'Danish Kroner', 'DKK', 0, NULL),
(8, 'Euro', 'EUR', 0, NULL),
(9, 'British Pound', 'GBP', 0, NULL),
(10, 'Hongkong Dollar', 'HKD', 0, NULL),
(11, 'Japanese Yen', 'JPY', 0, NULL),
(12, 'South Korean Won', 'KRW', 0, NULL),
(13, 'Malaysian Ringgit', 'MYR', 0, NULL),
(14, 'Norwegian Krone', 'NOK', 0, NULL),
(15, 'New Zealand Dollar', 'NZD', 0, NULL),
(16, 'Papua New Guinean Kina', 'PGK', 0, NULL),
(17, 'Philippine Peso', 'PHP', 0, NULL),
(18, 'Swedish Krona', 'SEK', 0, NULL),
(19, 'Singapore Dollar', 'SGD', 0, NULL),
(20, 'Thailand Baht', 'THB', 0, NULL),
(21, 'US Dollar', 'USD', 0, NULL),
(22, 'UNITED ARAB EMIRATES, DIRHAMS', 'AED', 0, NULL),
(23, 'AFGHANISTAN, AFGHANIS', 'AFA', 0, NULL),
(24, 'ALBANIA, LEKE', 'ALL', 0, NULL),
(25, 'ARMENIA, DRAMS', 'AMD', 0, NULL),
(26, 'NETHERLANDS ANTILLES, GUILDERS', 'ANG', 0, NULL),
(27, 'ANGOLA, KWANZA', 'AOA', 0, NULL),
(28, 'ARGENTINA, PESOS', 'ARS', 0, NULL),
(29, 'ARUBA, GUILDERS', 'AWG', 0, NULL),
(30, 'AZERBAIJAN, MANATS', 'AZM', 0, NULL),
(31, 'BOSNIA AND HERZEGOVINA, CONVERTIBLE MARKA', 'BAM', 0, NULL),
(32, 'BARBADOS, DOLLARS', 'BBD', 0, NULL),
(33, 'BANGLADESH, TAKA', 'BDT', 0, NULL),
(34, 'BULGARIA, LEVA', 'BGN', 0, NULL),
(35, 'BAHRAIN, DINARS', 'BHD', 0, NULL),
(36, 'BURUNDI, FRANCS', 'BIF', 0, NULL),
(37, 'BERMUDA, DOLLARS', 'BMD', 0, NULL),
(38, 'BOLIVIA, BOLIVIANOS', 'BOB', 0, NULL),
(39, 'BRAZIL, BRAZIL REAL', 'BRL', 0, NULL),
(40, 'BAHAMAS, DOLLARS', 'BSD', 0, NULL),
(41, 'BHUTAN, NGULTRUM', 'BTN', 0, NULL),
(42, 'BOTSWANA, PULAS', 'BWP', 0, NULL),
(43, 'BELARUS, RUBLES', 'BYR', 0, NULL),
(44, 'BELIZE, DOLLARS', 'BZD', 0, NULL),
(45, 'CONGO/KINSHASA, CONGOLESE FRANCS', 'CDF', 0, NULL),
(46, 'CHILE, PESOS', 'CLP', 0, NULL),
(47, 'COLOMBIA, PESOS', 'COP', 0, NULL),
(48, 'COSTA RICA, COLONES', 'CRC', 0, NULL),
(49, 'CUBA, PESOS', 'CUP', 0, NULL),
(50, 'CAPE VERDE, ESCUDOS', 'CVE', 0, NULL),
(51, 'CYPRUS, POUNDS', 'CYP', 0, NULL),
(52, 'CZECH REPUBLIC, KORUNY', 'CZK', 0, NULL),
(53, 'DJIBOUTI, FRANCS', 'DJF', 0, NULL),
(54, 'DOMINICAN REPUBLIC, PESOS', 'DOP', 0, NULL),
(55, 'ALGERIA, ALGERIA DINARS', 'DZD', 0, NULL),
(56, 'ESTONIA, KROONI', 'EEK', 0, NULL),
(57, 'EGYPT, POUNDS', 'EGP', 0, NULL),
(58, 'ERITREA, NAKFA', 'ERN', 0, NULL),
(59, 'ETHIOPIA, BIRR', 'ETB', 0, NULL),
(60, 'FIJI, DOLLARS', 'FJD', 0, NULL),
(61, 'FALKLAND ISLANDS (MALVINAS), POUNDS', 'FKP', 0, NULL),
(62, 'GEORGIA, LARI', 'GEL', 0, NULL),
(63, 'GUERNSEY, POUNDS', 'GGP', 0, NULL),
(64, 'GHANA, CEDIS', 'GHC', 0, NULL),
(65, 'GIBRALTAR, POUNDS', 'GIP', 0, NULL),
(66, 'GAMBIA, DALASI', 'GMD', 0, NULL),
(67, 'GUINEA, FRANCS', 'GNF', 0, NULL),
(68, 'GUATEMALA, QUETZALES', 'GTQ', 0, NULL),
(69, 'GUYANA, DOLLARS', 'GYD', 0, NULL),
(70, 'HONDURAS, LEMPIRAS', 'HNL', 0, NULL),
(71, 'CROATIA, KUNA', 'HRK', 0, NULL),
(72, 'HAITI, GOURDES', 'HTG', 0, NULL),
(73, 'HUNGARY, FORINT', 'HUF', 0, NULL),
(74, 'INDONESIA, RUPIAHS', 'IDR', 0, NULL),
(75, 'ISRAEL, NEW SHEKELS', 'ILS', 0, NULL),
(76, 'ISLE OF MAN, POUNDS', 'IMP', 0, NULL),
(77, 'INDIA, RUPEES', 'INR', 0, NULL),
(78, 'IRAQ, DINARS', 'IQD', 0, NULL),
(79, 'IRAN, RIALS', 'IRR', 0, NULL),
(80, 'ICELAND, KRONUR', 'ISK', 0, NULL),
(81, 'JERSEY, POUNDS', 'JEP', 0, NULL),
(82, 'JAMAICA, DOLLARS', 'JMD', 0, NULL),
(83, 'JORDAN, DINARS', 'JOD', 0, NULL),
(84, 'KENYA, SHILLINGS', 'KES', 0, NULL),
(85, 'KYRGYZSTAN, SOMS', 'KGS', 0, NULL),
(86, 'CAMBODIA, RIELS', 'KHR', 0, NULL),
(87, 'COMOROS, FRANCS', 'KMF', 0, NULL),
(88, 'KOREA (NORTH), WON', 'KPW', 0, NULL),
(89, 'KUWAIT, DINARS', 'KWD', 0, NULL),
(90, 'CAYMAN ISLANDS, DOLLARS', 'KYD', 0, NULL),
(91, 'KAZAKSTAN, TENGE', 'KZT', 0, NULL),
(92, 'LAOS, KIPS', 'LAK', 0, NULL),
(93, 'LEBANON, POUNDS', 'LBP', 0, NULL),
(94, 'SRI LANKA, RUPEES', 'LKR', 0, NULL),
(95, 'LIBERIA, DOLLARS', 'LRD', 0, NULL),
(96, 'LESOTHO, MALOTI', 'LSL', 0, NULL),
(97, 'LITHUANIA, LITAI', 'LTL', 0, NULL),
(98, 'LATVIA, LATI', 'LVL', 0, NULL),
(99, 'Lain-Lain', 'LAI', 0, NULL),
(100, 'LIBYA, DINARS', 'LYD', 0, NULL),
(101, 'MOROCCO, DIRHAMS', 'MAD', 0, NULL),
(102, 'MOLDOVA, LEI', 'MDL', 0, NULL),
(103, 'MADAGASCAR, ARIARY', 'MGA', 0, NULL),
(104, 'MACEDONIA, DENARS', 'MKD', 0, NULL),
(105, 'MYANMAR (BURMA), KYATS', 'MMK', 0, NULL),
(106, 'MONGOLIA, TUGRIKS', 'MNT', 0, NULL),
(107, 'MACAU, PATACAS', 'MOP', 0, NULL),
(108, 'MAURITANIA, OUGUIYAS', 'MRO', 0, NULL),
(109, 'MALTA, LIRI', 'MTL', 0, NULL),
(110, 'MAURITIUS, RUPEES', 'MUR', 0, NULL),
(111, 'MALDIVES (MALDIVE ISLANDS), RUFIYAA', 'MVR', 0, NULL),
(112, 'MALAWI, KWACHAS', 'MWK', 0, NULL),
(113, 'MEXICO, PESOS', 'MXN', 0, NULL),
(114, 'MOZAMBIQUE, METICAIS', 'MZM', 0, NULL),
(115, 'NAMIBIA, DOLLARS', 'NAD', 0, NULL),
(116, 'NIGERIA, NAIRAS', 'NGN', 0, NULL),
(117, 'NICARAGUA, GOLD CORDOBAS', 'NIO', 0, NULL),
(118, 'NEPAL, NEPAL RUPEES', 'NPR', 0, NULL),
(119, 'OMAN, RIALS', 'OMR', 0, NULL),
(120, 'PANAMA, BALBOA', 'PAB', 0, NULL),
(121, 'PERU, NUEVOS SOLES', 'PEN', 0, NULL),
(122, 'PAKISTAN, RUPEES', 'PKR', 0, NULL),
(123, 'POLAND, ZLOTYCH', 'PLN', 0, NULL),
(124, 'PARAGUAY, GUARANI', 'PYG', 0, NULL),
(125, 'QATAR, RIALS', 'QAR', 0, NULL),
(126, 'ROMANIA, LEI', 'ROL', 0, NULL),
(127, 'RUSSIA, RUBLES', 'RUR', 0, NULL),
(128, 'RWANDA, RWANDA FRANCS', 'RWF', 0, NULL),
(129, 'SAUDI ARABIA, RIYALS', 'SAR', 0, NULL),
(130, 'SOLOMON ISLANDS, DOLLARS', 'SBD', 0, NULL),
(131, 'SEYCHELLES, RUPEES', 'SCR', 0, NULL),
(132, 'SUDAN, DINARS', 'SDD', 0, NULL),
(133, 'SAINT HELENA, POUNDS', 'SHP', 0, NULL),
(134, 'SLOVENIA, TOLARS', 'SIT', 0, NULL),
(135, 'SLOVAKIA, KORUNY', 'SKK', 0, NULL),
(136, 'SIERRA LEONE, LEONES', 'SLL', 0, NULL),
(137, 'SOMALIA, SHILLINGS', 'SOS', 0, NULL),
(138, 'SEBORGA, LUIGINI', 'SPL', 0, NULL),
(139, 'SURINAME, GUILDERS', 'SRG', 0, NULL),
(140, 'SAO TOME AND PRINCIPE, DOBRAS', 'STD', 0, NULL),
(141, 'EL SALVADOR, COLONES', 'SVC', 0, NULL),
(142, 'SYRIA, POUNDS', 'SYP', 0, NULL),
(143, 'SWAZILAND, EMALANGENI', 'SZL', 0, NULL),
(144, 'TAJIKISTAN, SOMONI', 'TJS', 0, NULL),
(145, 'TURKMENISTAN, MANATS', 'TMM', 0, NULL),
(146, 'TUNISIA, DINARS', 'TND', 0, NULL),
(147, 'TONGA, PA''ANGA', 'TOP', 0, NULL),
(148, 'TURKEY, LIRAS', 'TRL', 0, NULL),
(149, 'TRINIDAD AND TOBAGO, DOLLARS', 'TTD', 0, NULL),
(150, 'TUVALU, TUVALU DOLLARS', 'TVD', 0, NULL),
(151, 'TAIWAN, NEW DOLLARS', 'TWD', 0, NULL),
(152, 'TANZANIA, SHILLINGS', 'TZS', 0, NULL),
(153, 'UKRAINE, HRYVNIA', 'UAH', 0, NULL),
(154, 'UGANDA, SHILLINGS', 'UGX', 0, NULL),
(155, 'URUGUAY, PESOS', 'UYU', 0, NULL),
(156, 'UZBEKISTAN, SUMS', 'UZS', 0, NULL),
(157, 'VENEZUELA, BOLIVARES', 'VEB', 0, NULL),
(158, 'VIET NAM, DONG', 'VND', 0, NULL),
(159, 'VANUATU, VATU', 'VUV', 0, NULL),
(160, 'SAMOA, TALA', 'WST', 0, NULL),
(161, 'COMMUNAUT FINANCIERE AFRICAINE BEAC, FRANCS', 'XAF', 0, NULL),
(162, 'SILVER, OUNCES', 'XAG', 0, NULL),
(163, 'GOLD, OUNCES', 'XAU', 0, NULL),
(164, 'EAST CARIBBEAN DOLLARS', 'XCD', 0, NULL),
(165, 'INTERNATIONAL MONETARY FUND (IMF) SPECIAL DRAWING RIGHTS', 'XDR', 0, NULL),
(166, 'COMMUNAUT FINANCIERE AFRICAINE BCEAO, FRANCS', 'XOF', 0, NULL),
(167, 'PALLADIUM OUNCES', 'XPD', 0, NULL),
(168, 'COMPTOIRS FRAN€AIS DU PACIFIQUE FRANCS', 'XPF', 0, NULL),
(169, 'PLATINUM, OUNCES', 'XPT', 0, NULL),
(170, 'YEMEN, RIALS', 'YER', 0, NULL),
(171, 'YUGOSLAVIA, NEW DINARS', 'YUM', 0, NULL),
(172, 'SOUTH AFRICA, RAND', 'ZAR', 0, NULL),
(173, 'ZAMBIA, KWACHA', 'ZMK', 0, NULL),
(174, 'ZIMBABWE, ZIMBABWE DOLLARS', 'ZWD', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `nasabahkorporasi`
--

CREATE TABLE IF NOT EXISTS `nasabahkorporasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `noRekening` varchar(50) NOT NULL,
  `namaKorporasi` varchar(255) NOT NULL,
  `idBentukBadan` tinyint(4) DEFAULT NULL,
  `bentukBadanLainnya` varchar(50) DEFAULT NULL,
  `idBidangUsaha` tinyint(4) NOT NULL,
  `bidangUsahaLainnya` varchar(50) DEFAULT NULL,
  `alamat` varchar(100) NOT NULL,
  `idPropinsi` int(11) NOT NULL,
  `propinsiLainnya` varchar(50) DEFAULT NULL,
  `idKabKota` int(11) NOT NULL,
  `kabKotaLainnya` varchar(50) DEFAULT NULL,
  `noTelp` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `nasabahkorporasi`
--

INSERT INTO `nasabahkorporasi` (`id`, `noRekening`, `namaKorporasi`, `idBentukBadan`, `bentukBadanLainnya`, `idBidangUsaha`, `bidangUsahaLainnya`, `alamat`, `idPropinsi`, `propinsiLainnya`, `idKabKota`, `kabKotaLainnya`, `noTelp`) VALUES
(1, '123', 'cv. ayam cidokom sejahtera', 1, '', 3, '', 'cidokom', 31, '', 134, '', '085774249862'),
(2, '124', 'PT. Diana', 2, '', 18, '', 'jakarta', 32, '', 154, '', ''),
(3, '126789', 'Peternakan Ayam', 9, 'peternakan Mandiri', 3, '', 'bogor', 32, '', 154, '', '085774249862'),
(4, '123567', 'pt peun', 2, '', 2, '', 'bogor', 32, '', 154, '', '0812345678');

-- --------------------------------------------------------

--
-- Table structure for table `nasabahperorangan`
--

CREATE TABLE IF NOT EXISTS `nasabahperorangan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `noRekening` varchar(50) NOT NULL,
  `namaLengkap` varchar(255) NOT NULL,
  `tglLahir` date NOT NULL,
  `kewarganegaraan` tinyint(4) DEFAULT NULL,
  `idNegaraKewarganegaraan` int(11) DEFAULT NULL,
  `negaraLainnyaKewarganegaraan` varchar(50) DEFAULT NULL,
  `idPekerjaan` tinyint(4) NOT NULL,
  `pekerjaanLainnya` varchar(50) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `idPropinsi` int(11) DEFAULT NULL,
  `propinsiLainnya` varchar(50) DEFAULT NULL,
  `idKabKota` int(11) DEFAULT NULL,
  `kabKotaLainnya` varchar(50) DEFAULT NULL,
  `alamatBuktiIdentitas` varchar(100) NOT NULL,
  `idPropinsiBuktiIdentitas` int(11) NOT NULL,
  `propinsiLainnyaBuktiIdentitas` varchar(50) DEFAULT NULL,
  `idKabKotaBuktiIdentitas` int(11) DEFAULT NULL,
  `kabKotaLainnyaBuktiIdentitas` varchar(50) DEFAULT NULL,
  `noTelp` varchar(30) DEFAULT NULL,
  `ktp` varchar(30) DEFAULT NULL,
  `sim` varchar(30) DEFAULT NULL,
  `passport` varchar(30) DEFAULT NULL,
  `kimsKitasKitab` varchar(30) DEFAULT NULL,
  `npwp` varchar(30) DEFAULT NULL,
  `jenisBuktiLain` varchar(30) DEFAULT NULL,
  `noBuktiLain` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `nasabahperorangan`
--

INSERT INTO `nasabahperorangan` (`id`, `noRekening`, `namaLengkap`, `tglLahir`, `kewarganegaraan`, `idNegaraKewarganegaraan`, `negaraLainnyaKewarganegaraan`, `idPekerjaan`, `pekerjaanLainnya`, `alamat`, `idPropinsi`, `propinsiLainnya`, `idKabKota`, `kabKotaLainnya`, `alamatBuktiIdentitas`, `idPropinsiBuktiIdentitas`, `propinsiLainnyaBuktiIdentitas`, `idKabKotaBuktiIdentitas`, `kabKotaLainnyaBuktiIdentitas`, `noTelp`, `ktp`, `sim`, `passport`, `kimsKitasKitab`, `npwp`, `jenisBuktiLain`, `noBuktiLain`) VALUES
(1, '12345', 'Rudi Cahyadi', '1988-08-02', 1, NULL, '', 7, '', 'Tangerang', 31, '', 136, '', 'Jakarta', 31, '', 136, '', '', '', '', '', '', '', '', ''),
(2, '12478', 'Ahda M', '1988-11-01', 1, NULL, '', 9, '', 'Ciputat', 31, '', 134, '', 'Ciputat', 31, '', 134, '', '', '', '', '', '', '', '', ''),
(3, '137654', 'Widodo Pangestu', '1988-07-07', 1, NULL, '', 9, '', 'Tangerang', 36, '', 245, '', 'Tangerang', 36, '', 245, '', '08131234567', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `nasabah_korporasi_dn`
--

CREATE TABLE IF NOT EXISTS `nasabah_korporasi_dn` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `noRekening` varchar(50) DEFAULT NULL,
  `namaKorporasi` varchar(255) NOT NULL,
  `bentukBadan` int(11) DEFAULT NULL,
  `bentukBadanLain` varchar(255) DEFAULT NULL,
  `bidangUsaha` int(11) DEFAULT NULL,
  `bidangUsahaLain` varchar(50) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `idPropinsi` int(11) NOT NULL,
  `propinsiLain` varchar(50) DEFAULT NULL,
  `idKabKota` int(11) NOT NULL,
  `kabKotaLain` varchar(50) DEFAULT NULL,
  `noTelp` varchar(30) DEFAULT NULL,
  `nilaiTransaksiDalamRupiah` double DEFAULT NULL,
  `swift_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_nasabah_korporasi_dn_propinsi1_idx` (`idPropinsi`),
  KEY `fk_nasabah_korporasi_dn_swift1_idx` (`swift_id`),
  KEY `fk_nasabah_korporasi_dn_kabupaten1_idx` (`idKabKota`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `nasabah_korporasi_dn`
--

INSERT INTO `nasabah_korporasi_dn` (`id`, `noRekening`, `namaKorporasi`, `bentukBadan`, `bentukBadanLain`, `bidangUsaha`, `bidangUsahaLain`, `alamat`, `idPropinsi`, `propinsiLain`, `idKabKota`, `kabKotaLain`, `noTelp`, `nilaiTransaksiDalamRupiah`, `swift_id`) VALUES
(1, '6798798', 'test', 2, '', 18, '', '', 52, '', 9, '', '', NULL, 154),
(2, '6798798', 'test', 2, '', 18, '', '', 52, '', 9, '', '', NULL, 154);

-- --------------------------------------------------------

--
-- Table structure for table `nasabah_korporasi_ln`
--

CREATE TABLE IF NOT EXISTS `nasabah_korporasi_ln` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `noRekening` varchar(50) DEFAULT NULL,
  `namaKorporasi` varchar(255) NOT NULL,
  `bentukBadan` int(11) DEFAULT NULL,
  `bentukBadanLain` varchar(255) DEFAULT NULL,
  `bidangUsaha` int(11) DEFAULT NULL,
  `bidangUsahaLain` varchar(50) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `negaraBagianKota` varchar(50) DEFAULT NULL,
  `idNegara` int(11) NOT NULL,
  `negaraLain` varchar(50) DEFAULT NULL,
  `noTelp` varchar(30) DEFAULT NULL,
  `nilaiTransaksiDalamRupiah` double DEFAULT NULL,
  `swift_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_nasabah_korporasi_ln_negara1_idx` (`idNegara`),
  KEY `fk_nasabah_korporasi_ln_swift1_idx` (`swift_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `nasabah_perorangan_dn`
--

CREATE TABLE IF NOT EXISTS `nasabah_perorangan_dn` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `noRekening` varchar(50) NOT NULL,
  `namaLengkap` varchar(255) NOT NULL,
  `tglLahir` date DEFAULT NULL,
  `wargaNegara` int(1) DEFAULT NULL,
  `idNegaraKewarganegaraan` int(11) NOT NULL,
  `negaraLainKewarganegaraan` varchar(50) DEFAULT NULL,
  `pekerjaan` int(11) DEFAULT NULL,
  `pekerjaanLain` varchar(50) DEFAULT NULL,
  `alamatDomisili` varchar(100) DEFAULT NULL,
  `idPropinsiDomisili` int(11) NOT NULL,
  `propinsiLainDomisili` varchar(50) DEFAULT NULL,
  `idKabKotaDomisili` int(11) NOT NULL,
  `kabKotaLain` varchar(50) DEFAULT NULL,
  `alamatIdentitas` varchar(100) DEFAULT NULL,
  `idPropinsiIdentitas` int(11) NOT NULL,
  `propinsiLainIdentitas` varchar(50) DEFAULT NULL,
  `idKabKotaIdentitas` int(11) NOT NULL,
  `kabKotaLainIdentitas` varchar(50) DEFAULT NULL,
  `noTelp` varchar(30) DEFAULT NULL,
  `ktp` varchar(30) DEFAULT NULL,
  `sim` varchar(30) DEFAULT NULL,
  `passport` varchar(30) DEFAULT NULL,
  `kimsKitasKitap` varchar(30) DEFAULT NULL,
  `npwp` varchar(30) DEFAULT NULL,
  `jenisBuktiLain` varchar(30) DEFAULT NULL,
  `noBuktiLain` varchar(30) DEFAULT NULL,
  `nilaiTransaksiDalamRupiah` double DEFAULT NULL,
  `swift_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_nasabah_perorangan_dn_negara1_idx` (`idNegaraKewarganegaraan`),
  KEY `fk_nasabah_perorangan_dn_propinsi1_idx` (`idPropinsiDomisili`),
  KEY `fk_nasabah_perorangan_dn_kabupaten1_idx` (`idKabKotaDomisili`),
  KEY `fk_nasabah_perorangan_dn_propinsi2_idx` (`idPropinsiIdentitas`),
  KEY `fk_nasabah_perorangan_dn_kabupaten2_idx` (`idKabKotaIdentitas`),
  KEY `fk_nasabah_perorangan_dn_swift1_idx` (`swift_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `nasabah_perorangan_dn`
--

INSERT INTO `nasabah_perorangan_dn` (`id`, `noRekening`, `namaLengkap`, `tglLahir`, `wargaNegara`, `idNegaraKewarganegaraan`, `negaraLainKewarganegaraan`, `pekerjaan`, `pekerjaanLain`, `alamatDomisili`, `idPropinsiDomisili`, `propinsiLainDomisili`, `idKabKotaDomisili`, `kabKotaLain`, `alamatIdentitas`, `idPropinsiIdentitas`, `propinsiLainIdentitas`, `idKabKotaIdentitas`, `kabKotaLainIdentitas`, `noTelp`, `ktp`, `sim`, `passport`, `kimsKitasKitap`, `npwp`, `jenisBuktiLain`, `noBuktiLain`, `nilaiTransaksiDalamRupiah`, `swift_id`) VALUES
(1, '9879', 'rudi cahyadi', '2013-11-06', 1, 16, '', NULL, '', '', 34, '', 17, '', '', 16, '', 13, '', '', '123', '', '', '', '', '', '', NULL, 147),
(3, '876587587', 'Widarto', '2013-11-14', 1, 2, '', 15, '', '', 21, '', 128, '', '', 36, '', 12, '', '', '78578687', '', '', '', '', '', '', NULL, 154),
(5, '876987', 'nnnnnnnnnn', '1970-01-01', NULL, 12, '', NULL, '', '', 32, '', 150, '', '', 19, '', 8, '', '', '', '', '', '', '', '', '', NULL, 154),
(7, '87687', 'kkkkk', '1970-01-01', NULL, 8, '', NULL, '', '', 32, '', 145, '', '', 32, '', 14, '', '', '', '', '', '', '', '', '', NULL, 154),
(9, '99999', 'bbbbbbbbbbb', '1970-01-01', NULL, 10, '', NULL, '', '', 21, '', 128, '', '', 32, '', 13, '', '', '', '', '', '', '', '', '', NULL, 154);

-- --------------------------------------------------------

--
-- Table structure for table `nasabah_perorangan_ln`
--

CREATE TABLE IF NOT EXISTS `nasabah_perorangan_ln` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `noRekening` varchar(50) NOT NULL,
  `namaLengkap` varchar(255) NOT NULL,
  `tglLahir` date DEFAULT NULL,
  `wargaNegara` int(1) DEFAULT NULL,
  `idNegaraKewarganegaraan` int(11) NOT NULL,
  `negaraLainKewarganegaraan` varchar(50) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `negaraBagianKota` varchar(50) DEFAULT NULL,
  `idNegaraVoucher` int(11) NOT NULL,
  `negaraLainVoucher` varchar(50) DEFAULT NULL,
  `noTelp` varchar(30) DEFAULT NULL,
  `ktp` varchar(30) DEFAULT NULL,
  `sim` varchar(30) DEFAULT NULL,
  `passport` varchar(30) DEFAULT NULL,
  `kimsKitasKitap` varchar(30) DEFAULT NULL,
  `npwp` varchar(30) DEFAULT NULL,
  `jenisBuktiLain` varchar(30) DEFAULT NULL,
  `noBuktiLain` varchar(30) DEFAULT NULL,
  `nilaiTransaksiDalamRupiah` double DEFAULT NULL,
  `swift_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_nasabah_perorangan_ln_negara1_idx` (`idNegaraKewarganegaraan`),
  KEY `fk_nasabah_perorangan_ln_negara2_idx` (`idNegaraVoucher`),
  KEY `fk_nasabah_perorangan_ln_swift1_idx` (`swift_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `nasabah_perorangan_ln`
--

INSERT INTO `nasabah_perorangan_ln` (`id`, `noRekening`, `namaLengkap`, `tglLahir`, `wargaNegara`, `idNegaraKewarganegaraan`, `negaraLainKewarganegaraan`, `alamat`, `negaraBagianKota`, `idNegaraVoucher`, `negaraLainVoucher`, `noTelp`, `ktp`, `sim`, `passport`, `kimsKitasKitap`, `npwp`, `jenisBuktiLain`, `noBuktiLain`, `nilaiTransaksiDalamRupiah`, `swift_id`) VALUES
(1, '123', 'Widarto Pangestu', '2013-11-11', 1, 62, '', '', '', 9, '', '', '', '', '', '', '', '', '', NULL, 147);

-- --------------------------------------------------------

--
-- Table structure for table `negara`
--

CREATE TABLE IF NOT EXISTS `negara` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(2) NOT NULL,
  `nama` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1000 ;

--
-- Dumping data for table `negara`
--

INSERT INTO `negara` (`id`, `kode`, `nama`) VALUES
(1, '', 'Amerika Serikat '),
(2, '', 'Republik Rakyat Cina '),
(3, '', 'Jepang '),
(4, '', 'India '),
(5, '', 'Jerman '),
(6, '', 'Britania Raya '),
(7, '', 'Perancis '),
(8, '', 'Italia '),
(9, '', 'Brasil '),
(10, '', 'Rusia '),
(11, '', 'Spanyol '),
(12, '', 'Meksiko '),
(13, '', 'Kanada '),
(14, '', 'Korea Selatan '),
(16, '', 'Republik Cina(Taiwan) '),
(17, '', 'Australia '),
(18, '', 'Turki '),
(19, '', 'Afrika Selatan '),
(20, '', 'Argentina '),
(21, '', 'Thailand '),
(22, '', 'Iran '),
(23, '', 'Belanda '),
(24, '', 'Polandia '),
(25, '', 'Filipina '),
(26, '', 'Pakistan '),
(27, '', 'Arab Saudi '),
(28, '', 'Kolombia '),
(29, '', 'Belgia '),
(30, '', 'Ukraina '),
(31, '', 'Mesir '),
(32, '', 'Bangladesh '),
(33, '', 'Swedia '),
(34, '', 'Malaysia '),
(35, '', 'Austria '),
(36, '', 'Yunani '),
(37, '', 'Swiss '),
(38, '', 'Vietnam '),
(39, '', 'Algeria '),
(40, '', 'Hong Kong '),
(41, '', 'Portugal '),
(42, '', 'Republik Ceko '),
(43, '', 'Romania '),
(44, '', 'Chili '),
(45, '', 'Israel '),
(46, '', 'Norwegia '),
(47, '', 'Denmark '),
(48, '', 'Hungaria '),
(49, '', 'Venezuela '),
(50, '', 'Finlandia '),
(51, '', 'Republik Irlandia '),
(52, '', 'Peru '),
(53, '', 'Nigeria '),
(54, '', 'Moroko '),
(55, '', 'Singapura'),
(56, '', 'Uni Emirat Arab '),
(57, '', 'Kazakhstan '),
(58, '', 'Myanmar '),
(59, '', 'Selandia Baru '),
(60, '', 'Sri Lanka '),
(61, '', 'Slovakia '),
(62, '', 'Indonesia'),
(63, '', 'Tunisia '),
(64, '', 'Belarus '),
(65, '', 'Syria '),
(66, '', 'Ethiopia '),
(67, '', 'Dominika '),
(68, '', 'Bulgaria '),
(69, '', 'Libya '),
(70, '', 'Ekuador '),
(71, '', 'Kroasia '),
(72, '', 'Guatemala '),
(73, '', 'Kuwait '),
(74, '', 'Uzbekistan '),
(75, '', 'Ghana '),
(76, '', 'Lithuania '),
(77, '', 'Serbia '),
(78, '', 'Kosta Rika '),
(79, '', 'Republik Demokratik Kongo '),
(80, '', 'Angola '),
(81, '', 'Uganda '),
(82, '', 'Slovenia '),
(83, '', 'Oman '),
(84, '', 'Nepal '),
(85, '', 'Kenya '),
(86, '', 'Kamboja '),
(87, '', 'Azerbaijan '),
(88, '', 'Turkmenistan '),
(89, '', 'Kamerun '),
(90, '', 'El Salvador '),
(91, '', 'Luxembourg '),
(92, '', 'Uruguay '),
(93, '', 'Afghanistan '),
(94, '', 'Latvia '),
(95, '', 'Bosnia-Herzegovina '),
(96, '', 'Pantai Gading '),
(97, '', 'Paraguay '),
(98, '', 'Zimbabwe '),
(99, '', 'Yordania '),
(100, '', 'Tanzania '),
(101, '', 'Mozambik '),
(102, '', 'Bolivia '),
(103, '', 'Qatar '),
(104, '', 'Panama '),
(105, '', 'Botswana '),
(106, '', 'Guinea Khatulistiwa '),
(107, '', 'Senegal '),
(108, '', 'Guinea '),
(109, '', 'Estonia '),
(110, '', 'Honduras '),
(111, '', 'Nikaragua '),
(112, '', 'Siprus '),
(113, '', 'Lebanon '),
(114, '', 'Trinidad dan Tobago '),
(115, '', 'Yaman '),
(116, '', 'Burkina Faso '),
(117, '', 'Madagaskar '),
(118, '', 'Albania '),
(119, '', 'Namibia '),
(120, '', 'Bahrain '),
(121, '', 'Chad '),
(122, '', 'Mauritius '),
(123, '', 'Mali '),
(124, '', 'Papua Nugini '),
(125, '', 'Armenia '),
(126, '', 'Haiti '),
(127, '', 'Republik Makedonia '),
(128, '', 'Georgia '),
(129, '', 'Laos '),
(130, '', 'Rwanda '),
(131, '', 'Zambia '),
(132, '', 'Nigeria '),
(133, '', 'Islandia '),
(134, '', 'Jamaika '),
(135, '', 'Kyrgyzstan '),
(136, '', 'Benin '),
(137, '', 'Gabon '),
(138, '', 'Togo '),
(139, '', 'Moldova '),
(140, '', 'Brunei '),
(141, '', 'Tajikistan '),
(142, '', 'Malawi '),
(143, '', 'Malta '),
(144, '', 'Bahama '),
(145, '', 'Mauritania '),
(146, '', 'Swaziland '),
(147, '', 'Mongolia '),
(148, '', 'Lesotho '),
(149, '', 'Fiji '),
(150, '', 'Barbados '),
(151, '', 'Burundi '),
(152, '', 'Republik Afrika Tengah '),
(153, '', 'Republik Kongo '),
(154, '', 'Eritrea '),
(155, '', 'Sierra Leone '),
(156, '', 'Guyana '),
(157, '', 'Cape Verde '),
(158, '', 'Liberia '),
(159, '', 'Gambia '),
(160, '', 'Bhutan '),
(161, '', 'Suriname '),
(162, '', 'Maldives '),
(163, '', 'Belize '),
(164, '', 'Djibouti '),
(165, '', 'Timor Timur '),
(166, '', 'Seychelles '),
(167, '', 'Komoro '),
(168, '', 'Guinea-Bissau '),
(169, '', 'Samoa '),
(170, '', 'Saint Lucia '),
(171, '', 'Antigua and Barbuda '),
(172, '', 'Solomon Islands '),
(173, '', 'Grenada '),
(174, '', 'St. Vincent and the Grenadines'),
(175, '', 'Tonga '),
(176, '', 'Vanuatu '),
(177, '', 'Saint Kitts and Nevis '),
(178, '', 'Dominica '),
(179, '', 'Sudan'),
(180, '', 'Kiribati '),
(999, '', 'Lain-Lain');

-- --------------------------------------------------------

--
-- Table structure for table `non_nasabah_dn`
--

CREATE TABLE IF NOT EXISTS `non_nasabah_dn` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kodeRahasia` varchar(50) DEFAULT NULL,
  `noRekening` varchar(50) NOT NULL,
  `namaLengkap` varchar(255) NOT NULL,
  `tglLahir` date DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `noTelp` varchar(30) DEFAULT NULL,
  `idPropinsi` int(11) NOT NULL,
  `propinsiLain` varchar(50) DEFAULT NULL,
  `idKabKota` int(11) NOT NULL,
  `kabKotaLain` varchar(50) DEFAULT NULL,
  `ktp` varchar(30) DEFAULT NULL,
  `sim` varchar(30) DEFAULT NULL,
  `passport` varchar(30) DEFAULT NULL,
  `kimsKitasKitap` varchar(30) DEFAULT NULL,
  `npwp` varchar(30) DEFAULT NULL,
  `jenisBuktiLain` varchar(30) DEFAULT NULL,
  `noBuktiLain` varchar(30) DEFAULT NULL,
  `keterlibatanBeneficialOwner` int(1) DEFAULT NULL,
  `hubDgnPemilikDana` varchar(50) DEFAULT NULL,
  `nilaiTransaksiDalamRupiah` double DEFAULT NULL,
  `swift_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_non_nasabah_dn_propinsi1_idx` (`idPropinsi`),
  KEY `fk_non_nasabah_dn_kabupaten1_idx` (`idKabKota`),
  KEY `fk_non_nasabah_dn_swift1_idx` (`swift_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `non_nasabah_ln`
--

CREATE TABLE IF NOT EXISTS `non_nasabah_ln` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kodeRahasia` varchar(50) DEFAULT NULL,
  `noRekening` varchar(50) NOT NULL,
  `namaLengkap` varchar(255) NOT NULL,
  `tglLahir` date DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `noTelp` varchar(30) DEFAULT NULL,
  `negaraBagianKota` varchar(30) NOT NULL,
  `idNegara` int(11) NOT NULL,
  `negaraLain` varchar(50) DEFAULT NULL,
  `ktp` varchar(30) DEFAULT NULL,
  `sim` varchar(30) DEFAULT NULL,
  `passport` varchar(30) DEFAULT NULL,
  `kimsKitasKitap` varchar(30) DEFAULT NULL,
  `npwp` varchar(30) DEFAULT NULL,
  `jenisBuktiLain` varchar(30) DEFAULT NULL,
  `noBuktiLain` varchar(30) DEFAULT NULL,
  `nilaiTransaksiDalamRupiah` double DEFAULT NULL,
  `swift_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_non_nasabah_ln_negara1_idx` (`idNegara`),
  KEY `fk_non_nasabah_ln_swift1_idx` (`swift_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE IF NOT EXISTS `permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`id`, `name`, `description`) VALUES
(1, 'system.root', 'User with this permission will be granted to all access. Use with precautions.'),
(2, 'setting.manage', NULL),
(19, 'admin.view', NULL),
(20, 'admin.create', NULL),
(21, 'admin.update', NULL),
(22, 'admin.delete', NULL),
(23, 'admin.group.view', NULL),
(24, 'admin.group.create', NULL),
(25, 'admin.group.update', NULL),
(26, 'admin.group.delete', NULL),
(27, 'admin.permission.view', NULL),
(28, 'admin.permission.update', NULL),
(39, 'negara.view', NULL),
(40, 'negara.update', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `propinsi`
--

CREATE TABLE IF NOT EXISTS `propinsi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `negara_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_provinsi_negara1` (`negara_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=97 ;

--
-- Dumping data for table `propinsi`
--

INSERT INTO `propinsi` (`id`, `nama`, `negara_id`) VALUES
(11, 'Nanggroe Aceh Darussalam', 62),
(12, 'Sumatera Utara', 62),
(13, 'Sumatera Barat', 62),
(14, 'Riau', 62),
(15, 'Jambi', 62),
(16, 'Sumatera Selatan', 62),
(17, 'Bengkulu', 62),
(18, 'Lampung', 62),
(19, 'Bangka Belitung', 62),
(21, 'Kepulauan Riau', 62),
(31, 'DKI Jakarta', 62),
(32, 'Jawa Barat', 62),
(33, 'Jawa Tengah', 62),
(34, 'D.I. Yogyakarta', 62),
(35, 'Jawa Timur', 62),
(36, 'Banten', 62),
(51, 'Bali', 62),
(52, 'Nusa Tenggara Barat', 62),
(53, 'Nusa Tenggara Timur', 62),
(61, 'Kalimantan Barat', 62),
(62, 'Kalimantan Tengah', 62),
(63, 'Kalimantan Selatan', 62),
(64, 'Kalimantan Timur', 62),
(71, 'Sulawesi Utara', 62),
(72, 'Sulawesi Tengah', 62),
(73, 'Sulawesi Selatan', 62),
(74, 'Sulawesi Tenggara', 62),
(75, 'Gorontalo', 62),
(81, 'Maluku', 62),
(82, 'Maluku Utara', 62),
(94, 'Papua', 62),
(96, 'Lain-lain', 999);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE IF NOT EXISTS `setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `value` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `name`, `value`) VALUES
(1, 'list_size', '30'),
(2, 'teaser_length', '200'),
(3, 'title_filter', 'strong,em'),
(4, 'teaser_filter', 'a[href],strong,em,span[class]'),
(5, 'body_filter', 'p,a[href],strong,em,img[src],ul,ol,li,div[class],span[class],h1,h2,h3,h4,h5,h6'),
(6, 'site_name', 'ANZ'),
(7, 'site_theme', 'yoohee'),
(8, 'site_logo', NULL),
(9, 'site_description', 'YooHee! CMS Description'),
(10, 'site_keywords', 'yoohee, cms, content management system, yii'),
(11, 'site_slogan', 'User friendly CMS powered by Yii'),
(12, 'salt', 'Wirasmono27Tunggul08Manik1978Adi'),
(13, 'moderate_comment', '1'),
(14, 'default_sort', 'id ASC'),
(15, 'assets_path', 'assets'),
(16, 'imagecache_path', 'imagecache'),
(17, 'allow_multiple', '0'),
(18, 'allow_tree', '0'),
(19, 'has_event', '0'),
(20, 'has_comment', '0'),
(21, 'comment_filter', 'p,a[href],strong,em,img[src],ul,ol,li,div[class],span[class],h1,h2,h3,h4,h5,h6');

-- --------------------------------------------------------

--
-- Table structure for table `swift`
--

CREATE TABLE IF NOT EXISTS `swift` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `localId` varchar(50) NOT NULL,
  `noLtdln` varchar(30) NOT NULL,
  `noLtdlnKoreksi` varchar(30) DEFAULT NULL,
  `tglLaporan` date NOT NULL,
  `namaPjk` varchar(100) NOT NULL,
  `namaPejabatPjk` varchar(100) NOT NULL,
  `jenisLaporan` tinyint(4) NOT NULL,
  `pjkBankSebagai` tinyint(4) NOT NULL,
  `jenisSwift` tinyint(4) NOT NULL,
  `status` int(1) NOT NULL,
  `keterlibatanBeneficialOwner` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `noLtdln` (`noLtdln`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=155 ;

--
-- Dumping data for table `swift`
--

INSERT INTO `swift` (`id`, `localId`, `noLtdln`, `noLtdlnKoreksi`, `tglLaporan`, `namaPjk`, `namaPejabatPjk`, `jenisLaporan`, `pjkBankSebagai`, `jenisSwift`, `status`, `keterlibatanBeneficialOwner`) VALUES
(142, '1', 'swin/790zu', 'swin/790zu', '2013-11-13', 'Bank Mandiri aja', 'Ibu Dian', 1, 2, 1, 0, NULL),
(144, '3', 'swin/fi88j', NULL, '2013-11-21', 'bank anz', 'Ibu Dian', 1, 1, 1, 0, NULL),
(145, '15678', 'swin/p5v0l', NULL, '2013-11-20', 'Bank Mandiri', 'Widodo Pangestu', 1, 1, 1, 0, NULL),
(146, '98789', 'swin/eus', 'swin/eus', '2013-11-15', 'ada deh', 'test', 1, 1, 2, 0, NULL),
(147, '09i080``', 'swin/6b2rx', 'swin/6b2rx', '1914-07-17', 'widarto', 'pangestu', 1, 1, 1, 0, NULL),
(148, '09i080``', 'swin/jm1o3', 'swin/jm1o3', '1970-01-01', 'widarto', 'pangestu', 1, 1, 1, 0, NULL),
(149, '5678', 'swin/g9m2m', '', '2013-11-14', 'widarto pa', 'test adf', 1, 2, 1, 0, NULL),
(150, '5678', 'swin/jmi12', '', '2013-11-14', 'widarto pa', 'test adf', 1, 2, 1, 0, NULL),
(151, '5678', 'swin/kxg49', '', '2013-11-14', 'widarto pa', 'test adf', 1, 2, 1, 0, NULL),
(152, 'test', 'swin/ngv3k', '', '1970-01-01', 'asd', 'asdad', 1, 2, 1, 0, NULL),
(153, 'test', 'swin/eusts', 'swin/eusts', '2029-02-01', 'asd', 'asdad', 1, 1, 1, 0, NULL),
(154, 'ADA123', 'swin/rurnv', 'swin/rurnv', '2013-11-20', 'Widarto', 'Pangestu', 1, 2, 1, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE IF NOT EXISTS `transaksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tglTransaksi` date NOT NULL,
  `timeIndication` timestamp NULL DEFAULT NULL,
  `sendersReference` varchar(10) NOT NULL,
  `relatedReference` varchar(20) DEFAULT NULL,
  `bankOperationCode` varchar(30) NOT NULL,
  `instructionCode` varchar(50) DEFAULT NULL,
  `kanCabPenyelenggaraPengirimAsal` varchar(50) DEFAULT NULL,
  `typeTransactionCode` varchar(50) DEFAULT NULL,
  `valueDate` date NOT NULL,
  `amount` double NOT NULL,
  `idCurrency` int(11) NOT NULL,
  `amountDalamRupiah` double NOT NULL,
  `idCurrencyInstructedAmount` int(11) DEFAULT NULL,
  `instructedAmount` double DEFAULT NULL,
  `exchangeRate` double DEFAULT NULL,
  `sendingInstitution` varchar(50) DEFAULT NULL,
  `beneficiaryInstitution` varchar(140) DEFAULT NULL,
  `tujuanTransaksi` varchar(100) DEFAULT NULL,
  `sumberDana` varchar(100) DEFAULT NULL,
  `swift_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_transaksi_swift1` (`swift_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `tglTransaksi`, `timeIndication`, `sendersReference`, `relatedReference`, `bankOperationCode`, `instructionCode`, `kanCabPenyelenggaraPengirimAsal`, `typeTransactionCode`, `valueDate`, `amount`, `idCurrency`, `amountDalamRupiah`, `idCurrencyInstructedAmount`, `instructedAmount`, `exchangeRate`, `sendingInstitution`, `beneficiaryInstitution`, `tujuanTransaksi`, `sumberDana`, `swift_id`) VALUES
(1, '2013-11-18', '0000-00-00 00:00:00', 'ad', '', 'asdad', '', '', '', '2013-11-01', 123, 16, 3453, 16, NULL, NULL, '', '', '', '', 153),
(2, '2013-11-19', '0000-00-00 00:00:00', 'asbdjfh', '', 'nn', '', '', '', '2013-11-13', 445465677, 18, 646687658675, 19, NULL, NULL, '', '', '', '', 146);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `fk_admin_group1` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `admin_permission`
--
ALTER TABLE `admin_permission`
  ADD CONSTRAINT `fk_table1_admin1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_table1_permission2` FOREIGN KEY (`permission_id`) REFERENCES `permission` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `content`
--
ALTER TABLE `content`
  ADD CONSTRAINT `fk_content_content_type` FOREIGN KEY (`content_type_id`) REFERENCES `content_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `group_permission`
--
ALTER TABLE `group_permission`
  ADD CONSTRAINT `fk_table1_group1` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_table1_permission1` FOREIGN KEY (`permission_id`) REFERENCES `permission` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `infolain`
--
ALTER TABLE `infolain`
  ADD CONSTRAINT `fk_infoLain_swift1` FOREIGN KEY (`swift_id`) REFERENCES `swift` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `kabupaten`
--
ALTER TABLE `kabupaten`
  ADD CONSTRAINT `fk_kabupaten_propinsi1` FOREIGN KEY (`propinsi_id`) REFERENCES `propinsi` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `nasabah_korporasi_dn`
--
ALTER TABLE `nasabah_korporasi_dn`
  ADD CONSTRAINT `fk_nasabah_korporasi_dn_propinsi1` FOREIGN KEY (`idPropinsi`) REFERENCES `propinsi` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_nasabah_korporasi_dn_kabupaten1` FOREIGN KEY (`idKabKota`) REFERENCES `kabupaten` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_nasabah_korporasi_dn_swift1` FOREIGN KEY (`swift_id`) REFERENCES `swift` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `nasabah_korporasi_ln`
--
ALTER TABLE `nasabah_korporasi_ln`
  ADD CONSTRAINT `fk_nasabah_korporasi_ln_negara1` FOREIGN KEY (`idNegara`) REFERENCES `negara` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_nasabah_korporasi_ln_swift1` FOREIGN KEY (`swift_id`) REFERENCES `swift` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `nasabah_perorangan_dn`
--
ALTER TABLE `nasabah_perorangan_dn`
  ADD CONSTRAINT `fk_nasabah_perorangan_dn_kabupaten1` FOREIGN KEY (`idKabKotaDomisili`) REFERENCES `kabupaten` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_nasabah_perorangan_dn_kabupaten2` FOREIGN KEY (`idKabKotaIdentitas`) REFERENCES `kabupaten` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_nasabah_perorangan_dn_negara10` FOREIGN KEY (`idNegaraKewarganegaraan`) REFERENCES `negara` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_nasabah_perorangan_dn_propinsi1` FOREIGN KEY (`idPropinsiDomisili`) REFERENCES `propinsi` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_nasabah_perorangan_dn_propinsi2` FOREIGN KEY (`idPropinsiIdentitas`) REFERENCES `propinsi` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_nasabah_perorangan_dn_swift1` FOREIGN KEY (`swift_id`) REFERENCES `swift` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `nasabah_perorangan_ln`
--
ALTER TABLE `nasabah_perorangan_ln`
  ADD CONSTRAINT `fk_nasabah_perorangan_ln_negara1` FOREIGN KEY (`idNegaraKewarganegaraan`) REFERENCES `negara` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_nasabah_perorangan_ln_negara2` FOREIGN KEY (`idNegaraVoucher`) REFERENCES `negara` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_nasabah_perorangan_ln_swift1` FOREIGN KEY (`swift_id`) REFERENCES `swift` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `non_nasabah_dn`
--
ALTER TABLE `non_nasabah_dn`
  ADD CONSTRAINT `fk_non_nasabah_dn_propinsi1` FOREIGN KEY (`idPropinsi`) REFERENCES `propinsi` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_non_nasabah_dn_kabupaten1` FOREIGN KEY (`idKabKota`) REFERENCES `kabupaten` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_non_nasabah_dn_swift1` FOREIGN KEY (`swift_id`) REFERENCES `swift` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `non_nasabah_ln`
--
ALTER TABLE `non_nasabah_ln`
  ADD CONSTRAINT `fk_non_nasabah_ln_negara1` FOREIGN KEY (`idNegara`) REFERENCES `negara` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_non_nasabah_ln_swift1` FOREIGN KEY (`swift_id`) REFERENCES `swift` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `propinsi`
--
ALTER TABLE `propinsi`
  ADD CONSTRAINT `fk_provinsi_negara1` FOREIGN KEY (`negara_id`) REFERENCES `negara` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `fk_transaksi_swift1` FOREIGN KEY (`swift_id`) REFERENCES `swift` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

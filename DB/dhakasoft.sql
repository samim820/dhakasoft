-- phpMyAdmin SQL Dump
-- version 5.2.3deb1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 06, 2026 at 08:55 PM
-- Server version: 8.4.11-0ubuntu0.26.04.1
-- PHP Version: 8.5.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dhakasoft`
--

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sec` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cycle`
--

CREATE TABLE `cycle` (
  `id` int NOT NULL,
  `name` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cycle` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sec` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(10) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `distric`
--

CREATE TABLE `distric` (
  `id` int NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `sec` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hotspots`
--

CREATE TABLE `hotspots` (
  `id` bigint NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mac` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `geocode` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `owner` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email_owner` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `manager` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email_manager` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `company` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone1` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone2` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `type` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `companywebsite` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `companyemail` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `companycontact` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `companyphone` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `creationdate` datetime DEFAULT '0000-00-00 00:00:00',
  `creationby` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `updatedate` datetime DEFAULT '0000-00-00 00:00:00',
  `updateby` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `importuser`
--

CREATE TABLE `importuser` (
  `id` int NOT NULL,
  `custid` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `gender` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `mobilephone` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `city` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `zip` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `portalloginpassword` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `creationdate` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  `package` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `amount` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `expire` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `cycle` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `area` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `sec` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nas_old_backup`
--

CREATE TABLE `nas_old_backup` (
  `id` int NOT NULL,
  `nasname` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `shortname` varchar(32) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `type` varchar(30) COLLATE utf8mb4_general_ci DEFAULT 'other',
  `ports` int DEFAULT NULL,
  `secret` varchar(60) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'secret',
  `server` varchar(64) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `community` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` varchar(200) COLLATE utf8mb4_general_ci DEFAULT 'RADIUS Client',
  `api` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `username` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sec` varchar(200) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'main'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `operators`
--

CREATE TABLE `operators` (
  `id` int NOT NULL,
  `username` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `firstname` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `lastname` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `title` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `role` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `company` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `phone1` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `phone2` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `email1` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `email2` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `messenger1` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `messenger2` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `notes` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `lastlogin` datetime DEFAULT '0000-00-00 00:00:00',
  `creationdate` datetime DEFAULT '0000-00-00 00:00:00',
  `creationby` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `updatedate` datetime DEFAULT '0000-00-00 00:00:00',
  `updateby` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sec` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `operators_acl`
--

CREATE TABLE `operators_acl` (
  `id` int NOT NULL,
  `operator_id` int NOT NULL,
  `file` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `access` tinyint NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `operators_acl_files`
--

CREATE TABLE `operators_acl_files` (
  `id` int NOT NULL,
  `file` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `category` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `section` varchar(128) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `profile` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `rate_limit` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mbill` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `resrat` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `vat` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `packageid` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sec` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `reseller_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `vat_percent` decimal(5,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int NOT NULL,
  `invoice_id` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `custid` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `username` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `receve_amount` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `discount_ammount` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `total_amount` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `reciveby` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `receipt` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `type` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `notes` mediumtext COLLATE utf8mb4_general_ci,
  `remarks` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `creationdate` datetime DEFAULT NULL,
  `creationby` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `datee` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `updatedate` datetime DEFAULT '0000-00-00 00:00:00',
  `updateby` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sec` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_type`
--

CREATE TABLE `payment_type` (
  `id` int NOT NULL,
  `value` varchar(32) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT 'type value',
  `notes` varchar(128) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'general notes/description',
  `creationdate` datetime DEFAULT '0000-00-00 00:00:00',
  `creationby` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `updatedate` datetime DEFAULT '0000-00-00 00:00:00',
  `updateby` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pop`
--

CREATE TABLE `pop` (
  `id` int NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `mikrotik` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `sec` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `router_id` int UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ppp_active`
--

CREATE TABLE `ppp_active` (
  `userid` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `pass` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ip` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `profile` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mac` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `userstatus` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `uptime` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `logout` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sec` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `sts` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ppp_secret`
--

CREATE TABLE `ppp_secret` (
  `userid` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `pass` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `profile` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `userstatus` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `logout` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sec` varchar(200) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ppp_sessions`
--

CREATE TABLE `ppp_sessions` (
  `id` bigint UNSIGNED NOT NULL,
  `router_id` int UNSIGNED NOT NULL,
  `username` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `ip` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `caller_id` varchar(64) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `started_at` datetime NOT NULL,
  `last_seen` datetime NOT NULL,
  `ended_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int NOT NULL,
  `sec` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `balance` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `startid` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `endid` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sms` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `expire_time` varchar(100) COLLATE utf8mb4_general_ci DEFAULT '12:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `routers`
--

CREATE TABLE `routers` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `ip` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `api_port` smallint UNSIGNED NOT NULL DEFAULT '8728',
  `use_ssl` tinyint(1) NOT NULL DEFAULT '0',
  `username` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password_enc` varchar(512) COLLATE utf8mb4_general_ci NOT NULL,
  `sec` varchar(100) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'main',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `last_seen` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sms`
--

CREATE TABLE `sms` (
  `id` int NOT NULL,
  `custid` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `mobile` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `msg` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `count` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `cost` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `sec` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `datetimee` varchar(200) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sms_gtw`
--

CREATE TABLE `sms_gtw` (
  `id` int NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `api` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `sender_id` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `url` varchar(300) COLLATE utf8mb4_general_ci NOT NULL,
  `sec` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sms_temp`
--

CREATE TABLE `sms_temp` (
  `id` int NOT NULL,
  `status` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `msg` mediumtext COLLATE utf8mb4_general_ci NOT NULL,
  `msg_sec` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `sec` varchar(20) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sync_jobs`
--

CREATE TABLE `sync_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `customer_id` int UNSIGNED NOT NULL,
  `kick` tinyint(1) NOT NULL DEFAULT '0',
  `status` enum('pending','done','failed') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pending',
  `attempts` int NOT NULL DEFAULT '0',
  `last_error` varchar(500) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `systemevents`
--

CREATE TABLE `systemevents` (
  `id` int NOT NULL,
  `Message` mediumtext COLLATE utf8mb4_general_ci NOT NULL,
  `FromHost` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `Priority` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `DeviceReportedTime` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `ReceivedAt` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `InfoUnitID` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `SysLogTag` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `Facility` varchar(10) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `thana`
--

CREATE TABLE `thana` (
  `id` int NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `sec` varchar(200) COLLATE utf8mb4_general_ci DEFAULT 'main'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userbillinfo`
--

CREATE TABLE `userbillinfo` (
  `id` int UNSIGNED NOT NULL,
  `username` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `planName` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `hotspot_id` int DEFAULT NULL,
  `hotspotlocation` varchar(32) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contactperson` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `company` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `city` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `state` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `country` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `zip` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `paymentmethod` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cash` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `creditcardname` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `creditcardnumber` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `creditcardverification` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `creditcardtype` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `creditcardexp` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `notes` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `changeuserbillinfo` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lead` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `coupon` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ordertaker` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `billstatus` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lastbill` date NOT NULL DEFAULT '0000-00-00',
  `nextbill` date NOT NULL DEFAULT '0000-00-00',
  `nextinvoicedue` int DEFAULT NULL,
  `billdue` int DEFAULT NULL,
  `postalinvoice` varchar(8) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `faxinvoice` varchar(8) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `emailinvoice` varchar(8) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `batch_id` int DEFAULT NULL,
  `creationdate` datetime DEFAULT '0000-00-00 00:00:00',
  `creationby` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `updatedate` datetime DEFAULT '0000-00-00 00:00:00',
  `updateby` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `id` int UNSIGNED NOT NULL,
  `custid` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `username` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `firstname` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gender` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `workphone` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `homephone` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mobilephone` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `city` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `zip` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `notes` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `changeuserinfo` varchar(128) COLLATE utf8mb4_general_ci DEFAULT '0',
  `portalloginpassword` varchar(128) COLLATE utf8mb4_general_ci DEFAULT '',
  `enableportallogin` int DEFAULT '0',
  `creationdate` datetime DEFAULT CURRENT_TIMESTAMP,
  `creationby` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `updatedate` datetime DEFAULT NULL,
  `updateby` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `package` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `amount` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `expire` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `discount` varchar(10) COLLATE utf8mb4_general_ci DEFAULT '0',
  `ip` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mac` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `balance` varchar(10) COLLATE utf8mb4_general_ci DEFAULT '0',
  `cycle` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `zone` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `area` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `house` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `road` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `onumac` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sec` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `userstatus` varchar(100) COLLATE utf8mb4_general_ci DEFAULT '1',
  `billstatus` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `package_id` int DEFAULT NULL,
  `router_id` int UNSIGNED DEFAULT NULL,
  `pppoe_password` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `expire_at` datetime DEFAULT NULL,
  `synced_disabled` tinyint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cycle`
--
ALTER TABLE `cycle`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `distric`
--
ALTER TABLE `distric`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `importuser`
--
ALTER TABLE `importuser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nas_old_backup`
--
ALTER TABLE `nas_old_backup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `operators`
--
ALTER TABLE `operators`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_package_sec` (`sec`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_type`
--
ALTER TABLE `payment_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ppp_sessions`
--
ALTER TABLE `ppp_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_sess_open` (`router_id`,`ended_at`,`username`),
  ADD KEY `idx_sess_user` (`username`,`started_at`),
  ADD KEY `idx_sess_start` (`started_at`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `routers`
--
ALTER TABLE `routers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_router_ip` (`ip`,`api_port`),
  ADD KEY `idx_router_sec` (`sec`);

--
-- Indexes for table `sms`
--
ALTER TABLE `sms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_gtw`
--
ALTER TABLE `sms_gtw`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_temp`
--
ALTER TABLE `sms_temp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sync_jobs`
--
ALTER TABLE `sync_jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_job_status` (`status`,`id`),
  ADD KEY `idx_job_customer` (`customer_id`,`status`);

--
-- Indexes for table `systemevents`
--
ALTER TABLE `systemevents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userbillinfo`
--
ALTER TABLE `userbillinfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_ui_username` (`username`),
  ADD KEY `idx_ui_custid` (`custid`),
  ADD KEY `idx_ui_router` (`router_id`),
  ADD KEY `idx_ui_package` (`package_id`),
  ADD KEY `idx_ui_sec` (`sec`),
  ADD KEY `idx_ui_expire` (`expire_at`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cycle`
--
ALTER TABLE `cycle`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `distric`
--
ALTER TABLE `distric`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `importuser`
--
ALTER TABLE `importuser`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nas_old_backup`
--
ALTER TABLE `nas_old_backup`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `operators`
--
ALTER TABLE `operators`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_type`
--
ALTER TABLE `payment_type`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ppp_sessions`
--
ALTER TABLE `ppp_sessions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `routers`
--
ALTER TABLE `routers`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sms`
--
ALTER TABLE `sms`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sms_gtw`
--
ALTER TABLE `sms_gtw`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sms_temp`
--
ALTER TABLE `sms_temp`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sync_jobs`
--
ALTER TABLE `sync_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `systemevents`
--
ALTER TABLE `systemevents`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userbillinfo`
--
ALTER TABLE `userbillinfo`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

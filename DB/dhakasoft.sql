-- phpMyAdmin SQL Dump
-- version 5.2.3deb1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 06, 2026 at 08:35 PM
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
-- Table structure for table `nas`
--

CREATE TABLE `nas` (
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
  `mbill` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `resrat` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `vat` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `packageid` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sec` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `sec` varchar(20) COLLATE utf8mb4_general_ci NOT NULL
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
-- Table structure for table `radacct`
--

CREATE TABLE `radacct` (
  `radacctid` bigint NOT NULL,
  `acctsessionid` varchar(64) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `acctupdatetime` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `acctuniqueid` varchar(32) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `username` varchar(64) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `groupname` varchar(64) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `realm` varchar(64) COLLATE utf8mb4_general_ci DEFAULT '',
  `nasipaddress` varchar(15) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `nasportid` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nasporttype` varchar(32) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `acctstarttime` datetime DEFAULT NULL,
  `acctstoptime` datetime DEFAULT NULL,
  `acctsessiontime` int DEFAULT NULL,
  `acctauthentic` varchar(32) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `connectinfo_start` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `connectinfo_stop` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `acctinputoctets` bigint DEFAULT NULL,
  `acctoutputoctets` bigint DEFAULT NULL,
  `calledstationid` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `callingstationid` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `acctterminatecause` varchar(32) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `servicetype` varchar(32) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `framedprotocol` varchar(32) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `framedipaddress` varchar(15) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `acctstartdelay` int DEFAULT NULL,
  `acctstopdelay` int DEFAULT NULL,
  `xascendsessionsvrkey` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `framedipv6address` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `framedipv6prefix` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `framedinterfaceid` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `delegatedipv6prefix` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `acctinterval` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `radcheck`
--

CREATE TABLE `radcheck` (
  `id` int UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `attribute` varchar(64) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `op` char(2) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '==',
  `value` varchar(253) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `sec` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `radgroupcheck`
--

CREATE TABLE `radgroupcheck` (
  `id` int UNSIGNED NOT NULL,
  `groupname` varchar(64) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `attribute` varchar(64) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `op` char(2) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '==',
  `value` varchar(253) COLLATE utf8mb4_general_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `radgroupreply`
--

CREATE TABLE `radgroupreply` (
  `id` int UNSIGNED NOT NULL,
  `groupname` varchar(64) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `attribute` varchar(64) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `op` char(2) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '=',
  `value` varchar(253) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `packageid` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `radhuntgroup`
--

CREATE TABLE `radhuntgroup` (
  `id` int UNSIGNED NOT NULL,
  `groupname` varchar(64) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `nasipaddress` varchar(15) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `nasportid` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `radippool`
--

CREATE TABLE `radippool` (
  `id` int UNSIGNED NOT NULL,
  `pool_name` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `framedipaddress` varchar(15) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `nasipaddress` varchar(15) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `calledstationid` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `callingstationid` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `expiry_time` datetime DEFAULT NULL,
  `username` varchar(64) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `pool_key` varchar(30) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `radpostauth`
--

CREATE TABLE `radpostauth` (
  `id` int NOT NULL,
  `username` varchar(64) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `nasport` varchar(500) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nasname` varchar(500) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mac` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pass` varchar(64) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `reply` varchar(32) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `error` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `authdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `radreply`
--

CREATE TABLE `radreply` (
  `id` int UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `attribute` varchar(64) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `op` char(2) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '=',
  `value` varchar(253) COLLATE utf8mb4_general_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `radusergroup`
--

CREATE TABLE `radusergroup` (
  `id` int NOT NULL,
  `username` varchar(64) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `groupname` varchar(64) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `priority` int NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `realms`
--

CREATE TABLE `realms` (
  `id` bigint NOT NULL,
  `realmname` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `type` varchar(32) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `authhost` varchar(256) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `accthost` varchar(256) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `secret` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ldflag` varchar(64) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nostrip` int DEFAULT NULL,
  `hints` int DEFAULT NULL,
  `notrealm` int DEFAULT NULL,
  `creationdate` datetime DEFAULT NULL,
  `creationby` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `updatedate` datetime DEFAULT NULL,
  `updateby` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `billstatus` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Indexes for table `nas`
--
ALTER TABLE `nas`
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
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `radacct`
--
ALTER TABLE `radacct`
  ADD PRIMARY KEY (`radacctid`);

--
-- Indexes for table `radcheck`
--
ALTER TABLE `radcheck`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `radgroupcheck`
--
ALTER TABLE `radgroupcheck`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `radgroupreply`
--
ALTER TABLE `radgroupreply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `radpostauth`
--
ALTER TABLE `radpostauth`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `radreply`
--
ALTER TABLE `radreply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `radusergroup`
--
ALTER TABLE `radusergroup`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `nas`
--
ALTER TABLE `nas`
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
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `radacct`
--
ALTER TABLE `radacct`
  MODIFY `radacctid` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `radcheck`
--
ALTER TABLE `radcheck`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `radgroupcheck`
--
ALTER TABLE `radgroupcheck`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `radgroupreply`
--
ALTER TABLE `radgroupreply`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `radpostauth`
--
ALTER TABLE `radpostauth`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `radreply`
--
ALTER TABLE `radreply`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `radusergroup`
--
ALTER TABLE `radusergroup`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

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

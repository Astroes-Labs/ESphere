-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2024 at 03:13 PM
-- Server version: 10.6.17-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rainbow`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(20) NOT NULL,
  `username` varchar(220) NOT NULL,
  `fullname` varchar(220) NOT NULL,
  `email` varchar(220) NOT NULL,
  `gender` varchar(240) NOT NULL,
  `phone` varchar(220) NOT NULL,
  `country` varchar(220) NOT NULL,
  `password` varchar(220) NOT NULL,
  `referral` varchar(220) NOT NULL,
  `rank` varchar(250) NOT NULL,
  `balance` varchar(250) NOT NULL DEFAULT '0',
  `profit` varchar(240) NOT NULL DEFAULT '0',
  `image_id` varchar(240) NOT NULL DEFAULT 'null',
  `city` varchar(240) NOT NULL,
  `zip` varchar(240) NOT NULL,
  `address` varchar(240) NOT NULL,
  `dob` varchar(240) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_modified` varchar(240) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `username`, `fullname`, `email`, `gender`, `phone`, `country`, `password`, `referral`, `rank`, `balance`, `profit`, `image_id`, `city`, `zip`, `address`, `dob`, `date_created`, `date_modified`) VALUES
(1, 'jdj', 'hjhjdj', 'jjj@jhjhsj.sjbjbj', '', '8654568656', 'ghgghgjgj', 'jbjbjbjb', 'jbjjbjbc', '', '0', '0', 'null', '', '', '', '', '2024-07-22 11:36:59', '2024-07-22 16:13:23'),
(2, 'rainow@gmail.com', 'rainow@gmail.com', 'rainow@gmail.com', '', '11111111111111111111111', 'Antigua & Barbuda', '784fbd5f4f5297739ddb5fcccb319d00', 'rainow@gmail.com', '', '', '0', 'null', '', '', '', '', '2024-07-22 11:36:59', '2024-07-22 16:13:23'),
(3, 'new', 'new new', 'new@gmail.com', '', '11111111111', 'Albania', '0119687eae34daac89e89c8ebbe82d60', 'new@gmail.com', '', '', '0', 'null', '', '', '', '', '2024-07-22 11:36:59', '2024-07-22 16:13:23'),
(4, 'newu', 'new new', 'new@gmail.comm', '', '11111111111', 'Albania', '0119687eae34daac89e89c8ebbe82d60', 'new@gmail.com', '', '', '0', 'null', '', '', '', '', '2024-07-22 11:36:59', '2024-07-22 16:13:23'),
(5, 'rain@gmail.com', 'rain@gmail.com', 'rain@gmail.com', '', '111111111111', 'Barbados', 'aea689390a6fc6cd9c45b3195fce151d', '8', '', '', '0', 'null', '', '', '', '', '2024-07-22 11:36:59', '2024-07-22 16:13:23'),
(6, 'rain', 'rain two', 'rain2@gmailc.com', '', '111111111111', 'Barbados', 'aea689390a6fc6cd9c45b3195fce151d', '8', '', '', '0', 'null', '', '', '', '', '2024-07-22 11:36:59', '2024-07-22 16:13:23'),
(7, 'new3', 'new3 new3 ', 'new3@gmail.com', '', '1111111111111111111', 'Anguilla', 'f8c79d9655118dd15b8c80ea1b23d9ce', 'new3@gmail.com', '', '', '0', 'null', '', '', '', '', '2024-07-22 11:36:59', '2024-07-22 16:13:23'),
(8, 'newtest', 'newtestjkn gdhd', 'newtest@gmail.com', 'female', '111112222238', 'Azerbaijan', 'ed2b1f468c5f915f3f1cf75d7068baae', '2', '', '12903.03', '1798.75', '29', '', '', '', '', '2024-07-22 11:36:59', '2024-07-22 18:36:59'),
(9, 'sunsun', 'sun@gmail.com', 'sun@gmail.com', '', '111111111111', 'Barbados', 'aea689390a6fc6cd9c45b3195fce151d', '8', '', '20', '0', 'null', '', '', '', '', '2024-07-22 11:36:59', '2024-07-22 16:13:23'),
(10, 'cloud@gmail.com', 'Cloud Last Name', 'cloud@gmail.com', '', '12345123456', 'Belgium', '680a4de4d8ccda90c3d8093c32cc6e53', '8', '', '1156', '0', 'null', '', '', '', '', '2024-07-22 11:36:59', '2024-07-22 16:13:23'),
(11, 'trees@gmail.com', 'trees@gmail.com', 'trees@gmail.com', '', '12345654321', 'American Samoa', '2a4bdf81d62e2b69d84e0cab63e7436a', '8', '', '20', '0', 'null', '', '', '', '', '2024-07-22 11:36:59', '2024-07-22 16:13:23');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(20) NOT NULL,
  `url` varchar(240) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `url`) VALUES
(1, '6693b84ed9f02.png'),
(2, '6693b9ac198c5.png'),
(3, '6697b06843057.png'),
(4, '6697b0def29e3.png'),
(5, '6697b1a6687cb.png'),
(6, '6697b228dc518.png'),
(7, '6697b2a27adca.png'),
(8, '6697b2daf0c26.png'),
(9, '6698fdd18943b.png'),
(10, '669908860c921.png'),
(11, '6699089a44b10.png'),
(12, '669908a72de42.png'),
(13, '669a095ee9539.png'),
(14, '669a0a4163bfd.png'),
(15, '669a0a8de3826.png'),
(16, '669a0ac2463b4.png'),
(17, '669d1c69ea182.png'),
(18, '669d5de998b3d.png'),
(19, '669e267b8157a.png'),
(20, '669e2933bec2c.png'),
(21, '669e2b95be9d2.png'),
(22, '669e4248808f4.png'),
(23, '669e4255163d3.png'),
(24, '669e4280cf537.png'),
(25, '669e428c7343c.png'),
(26, '669e430b9bc43.png'),
(27, '669e89f81dfb6.png'),
(28, '669e8a17ec7c7.png'),
(29, '669e8aabe2d85.png'),
(30, '669f0c4c6d74b.png'),
(31, '669f0ce8be4c3.png');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(20) NOT NULL,
  `message` text NOT NULL,
  `uid` int(20) NOT NULL,
  `status` varchar(240) NOT NULL,
  `date_created` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `message`, `uid`, `status`, `date_created`) VALUES
(1, 'Hello! TRZ1XVMLDHZ0F. \'Successful Investment PRO PLAN 11000USD\'', 8, 'read', '2024-07-19 07:54:25'),
(2, 'Hello! TRZ1XVMLDHZ0F. \'Successful Investment PRO PLAN 11000USD\'', 8, 'read', '2024-07-20 07:54:25'),
(3, 'Hello! TRTE9U78FVTTD. \'Successful Investment ROOKIE PLAN 2000USD\'', 8, 'Unread', '2024-07-26 13:19:00'),
(4, 'Hello! TREMX38CBF3G0. \'Successful Investment ROOKIE PLAN 1002USD\'', 8, 'Unread', '2024-07-26 13:34:11'),
(5, 'Hello! TR3H6BH5N2A9J. \'Successful Investment ROOKIE PLAN 1200USD\'', 8, 'Unread', '2024-07-26 13:35:00'),
(6, 'Hello! TRUJPX3QCYW1P. \'Successful Investment ROOKIE PLAN 1001USD\'', 8, 'Unread', '2024-07-26 13:37:16'),
(7, 'Hello newtestjkn gdhd! $10 Transfer  to cloud@gmail.com has been Initiated <br> ', 8, 'Unread', '2024-07-26 16:55:14'),
(8, 'Hello newtestjkn gdhd! $10 Transfer  to cloud@gmail.com has been Initiated <br> ', 8, 'Unread', '2024-07-26 16:55:47'),
(9, 'Hello newtestjkn gdhd! $40 Transfer  to cloud@gmail.com has been Initiated <br> Its from your buddy new tester', 8, 'Unread', '2024-07-26 16:57:16'),
(10, 'Hello newtestjkn gdhd! $140 Transfer  to cloud@gmail.com has been Initiated <br>', 8, 'Unread', '2024-07-26 17:15:16'),
(11, 'Hello Cloud Last Name! you have recieved  $140 from cloud@gmail.com <br>lets fog ', 10, 'Unread', '2024-07-26 17:15:16'),
(12, 'Hello newtestjkn gdhd! $20 Transfer  to cloud@gmail.com has been Initiated <br>', 8, 'Unread', '2024-07-26 17:16:33'),
(13, 'Hello Cloud Last Name! you have recieved  $20 from newtest@gmail.com <br>sbdushudhsudhsudhsudhsi', 10, 'Unread', '2024-07-26 17:16:33'),
(14, 'Hello newtestjkn gdhd! $300 Transfer  to cloud@gmail.com has been Initiated <br>', 8, 'Unread', '2024-07-26 17:27:34'),
(15, 'Hello Cloud Last Name! you have recieved  $300 from newtest@gmail.com <br>For You My Gee', 10, 'Unread', '2024-07-26 17:27:34'),
(16, 'Hello newtestjkn gdhd! $200 Transfer  to cloud@gmail.com has been Initiated <br>', 8, 'Unread', '2024-07-26 17:29:40'),
(17, 'Hello Cloud Last Name! you have recieved  $200 from newtest@gmail.com <br>For you my main gee', 10, 'Unread', '2024-07-26 17:29:40'),
(18, 'Hello newtestjkn gdhd! $200 Transfer  to cloud@gmail.com has been Initiated <br>', 8, 'Unread', '2024-07-26 17:30:14'),
(19, 'Hello Cloud Last Name! you have recieved  $200 from newtest@gmail.com <br>For you my main gee', 10, 'Unread', '2024-07-26 17:30:14'),
(20, 'Hello newtestjkn gdhd! $20 Transfer  to cloud@gmail.com has been Initiated <br>', 8, 'Unread', '2024-07-26 17:33:39'),
(21, 'Hello Cloud Last Name! you have recieved  $20 from newtest@gmail.com <br>yvshvdsvdhsvdhsvhdvs', 10, 'Unread', '2024-07-26 17:33:39'),
(22, 'Hello newtestjkn gdhd! $50 Transfer  to cloud@gmail.com has been Initiated <br>', 8, 'Unread', '2024-07-26 17:39:13'),
(23, 'Hello Cloud Last Name! you have recieved  $50 from newtest@gmail.com <br>', 10, 'Unread', '2024-07-26 17:39:13'),
(24, 'Hello newtestjkn gdhd! $66 Transfer  to cloud@gmail.com has been Initiated <br>', 8, 'Unread', '2024-07-27 13:23:35'),
(25, 'Hello Cloud Last Name! you have recieved  $66 from newtest@gmail.com <br>', 10, 'Unread', '2024-07-27 13:23:35'),
(26, 'Hello newtestjkn gdhd! $100 Transfer  to cloud@gmail.com has been Initiated <br>', 8, 'Unread', '2024-07-27 13:23:51'),
(27, 'Hello Cloud Last Name! you have recieved  $100 from newtest@gmail.com <br>', 10, 'Unread', '2024-07-27 13:23:51'),
(28, 'Hello! TRQK9PKKDH427. \'Successful Investment ROOKIE PLAN 1000USD\'', 8, 'Unread', '2024-07-27 13:24:24');

-- --------------------------------------------------------

--
-- Table structure for table `schemas_list`
--

CREATE TABLE `schemas_list` (
  `id` int(20) NOT NULL,
  `name` varchar(240) NOT NULL,
  `roi` varchar(240) NOT NULL,
  `min` varchar(240) NOT NULL,
  `max` varchar(240) NOT NULL,
  `capital_back` varchar(240) NOT NULL,
  `return_type` varchar(240) NOT NULL,
  `period` varchar(240) NOT NULL,
  `profit_withdraw` varchar(240) NOT NULL,
  `cancel` varchar(240) NOT NULL,
  `icon` varchar(240) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `schemas_list`
--

INSERT INTO `schemas_list` (`id`, `name`, `roi`, `min`, `max`, `capital_back`, `return_type`, `period`, `profit_withdraw`, `cancel`, `icon`) VALUES
(1, 'SILVER PLAN', '28', '50000', '149000', 'No', 'Period', '31', 'Anytime', 'Within 2 Minutes', '../assets/global/images/RFX3Btq5Aob18L32ae0x.png'),
(2, 'ROOKIE PLAN', '15', '1000', '10000', 'No', 'Period', '31', 'Anytime', 'Within 2 Minutes', '../assets/global/images/x3xcK0BApo39th8DZZ3D.png'),
(3, 'PRO PLAN', '23', '11000', '49000', 'No', 'Period', '31', 'Anytime', 'Within 2 Minutes', '../assets/global/images/xTk5pB11G023JHCWNXpI.png'),
(4, 'MASTER PLAN', '35', '150000', '500000', 'No', 'Period', '31', 'Anytime', 'Within 2 Minutes', '../assets/global/images/5Cg77qFVlnV3dSgHGUNl.png');

-- --------------------------------------------------------

--
-- Table structure for table `support_ticket`
--

CREATE TABLE `support_ticket` (
  `id` int(11) NOT NULL,
  `tname` varchar(200) NOT NULL,
  `status` varchar(220) NOT NULL,
  `uid` int(20) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `unique_id` varchar(220) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `support_ticket`
--

INSERT INTO `support_ticket` (`id`, `tname`, `status`, `uid`, `date_created`, `unique_id`) VALUES
(1, 'Ticket Two', 'completed', 8, '2024-07-21 10:35:58', 'SUPT876859'),
(2, 'Ticket One', 'opened', 8, '2024-07-21 10:35:58', 'SUPT876854'),
(3, 'new ticket one', 'opened', 8, '2024-07-22 10:20:16', 'SUPT196938'),
(4, 'new ticket one', 'opened', 8, '2024-07-22 10:22:13', 'SUPT663576'),
(5, 'new ticket one', 'opened', 8, '2024-07-22 10:22:57', 'SUPT146682'),
(6, 'new ticket one', 'opened', 8, '2024-07-22 10:24:32', 'SUPT865717'),
(7, 'Ticket two testing', 'opened', 8, '2024-07-22 10:27:20', 'SUPT279496'),
(8, 'Ticket With Images', 'completed', 8, '2024-07-22 10:29:31', 'SUPT816259'),
(9, 'wwww', 'opened', 8, '2024-07-22 12:28:08', 'SUPT004032'),
(10, 'wwww', 'opened', 8, '2024-07-22 12:28:21', 'SUPT119874'),
(11, 'wwwwwqqqqqqqq', 'completed', 8, '2024-07-22 12:29:04', 'SUPT442999');

-- --------------------------------------------------------

--
-- Table structure for table `support_ticket_messages`
--

CREATE TABLE `support_ticket_messages` (
  `id` int(20) NOT NULL,
  `ticket_id` int(20) NOT NULL,
  `message` text NOT NULL,
  `image_id` varchar(220) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `support_ticket_messages`
--

INSERT INTO `support_ticket_messages` (`id`, `ticket_id`, `message`, `image_id`, `date_created`) VALUES
(1, 1, 'the description of the ticket', 'null', '2024-07-21 10:35:34'),
(2, 1, 'I need this problem solved asap', '1', '2024-07-21 10:35:34'),
(3, 3, 'the description for the new ticket one', 'null', '2024-07-22 10:20:16'),
(4, 4, 'the description for the new ticket one', 'null', '2024-07-22 10:22:13'),
(5, 5, 'the description for the new ticket one', 'null', '2024-07-22 10:22:57'),
(6, 6, 'the description for the new ticket one', 'null', '2024-07-22 10:24:32'),
(7, 7, 'description for ticket two ', 'null', '2024-07-22 10:27:20'),
(8, 8, 'Description for the Ticket With Images', '19', '2024-07-22 10:29:31'),
(9, 8, 'dfbdjbfdb', 'null', '2024-07-22 10:39:39'),
(10, 8, 'Latest Message', '20', '2024-07-22 10:41:07'),
(11, 8, 'this is the latest message', '21', '2024-07-22 10:51:17'),
(12, 9, 'wwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww\r\n\r\nwwwwwwww', '22', '2024-07-22 12:28:08'),
(13, 10, 'wwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww\r\n\r\nwwwwwwww', '23', '2024-07-22 12:28:21'),
(14, 11, 'wwqqqqqqqqqqqqqqqqqqqqqwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww\r\n\r\nwwwwwwww', '24', '2024-07-22 12:29:04'),
(15, 11, 'sss', '25', '2024-07-22 12:29:16'),
(16, 11, 'sss', '26', '2024-07-22 12:31:23'),
(17, 11, 'sssssssssssssssssss', 'null', '2024-07-22 12:31:32');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(20) NOT NULL,
  `type` varchar(240) NOT NULL,
  `amount` varchar(250) NOT NULL,
  `fee` varchar(250) NOT NULL,
  `gateway` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  `tid` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_modified` datetime NOT NULL,
  `imageid` varchar(240) NOT NULL,
  `schemaid` varchar(240) NOT NULL,
  `uid` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `type`, `amount`, `fee`, `gateway`, `status`, `tid`, `description`, `date_created`, `date_modified`, `imageid`, `schemaid`, `uid`) VALUES
(1, 'Investment', '60500', '0', 'ETH', 'Pending', 'TRXXF9CPWTEZJ', 'SILVER PLAN Invested', '2024-07-14 10:36:51', '2024-07-14 11:35:25', 'null', '1', 8),
(2, 'Investment', '50000', '0', 'balance', 'Failed', 'TRIVFJUQSLPRN', 'SILVER PLAN Invested', '2024-07-14 12:30:00', '0000-00-00 00:00:00', 'null', '1', 8),
(3, 'Investment', '2000', '0', 'BTC', 'Success', 'TRH224JJJDE9B', 'ROOKIE PLAN Invested', '2024-07-14 12:36:46', '0000-00-00 00:00:00', '1', '2', 8),
(4, 'Investment', '11000', '0', 'ETH', 'Pending', 'TRQQFLYSF3DEQ', 'PRO PLAN Invested', '2024-07-14 12:42:36', '0000-00-00 00:00:00', '2', '3', 8),
(5, 'Manual Deposit', '300', '0', 'BTC', 'Pending', 'TRQV759I6HYOF', '$300 Deposit Pending', '2024-07-17 12:52:08', '0000-00-00 00:00:00', '3', 'null', 8),
(6, 'Manual Deposit', '300', '0', 'BTC', 'Success', 'TRWJ8JDR7XXH1', '$300 Deposit Pending', '2024-07-17 12:54:07', '0000-00-00 00:00:00', '4', 'null', 8),
(7, 'Manual Deposit', '3000', '0', 'ETH', 'Pending', 'TRD6LDT652R6D', '$3000 Deposit Pending', '2024-07-17 12:57:26', '0000-00-00 00:00:00', '5', 'null', 8),
(8, 'Manual Deposit', '4999', '0', 'BTC', 'Pending', 'TR5PZPIR1CGBK', '$4999 Deposit Pending', '2024-07-17 12:59:36', '0000-00-00 00:00:00', '6', 'null', 8),
(9, 'Manual Deposit', '2122', '0', 'BTC', 'Pending', 'TROJNWF06UL0V', '$2122 Deposit Pending', '2024-07-17 13:01:38', '0000-00-00 00:00:00', '7', 'null', 8),
(10, 'Manual Deposit', '2122', '0', 'BTC', 'Pending', 'TRA0L1N2BUGBL', '$2122 Deposit Pending', '2024-07-17 13:02:34', '0000-00-00 00:00:00', '8', 'null', 8),
(11, 'Manual Deposit', '1234', '0', 'ETH', 'Pending', 'TRR8P9ZPS46W0', '$1234 Deposit Pending', '2024-07-18 12:34:41', '0000-00-00 00:00:00', '9', 'null', 8),
(12, 'Manual Deposit', '2333', '0', 'BTC', 'Pending', 'TR8UR9F18TMK9', '$2333 Deposit Pending', '2024-07-18 13:20:22', '0000-00-00 00:00:00', '10', 'null', 8),
(13, 'Manual Deposit', '2333', '0', 'BTC', 'Pending', 'TR013QXSV1LZ8', '$2333 Deposit Pending', '2024-07-18 13:20:42', '0000-00-00 00:00:00', '11', 'null', 8),
(14, 'Manual Deposit', '2333', '0', 'BTC', 'Pending', 'TRE3C2D7Y0XM8', '$2333 Deposit Pending', '2024-07-18 13:20:55', '0000-00-00 00:00:00', '12', 'null', 8),
(20, 'Exchange', '19.99', '0.01', 'System', 'Success', 'TR6S5OQCPI29F', 'Profit to Main Wallet Exchanged', '2024-07-18 14:50:35', '0000-00-00 00:00:00', 'null', 'null', 8),
(21, 'Exchange', '19.97', '0.01', 'System', 'Success', 'TR4FGSCZZF5PK', 'Main to Profit Wallet Exchanged', '2024-07-18 15:15:04', '0000-00-00 00:00:00', 'null', 'null', 8),
(23, 'Exchange', '190', '0.1', 'System', 'Success', 'TRYTUDBH0GB3M', 'Profit to Main Wallet Exchanged', '2024-07-18 15:24:23', '0000-00-00 00:00:00', 'null', 'null', 8),
(24, 'Investment', '11000', '0', 'BTC', 'Pending', 'TRD3R7PTD1P89', 'PRO PLAN Invested', '2024-07-19 07:36:14', '0000-00-00 00:00:00', '13', '3', 8),
(25, 'Investment', '11000', '0', 'BTC', 'Pending', 'TR9I3BWNBCR9J', 'PRO PLAN Invested', '2024-07-19 07:40:01', '0000-00-00 00:00:00', '14', '3', 8),
(26, 'Investment', '11000', '0', 'BTC', 'Pending', 'TRGAU7WYECP6Z', 'PRO PLAN Invested', '2024-07-19 07:41:17', '0000-00-00 00:00:00', '15', '3', 8),
(27, 'Investment', '11000', '0', 'BTC', 'Pending', 'TRZ1XVMLDHZ0F', 'PRO PLAN Invested', '2024-07-19 07:42:10', '0000-00-00 00:00:00', '16', '3', 8),
(28, 'Manual Deposit', '2000', '0', 'ETH', 'Pending', 'TRIAFRCY6GDH1', '$2000 Deposit Pending', '2024-07-21 15:34:17', '0000-00-00 00:00:00', '17', 'null', 8),
(29, 'Manual Deposit', '1122', '0', 'BTC', 'Pending', 'TRKSEHQ2CW0US', '$1122 Deposit Pending', '2024-07-21 20:13:45', '0000-00-00 00:00:00', '18', 'null', 8),
(30, 'Referral', '500', '0', 'System', 'Success', 'TRKTRHQCKW0GB', 'Referral: cloud@gmail.com', '2024-07-26 20:13:45', '0000-00-00 00:00:00', 'null', 'null', 8),
(31, 'Deposit Bonus', '222', '0', 'System', 'Success', 'TRKTRHQDDDDDD', '$222 Deposit Bonus', '2024-07-26 20:13:45', '0000-00-00 00:00:00', 'null', 'null', 8),
(32, 'Investment', '2000', '0', 'Main Balance', 'Pending', 'TRTE9U78FVTTD', 'ROOKIE PLAN Invested', '2024-07-26 13:19:00', '0000-00-00 00:00:00', 'null', '2', 8),
(33, 'Investment', '1002', '0', 'Main Balance', 'Pending', 'TREMX38CBF3G0', 'ROOKIE PLAN Invested', '2024-07-26 13:34:11', '0000-00-00 00:00:00', 'null', '2', 8),
(34, 'Investment', '1200', '0', 'Main Balance', 'Pending', 'TR3H6BH5N2A9J', 'ROOKIE PLAN Invested', '2024-07-26 13:35:00', '0000-00-00 00:00:00', 'null', '2', 8),
(35, 'Exchange', '2000', '1', 'System', 'Success', 'TR1GAE8BJX5J1', 'Main to Profit Wallet Exchanged', '2024-07-26 13:35:27', '0000-00-00 00:00:00', 'null', 'null', 8),
(36, 'Investment', '1001', '0', 'Profit Balance', 'Pending', 'TRUJPX3QCYW1P', 'ROOKIE PLAN Invested', '2024-07-26 13:37:16', '0000-00-00 00:00:00', 'null', '2', 8),
(37, 'Exchange', '0', '0', 'System', 'Success', 'TRSSQ6LDZUBT0', 'Profit to Main Wallet Exchanged', '2024-07-26 15:35:51', '0000-00-00 00:00:00', 'null', 'null', 8),
(38, 'Exchange', '9', '0', 'System', 'Success', 'TRKTC1D84Y9WQ', 'Profit to Main Wallet Exchanged', '2024-07-26 15:45:29', '0000-00-00 00:00:00', 'null', 'null', 8),
(39, 'Exchange', '9', '0', 'System', 'Success', 'TRZ4PTXQMJBZO', 'Profit to Main Wallet Exchanged', '2024-07-26 15:45:41', '0000-00-00 00:00:00', 'null', 'null', 8),
(40, 'Transfer', '2000', '0', 'Main Balance', 'Pending', 'TRTE9U7hbhsi', 'Transfer to sam@gmail.com', '2024-07-26 13:19:00', '0000-00-00 00:00:00', 'null', 'null', 8),
(41, 'Transfer', '10', '0.5', 'Main Balance', 'Success', 'TR1P8QIKVIOW1', 'Transfer to cloud@gmail.com', '2024-07-26 16:55:14', '0000-00-00 00:00:00', 'null', 'null', 8),
(42, 'Transfer', '10', '0.5', 'Main Balance', 'Success', 'TREI0EL9D9L7A', 'Transfer to cloud@gmail.com', '2024-07-26 16:55:47', '0000-00-00 00:00:00', 'null', 'null', 8),
(43, 'Transfer', '40', '2', 'Main Balance', 'Success', 'TR824KYOL54I5', 'Transfer to cloud@gmail.com', '2024-07-26 16:57:16', '0000-00-00 00:00:00', 'null', 'null', 8),
(44, 'Transfer', '140', '7', 'Main Balance', 'Success', 'TRXBI6YDQRDXM', 'Transfer to cloud@gmail.com', '2024-07-26 17:15:16', '0000-00-00 00:00:00', 'null', 'null', 8),
(45, 'Transfer', '20', '1', 'Main Balance', 'Success', 'TR81V7XSE3ZOW', 'Transfer to cloud@gmail.com', '2024-07-26 17:16:33', '0000-00-00 00:00:00', 'null', 'null', 8),
(46, 'Transfer', '300', '15', 'Main Balance', 'Success', 'TRRPNVYYFSB15', 'Transfer to cloud@gmail.com', '2024-07-26 17:27:34', '0000-00-00 00:00:00', 'null', 'null', 8),
(47, 'Transfer', '300', '15', 'Main Balance', 'Success', 'TRRPNVYYFSB15', 'Transfer to cloud@gmail.com', '2024-07-26 17:27:34', '0000-00-00 00:00:00', 'null', 'null', 8),
(48, 'Transfer', '200', '10', 'Main Balance', 'Success', 'TRIDDNX7M129V', 'Transfer to cloud@gmail.com', '2024-07-26 17:29:40', '0000-00-00 00:00:00', 'null', 'null', 8),
(49, 'Transfer', '200', '10', 'Main Balance', 'Success', 'TRCAAW04JOHXY', 'Transfer to cloud@gmail.com', '2024-07-26 17:30:14', '0000-00-00 00:00:00', 'null', 'null', 8),
(51, 'Transfer', '20', '1', 'Main Balance', 'Success', 'TRKMFYNH138WL', 'Transfer to cloud@gmail.com', '2024-07-26 17:33:39', '0000-00-00 00:00:00', 'null', 'null', 8),
(52, 'Transfer Deposit', '20', '0', 'Transfer', 'Success', 'TRBQ8X0C6Y4SX', '$20 Transfer Deposit', '2024-07-26 17:33:39', '0000-00-00 00:00:00', 'null', 'null', 10),
(53, 'Transfer', '50', '2.5', 'Main Balance', 'Success', 'TR0VRU5OA697Z', 'Transfer to cloud@gmail.com', '2024-07-26 17:39:13', '0000-00-00 00:00:00', 'null', 'null', 8),
(54, 'Transfer Deposit', '50', '0', 'Transfer', 'Success', 'TRMH38SITBOIX', '$50 Transfer Deposit from newtest@gmail.com', '2024-07-26 17:39:13', '0000-00-00 00:00:00', 'null', 'null', 10),
(55, 'Exchange', '160', '0.08', 'System', 'Success', 'TRU241OA84187', 'Profit to Main Wallet Exchanged', '2024-07-27 13:16:55', '0000-00-00 00:00:00', 'null', 'null', 8),
(56, 'Exchange', '900', '0.45', 'System', 'Success', 'TRW5ZDL5ZVSO2', 'Main to Profit Wallet Exchanged', '2024-07-27 13:20:34', '0000-00-00 00:00:00', 'null', 'null', 8),
(57, 'Transfer', '66', '3.3', 'Main Balance', 'Success', 'TR4A8SBCDY7DK', 'Transfer to cloud@gmail.com', '2024-07-27 13:23:35', '0000-00-00 00:00:00', 'null', 'null', 8),
(58, 'Transfer Deposit', '66', '0', 'Transfer', 'Success', 'TRV0U9PQ76VZ5', '$66 Transfer Deposit from newtest@gmail.com', '2024-07-27 13:23:35', '0000-00-00 00:00:00', 'null', 'null', 10),
(59, 'Transfer', '100', '5', 'Main Balance', 'Success', 'TR119S9OE8U8H', 'Transfer to cloud@gmail.com', '2024-07-27 13:23:51', '0000-00-00 00:00:00', 'null', 'null', 8),
(60, 'Transfer Deposit', '100', '0', 'Transfer', 'Success', 'TRF1OQGCX1LDO', '$100 Transfer Deposit from newtest@gmail.com', '2024-07-27 13:23:51', '0000-00-00 00:00:00', 'null', 'null', 10),
(61, 'Investment', '1000', '0', 'Main Balance', 'Pending', 'TRQK9PKKDH427', 'ROOKIE PLAN Invested', '2024-07-27 13:24:24', '0000-00-00 00:00:00', 'null', '2', 8),
(63, 'Withdrawal', '36', '1.8', 'BTC', 'Success', 'TRPK8482F2G8F', 'Withdrawal with BTC \n <i>(ddddddddddddddddddddddddddddd)</i>', '2024-07-27 13:46:06', '0000-00-00 00:00:00', 'null', 'null', 8);

-- --------------------------------------------------------

--
-- Table structure for table `veridata`
--

CREATE TABLE `veridata` (
  `id` int(11) NOT NULL,
  `name` varchar(240) NOT NULL,
  `uid` int(11) NOT NULL,
  `state` varchar(240) NOT NULL,
  `image_id` varchar(240) NOT NULL,
  `status` varchar(240) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `veridata`
--

INSERT INTO `veridata` (`id`, `name`, `uid`, `state`, `image_id`, `status`) VALUES
(2, 'qqqqqqqqq', 8, 'qqqqqq', '31', 'pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schemas_list`
--
ALTER TABLE `schemas_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_ticket`
--
ALTER TABLE `support_ticket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_ticket_messages`
--
ALTER TABLE `support_ticket_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `veridata`
--
ALTER TABLE `veridata`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `schemas_list`
--
ALTER TABLE `schemas_list`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `support_ticket`
--
ALTER TABLE `support_ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `support_ticket_messages`
--
ALTER TABLE `support_ticket_messages`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `veridata`
--
ALTER TABLE `veridata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

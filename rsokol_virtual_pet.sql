-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 09, 2024 at 01:14 PM
-- Server version: 5.7.23-23
-- PHP Version: 8.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rsokol_virtual_pet`
--

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
  `cid` int(11) NOT NULL,
  `coins` int(11) NOT NULL,
  `username` varchar(25) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`cid`, `coins`, `username`) VALUES
(14, 17, 'test'),
(49, 1, 'charlie'),
(53, 4, 'new'),
(54, 0, 'mj'),
(68, 50, 'test1'),
(69, 17, 'test'),
(70, 17, 'test'),
(71, 17, 'test'),
(72, 0, 'login'),
(73, 33, 'Ferraluke'),
(74, 0, 'Asher360');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `iid` int(11) NOT NULL,
  `item` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `username` varchar(25) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`iid`, `item`, `amount`, `username`) VALUES
(92, 'kibble', 1, 'login');

-- --------------------------------------------------------

--
-- Table structure for table `lastlogged`
--

CREATE TABLE `lastlogged` (
  `llid` int(11) NOT NULL,
  `username` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `DT` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lastlogged`
--

INSERT INTO `lastlogged` (`llid`, `username`, `DT`) VALUES
(6, 'test', '2024-03-27 14:58:41'),
(14, 'charlie', '2024-03-27 16:19:33'),
(15, 'test', '2024-03-27 16:20:34'),
(16, 'test', '2024-03-27 16:20:37'),
(17, 'charlie', '2024-03-27 16:20:46'),
(18, 'test', '2024-03-27 16:21:56'),
(19, 'test', '2024-03-27 16:22:07'),
(20, 'charlie', '2024-03-27 16:22:16'),
(21, 'charlie', '2024-03-27 16:24:53'),
(22, 'test', '2024-03-27 16:25:40'),
(23, 'test', '2024-03-27 16:47:20'),
(24, 'charlie', '2024-03-27 16:47:34'),
(25, 'test', '2024-03-27 19:23:15'),
(26, 'test', '2024-03-28 22:45:04'),
(27, 'test', '2024-03-30 20:34:23'),
(28, 'test', '2024-03-30 20:34:55'),
(29, 'test', '2024-03-31 14:51:28'),
(30, 'mj', '2024-04-01 13:19:41'),
(31, 'test', '2024-04-01 14:30:42'),
(32, 'test', '2024-04-02 15:29:37'),
(33, 'test', '2024-04-02 15:33:00'),
(34, 'charlie', '2024-04-02 15:42:52'),
(35, 'new', '2024-04-02 16:07:15'),
(36, 'test', '2024-04-03 12:06:08'),
(37, 'test', '2024-04-03 17:27:15'),
(38, 'test', '2024-04-03 19:54:38'),
(39, 'test', '2024-04-03 21:47:22'),
(40, 'test', '2024-04-04 12:12:18'),
(41, 'test', '2024-04-04 15:23:59'),
(42, 'test', '2024-04-05 22:19:59'),
(43, 'test', '2024-04-10 23:30:57'),
(44, 'test', '2024-04-13 18:07:56'),
(45, 'test1', '2024-04-13 18:09:25'),
(46, 'test', '2024-04-13 18:10:45'),
(47, 'test', '2024-04-13 18:54:14'),
(48, 'test', '2024-04-13 19:08:16'),
(49, 'test', '2024-04-14 10:48:20'),
(50, 'test1', '2024-04-14 12:33:05'),
(51, 'test', '2024-04-14 13:02:51'),
(52, 'test', '2024-04-17 10:51:59'),
(53, 'login', '2024-04-17 19:51:51'),
(54, 'test', '2024-04-17 20:35:33'),
(55, 'test', '2024-04-17 20:52:16'),
(66, 'test', '2024-04-20 12:21:04'),
(67, 'test', '2024-04-22 21:13:22'),
(68, 'test', '2024-04-23 15:11:30'),
(69, 'test', '2024-04-26 18:42:01'),
(70, 'test', '2024-04-26 18:51:14'),
(71, 'test', '2024-04-26 19:18:58'),
(72, 'test', '2024-04-28 16:39:17'),
(73, 'test', '2024-04-29 20:22:59'),
(74, 'test', '2024-04-30 12:01:43'),
(75, 'test', '2024-04-30 17:49:31'),
(76, 'mj', '2024-05-03 15:30:35'),
(77, 'test', '2024-05-05 18:40:14'),
(78, 'Ferraluke', '2024-05-05 18:40:51'),
(79, 'test', '2024-05-05 18:40:57'),
(80, 'test', '2024-05-05 19:07:06'),
(81, 'Asher360', '2024-05-05 23:54:18'),
(82, 'mj', '2024-05-06 15:52:37'),
(83, 'test', '2024-05-06 19:58:47'),
(84, 'Ferraluke', '2024-05-06 20:01:21'),
(85, 'test', '2024-05-07 20:45:03');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `username` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `password`, `email`) VALUES
('Asher360', 'bbd7c18f71f374dd43de63dab8ae60185283a414ebba4ebd453a185960a3b2de6fc721bddf5b6ed51a27855f41d5138b2348b89469746bdf74c67d260404fc10', ''),
('charlie', '70c9ad8417404d9a86d15ff763422d9f8df88e76094e4effa442b8d86c5a162d525217dd479c8045528ecc6525cde23eb8b54df2b536bcfdc4702d7976980c40', ''),
('Ferraluke', '83adfcf8728dd692ac8d1a14da451a77fe9089947ed8961d7c441093e344ff865aa3352675f2d641d487739119dfa5cc62ca5e9fb81c73e0f854efb548475af3', ''),
('login', 'd31c9423a962ed81aff9f8fae464bedb6e7cfb43226ef42ca078912a88624527403a41b410ae834a93e9d2d347828e4548ee144f9aea280dab1b1e8fc80b4a54', ''),
('mj', 'c96a2f2e8cbb9407722f6a643048d27d7ab926b081ce86a679cc72b4452f61636892b72f080753d904c100c7aa5ee00137940e7a709a44a2be6b00e1744844ef', ''),
('new', '1d60e6ed6ca83fc5194d5b25e8997d381fbf91f2621e10254a1c4c86d252bc8253cafabad4651c38e9c8112d347a9922c14ad1913afe421dff9fb531436d34c8', ''),
('test', 'a636104ed7a32c540fd72a77614577d1918c645f384cf0bda9024b4ff08ea77a4e9e8ee65976781bd82ed751141f508bf953fe0437a8c77aa9fe712a191f1568', ''),
('test1', '22c04613e84de8e62da4dc81c4f9ac94b8aa253d9cf569f84ff0a6e4f09ef4786ed2721c0d7670bcf7e30ad536152677687b5fb4f8e48786df7e1dd4c8ede42f', '');

-- --------------------------------------------------------

--
-- Table structure for table `pet`
--

CREATE TABLE `pet` (
  `pid` int(11) NOT NULL,
  `username` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `happy` int(11) NOT NULL,
  `health` int(11) NOT NULL,
  `archive` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pet`
--

INSERT INTO `pet` (`pid`, `username`, `type`, `name`, `img`, `happy`, `health`, `archive`) VALUES
(40, 'test', 'cat', 'Sherry', 'images/cat1.svg', 0, 0, 1),
(41, 'test', 'dog', 'dog', 'images/dog4.svg', 0, 0, 1),
(42, 'test', 'dog', 'katherine', 'images/dog2.svg', 0, 0, 1),
(43, 'test', 'cat', 'hali', 'images/cat2.svg', 0, 0, 1),
(44, 'test', 'dog', 'sherryl', 'images/dog4.svg', 0, 0, 1),
(45, 'login', 'cat', 'boop', 'images/cat3.svg', 60, 100, 0),
(46, 'login', 'dog', 'twig', 'images/dog2.svg', 50, 50, 0),
(47, 'login', 'cat', 'hug', 'images/cat3.svg', 50, 50, 0),
(48, 'login', 'dog', 'gar', 'images/dog1.svg', 50, 50, 0),
(49, 'login', 'dog', 'whop', 'images/dog2.svg', 50, 50, 0),
(50, 'test', 'dog', 'Callie', 'images/dog1.svg', 50, 55, 0),
(51, 'test', 'cat', 'Sheema', 'images/cat2.svg', 0, 0, 1),
(52, 'test', 'dog', 'Chili', 'images/dog2.svg', 0, 0, 1),
(53, 'mj', 'cat', 'Pearl', 'images/cat3.svg', 60, 100, 0),
(54, 'Ferraluke', 'cat', 'Kitty', 'images/cat2.svg', 90, 90, 0),
(55, 'test', 'cat', 'Cat', 'images/cat3.svg', 30, 30, 0),
(56, 'test', 'cat', 'heat', 'images/cat1.svg', 30, 30, 0),
(57, 'test', 'cat', 'sdf', 'images/cat2.svg', 30, 30, 0),
(58, 'test', 'cat', 'dsfa', 'images/cat2.svg', 30, 30, 0),
(59, 'test', 'cat', 'sdf', 'images/cat3.svg', 30, 30, 0),
(60, 'test', 'dog', 'sadf', 'images/dog2.svg', 30, 30, 0),
(61, 'test', 'dog', 'sdf', 'images/dog2.svg', 30, 30, 0),
(62, 'test', 'dog', 'sdfads', 'images/dog5.svg', 30, 30, 0),
(63, 'Asher360', 'cat', 'Cheerio', 'images/cat1.svg', 100, 85, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`cid`),
  ADD KEY `FK_CurrencyLogin` (`username`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`iid`),
  ADD KEY `FK_username` (`username`);

--
-- Indexes for table `lastlogged`
--
ALTER TABLE `lastlogged`
  ADD PRIMARY KEY (`llid`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pet`
--
ALTER TABLE `pet`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `FK_PetLogin` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `iid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=220;

--
-- AUTO_INCREMENT for table `lastlogged`
--
ALTER TABLE `lastlogged`
  MODIFY `llid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `pet`
--
ALTER TABLE `pet`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `currency`
--
ALTER TABLE `currency`
  ADD CONSTRAINT `FK_CurrencyLogin` FOREIGN KEY (`username`) REFERENCES `login` (`username`);

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `FK_username` FOREIGN KEY (`username`) REFERENCES `login` (`username`);

--
-- Constraints for table `lastlogged`
--
ALTER TABLE `lastlogged`
  ADD CONSTRAINT `lastlogged_ibfk_1` FOREIGN KEY (`username`) REFERENCES `login` (`username`);

--
-- Constraints for table `pet`
--
ALTER TABLE `pet`
  ADD CONSTRAINT `FK_PetLogin` FOREIGN KEY (`username`) REFERENCES `login` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

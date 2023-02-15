-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2023 at 09:47 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `metroshoes`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `uname` varchar(255) NOT NULL,
  `gaddress` varchar(255) NOT NULL,
  `phoneno` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `passcde` varchar(255) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `uname`, `gaddress`, `phoneno`, `status`, `passcde`, `date`) VALUES
(28, 'hassankhatta', 'hassancollege3@gmail.com', 2147483647, 0, '$2y$10$Tj.SWRFSAKhnSaM./0gftejHMHG4Y0fXy.5J/u1MZOxfgZHVSGKxG', '2022-07-25 15:09:55'),
(30, 'ahmadkhattak', 'hassancollege3@gmail.com', 1111111111, 0, '$2y$10$9qcZu5CoRPxGoOms8lz/wOW2TNRU4Av0JFaKPoAzPTWneKYYNAxb.', '2023-01-18 13:40:51'),
(31, 'hassan', 'perdev58@gmail.com', 2147483647, 1, '$2y$10$M3SQwwMShxJj1r3e9cD6/uL60PebFK5ZDL9xSuxRyoVJV6ULO0iny', '2023-01-18 13:42:15');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `status`) VALUES
(9, 'Cricket', 1),
(10, 'sports', 1);

-- --------------------------------------------------------

--
-- Table structure for table `color_master`
--

CREATE TABLE `color_master` (
  `id` int(11) NOT NULL,
  `color_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `color_master`
--

INSERT INTO `color_master` (`id`, `color_name`) VALUES
(20, 'black'),
(21, 'red'),
(24, 'white'),
(25, 'pink'),
(26, 'blue'),
(30, 'blue');

-- --------------------------------------------------------

--
-- Table structure for table `frontpage`
--

CREATE TABLE `frontpage` (
  `heading` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `btn` varchar(255) NOT NULL,
  `btnlink` varchar(255) NOT NULL,
  `heropic` varchar(300) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `frontpage`
--

INSERT INTO `frontpage` (`heading`, `text`, `btn`, `btnlink`, `heropic`, `id`) VALUES
('Hack With Hassan', 'um placeat? Dolor similique modi illum! Saepe voluptatem, quod soluta cumque magnam accusamus quas consequuntur eos vitae, minus impedit porro beatae ad a.\r\num placeat? Dolor similique modi illum! Saepe voluptatem,', 'Call Now', '#', '../public/photos/03.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `title` varchar(400) NOT NULL,
  `gmailaddress` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `title`, `gmailaddress`, `message`, `datetime`) VALUES
(2, 'dsdd', 'sad', 'sad', '2022-07-16 09:49:54'),
(6, ' 923068088638', 'dfsdfs', 'dfsdfs', '2022-07-16 14:31:08'),
(7, 'adssadsad', 'asd', 'asd', '2022-07-16 14:31:35'),
(8, 'fsds', 'sfs', 'sfs', '2022-07-18 10:37:23'),
(9, 'dvdvdevd', 'dsvfdavfzdvfd', 'dsvfdavfzdvfd', '2022-07-18 10:38:01'),
(10, 'defsds', 'sdffafgyjyukuikik34354', 'sdffafgyjyukuikik34354', '2022-07-18 10:38:22');

-- --------------------------------------------------------

--
-- Table structure for table `play`
--

CREATE TABLE `play` (
  `id` int(11) NOT NULL,
  `gameid` int(255) NOT NULL,
  `yards` int(20) NOT NULL,
  `down` varchar(50) NOT NULL,
  `half` int(50) NOT NULL,
  `team1timeout` int(20) NOT NULL,
  `team2timeout` int(20) NOT NULL,
  `minute_remaining` int(20) NOT NULL,
  `seconds_remaining` int(20) NOT NULL,
  `datetime` datetime NOT NULL,
  `timer_update_status` int(1) NOT NULL,
  `game_status` tinyint(4) NOT NULL,
  `timerstatus` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `imgfile` varchar(400) NOT NULL,
  `rating` int(2) NOT NULL,
  `discount` int(4) NOT NULL,
  `color` varchar(50) NOT NULL,
  `size` int(4) NOT NULL,
  `mrp` int(4) NOT NULL,
  `cat` int(11) NOT NULL,
  `cat_status` tinyint(4) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `imgfile`, `rating`, `discount`, `color`, `size`, `mrp`, `cat`, `cat_status`, `timestamp`) VALUES
(36, 'tttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttt', 'tttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttt', '../public/photos/bootstrap-4.png', 2, 12, 'pink', 22, 28276, 9, 1, '2022-07-25 09:12:18');

-- --------------------------------------------------------

--
-- Table structure for table `registration_status`
--

CREATE TABLE `registration_status` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registration_status`
--

INSERT INTO `registration_status` (`id`, `type`, `status`) VALUES
(1, 'registration', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sitesetting`
--

CREATE TABLE `sitesetting` (
  `id` int(11) NOT NULL,
  `webname` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `mobile` int(11) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `insta` varchar(255) NOT NULL,
  `gmap` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sitesetting`
--

INSERT INTO `sitesetting` (`id`, `webname`, `img`, `facebook`, `mobile`, `twitter`, `insta`, `gmap`) VALUES
(1, 'Metroshoes', '../public/photos/download.jpg', 'https://web.facebook.com/', 11111111, 'https://twitter.com/login', 'https://www.instagram.com/?hl=en', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d106390.26164949877!2d71.39749238545686!3d33.5612823783251!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38d8ef13ac5af415%3A0x864572b0758eb834!2sKohat%2C%20Khyber%20Pakhtunkhwa%2C%20Pakistan!5e0!3');

-- --------------------------------------------------------

--
-- Table structure for table `size_master`
--

CREATE TABLE `size_master` (
  `id` int(11) NOT NULL,
  `size_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `size_master`
--

INSERT INTO `size_master` (`id`, `size_number`) VALUES
(2, 22),
(7, 43);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `color_master`
--
ALTER TABLE `color_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `frontpage`
--
ALTER TABLE `frontpage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `play`
--
ALTER TABLE `play`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registration_status`
--
ALTER TABLE `registration_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sitesetting`
--
ALTER TABLE `sitesetting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `size_master`
--
ALTER TABLE `size_master`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `color_master`
--
ALTER TABLE `color_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `frontpage`
--
ALTER TABLE `frontpage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `play`
--
ALTER TABLE `play`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `registration_status`
--
ALTER TABLE `registration_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sitesetting`
--
ALTER TABLE `sitesetting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `size_master`
--
ALTER TABLE `size_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

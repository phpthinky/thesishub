-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2017 at 02:23 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `page_id` int(11) NOT NULL,
  `pageview_id` varchar(255) NOT NULL,
  `page_type` varchar(50) NOT NULL,
  `page_url` varchar(255) NOT NULL,
  `date_created` varchar(20) NOT NULL,
  `date_updated` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `pageview`
--

CREATE TABLE `pageview` (
  `id` int(11) NOT NULL,
  `page` text NOT NULL,
  `page_id` int(11) NOT NULL,
  `userip` text NOT NULL,
  `year` int(11) NOT NULL,
  `agent` varchar(255) NOT NULL,
  `machine` varchar(50) NOT NULL,
  `browser` varchar(25) NOT NULL,
  `last_used_browser` varchar(15) NOT NULL,
  `counter` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `day` int(11) NOT NULL,
  `tday` varchar(11) NOT NULL,
  `complete_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pageview`
--

INSERT INTO `pageview` (`id`, `page`, `page_id`, `userip`, `year`, `agent`, `machine`, `browser`, `last_used_browser`, `counter`, `month`, `day`, `tday`, `complete_date`) VALUES
(23, '/test', 1, '127.0.0.1', 2017, '', 'Windows 7', 'Chrome', 'Chrome', 3, 11, 8, 'Wed', '2017-11-08'),
(22, '/test2', 0, '127.0.0.1', 2017, '', 'Windows 7', 'Chrome', '', 0, 11, 8, 'Wed', '2017-11-08'),
(24, '/test/hello', 0, '127.0.0.1', 2017, '', 'Windows 7', 'Firefox', 'Firefox', 2, 11, 8, 'Wed', '2017-11-08');

-- --------------------------------------------------------

--
-- Table structure for table `page_visits`
--

CREATE TABLE `page_visits` (
  `visit_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `page` varchar(500) NOT NULL,
  `country` varchar(50) NOT NULL,
  `count` int(11) NOT NULL,
  `date_visited` varchar(20) NOT NULL,
  `date_updated` varchar(20) NOT NULL,
  `month_year` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page_visits`
--

INSERT INTO `page_visits` (`visit_id`, `page_id`, `page`, `country`, `count`, `date_visited`, `date_updated`, `month_year`) VALUES
(1, 0, 'index/hello', '', 11, '2016-01-01', '', ''),
(2, 0, 'post/hello', '', 22, '2017-11-05', '', ''),
(3, 0, 'post/hello', '', 12, '2017-11-04', '', ''),
(4, 1, '/test', '', 0, '2017-11-04', '', ''),
(5, 0, 'post/hi', '', 6, '2017-11-04', '', ''),
(6, 0, '/post', '', 0, '2017-11-04', '', ''),
(7, 0, '/cfarmapps/test', '', 0, '2017-11-06', '', ''),
(8, 0, 'post/hello', '', 12, '2017-11-06', '', ''),
(9, 1, '/test', '', 0, '2017-11-07', '', ''),
(10, 0, 'post/head', '', 0, '2017-11-07', '', ''),
(11, 0, 'post', '', 20, '2017-11-08', '', '');

-- --------------------------------------------------------

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `pageview`
--
ALTER TABLE `pageview`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_visits`
--
ALTER TABLE `page_visits`
  ADD PRIMARY KEY (`visit_id`);

--
-- AUTO_INCREMENT for dumped tables
--

-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pageview`
--
ALTER TABLE `pageview`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `page_visits`
--
ALTER TABLE `page_visits`
  MODIFY `visit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

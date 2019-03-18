-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 31, 2017 at 04:03 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thesishubdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `aauth_groups`
--

CREATE TABLE `aauth_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `definition` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aauth_groups`
--

INSERT INTO `aauth_groups` (`id`, `name`, `definition`) VALUES
(1, 'Admin', 'Super Admin Group'),
(2, 'Public', 'Public Access Group'),
(3, 'Default', 'Default Access Group'),
(4, 'Bachelor of Science in Computer Science', 'jdsfjsdklfjsdk');

-- --------------------------------------------------------

--
-- Table structure for table `aauth_group_to_group`
--

CREATE TABLE `aauth_group_to_group` (
  `group_id` int(11) UNSIGNED NOT NULL,
  `subgroup_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `aauth_login_attempts`
--

CREATE TABLE `aauth_login_attempts` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(39) DEFAULT '0',
  `timestamp` datetime DEFAULT NULL,
  `login_attempts` tinyint(2) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `aauth_perms`
--

CREATE TABLE `aauth_perms` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `definition` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aauth_perms`
--

INSERT INTO `aauth_perms` (`id`, `name`, `definition`) VALUES
(1, 'private', ''),
(2, 'public', '');

-- --------------------------------------------------------

--
-- Table structure for table `aauth_perms_req`
--

CREATE TABLE `aauth_perms_req` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `perm_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `request_status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `aauth_perm_to_group`
--

CREATE TABLE `aauth_perm_to_group` (
  `perm_id` int(11) UNSIGNED NOT NULL,
  `group_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aauth_perm_to_group`
--

INSERT INTO `aauth_perm_to_group` (`perm_id`, `group_id`) VALUES
(2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `aauth_perm_to_user`
--

CREATE TABLE `aauth_perm_to_user` (
  `perm_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `aauth_pms`
--

CREATE TABLE `aauth_pms` (
  `id` int(11) UNSIGNED NOT NULL,
  `sender_id` int(11) UNSIGNED NOT NULL,
  `receiver_id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text,
  `date_sent` datetime DEFAULT NULL,
  `date_read` datetime DEFAULT NULL,
  `pm_deleted_sender` int(1) DEFAULT NULL,
  `pm_deleted_receiver` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `aauth_users`
--

CREATE TABLE `aauth_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(64) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `stud_id` varchar(50) NOT NULL,
  `stud_id_ex` varchar(50) NOT NULL,
  `banned` tinyint(1) DEFAULT '0',
  `last_login` datetime DEFAULT NULL,
  `last_activity` datetime DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `forgot_exp` text,
  `remember_time` datetime DEFAULT NULL,
  `remember_exp` text,
  `verification_code` text,
  `totp_secret` varchar(16) DEFAULT NULL,
  `ip_address` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aauth_users`
--

INSERT INTO `aauth_users` (`id`, `email`, `pass`, `username`, `stud_id`, `stud_id_ex`, `banned`, `last_login`, `last_activity`, `date_created`, `forgot_exp`, `remember_time`, `remember_exp`, `verification_code`, `totp_secret`, `ip_address`) VALUES
(1, 'rhoy012@gmail.com', 'ec225039f1cb0c48ad528709e8e0184991e637d96db175f094b6b2037ec1a3c2', 'admin', '', '', 0, '2017-12-31 23:02:51', '2017-12-31 23:02:51', NULL, NULL, NULL, NULL, NULL, NULL, '127.0.0.1'),
(2, 'user2@gmail.com', '85331630fca2b67c234b6b57e7affc9403d62cf186989c71675956e3ccc2a20d', 'user2', '', '', 0, '2017-12-05 21:06:48', '2017-12-05 21:06:48', '2017-12-05 14:15:55', NULL, NULL, NULL, NULL, NULL, '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `aauth_user_to_group`
--

CREATE TABLE `aauth_user_to_group` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aauth_user_to_group`
--

INSERT INTO `aauth_user_to_group` (`user_id`, `group_id`) VALUES
(1, 1),
(1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `aauth_user_variables`
--

CREATE TABLE `aauth_user_variables` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `data_key` varchar(100) NOT NULL,
  `value` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `col_announcement`
--

CREATE TABLE `col_announcement` (
  `announcement_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `category` int(2) NOT NULL,
  `privacy` int(2) NOT NULL,
  `status` int(2) NOT NULL,
  `featured_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `col_category`
--

CREATE TABLE `col_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `group_type` int(1) NOT NULL,
  `date_added` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `col_category`
--

INSERT INTO `col_category` (`id`, `name`, `group_type`, `date_added`) VALUES
(1, 'Default', 0, ''),
(2, 'Software', 0, ''),
(3, 'Android', 0, ''),
(4, 'Computer', 0, ''),
(5, 'Operating System', 0, ''),
(6, 'Programing Language', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `col_images`
--

CREATE TABLE `col_images` (
  `id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `url` varchar(250) NOT NULL,
  `date_added` varchar(20) NOT NULL,
  `date_updated` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `col_template`
--

CREATE TABLE `col_template` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` int(1) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `col_template`
--

INSERT INTO `col_template` (`id`, `name`, `status`, `date_added`) VALUES
(1, 'default', 0, '0000-00-00 00:00:00'),
(2, 'admin', 0, '0000-00-00 00:00:00'),
(3, 'reflex', 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `more_group_type`
--

CREATE TABLE `more_group_type` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `group_type` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `more_group_type`
--

INSERT INTO `more_group_type` (`id`, `group_id`, `group_type`) VALUES
(1, 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `more_user_info`
--

CREATE TABLE `more_user_info` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `settings` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `date_added` varchar(16) NOT NULL,
  `date_updated` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `page_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` text NOT NULL,
  `pageview_id` varchar(255) NOT NULL,
  `page_type` varchar(50) NOT NULL,
  `page_url` varchar(255) NOT NULL,
  `date_presented` varchar(16) NOT NULL,
  `year_presented` varchar(4) NOT NULL,
  `date_created` varchar(20) NOT NULL,
  `date_updated` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`page_id`, `title`, `slug`, `pageview_id`, `page_type`, `page_url`, `date_presented`, `year_presented`, `date_created`, `date_updated`) VALUES
(1, 'kxflgkxflgk ', 'kxflgkxflgk-', '', '', '', '12', '2017', '', ''),
(2, 'kxfljsdkj', 'kxfljsdkj', '', '', '', '12', '2017', '', ''),
(3, ';ldfklgdflg', 'ldfklgdflg', '', '', '', '12', '2017', '', ''),
(4, 'kfjgjdfkljkl', 'kfjgjdfkljkl', '', '', '', '12', '2017', '', ''),
(5, 'KJDFKLGDJFGKJ', 'kjdfklgdjfgkj', '', '', '', '12', '2017', '', '');

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
  `timeUpdate` int(11) NOT NULL,
  `complete_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `page_category`
--

CREATE TABLE `page_category` (
  `category_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `page_contents`
--

CREATE TABLE `page_contents` (
  `content_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `value` longtext NOT NULL,
  `group_id` int(11) NOT NULL,
  `date_updated` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page_contents`
--

INSERT INTO `page_contents` (`content_id`, `name`, `value`, `group_id`, `date_updated`) VALUES
(1, 'content', 'lsdfklsdfl', 1, '2017-14-12'),
(2, 'content', 'jkkllll;k', 2, '2017-14-12'),
(3, 'content', 'lklklkl;kl;', 3, '2017-14-12'),
(4, 'content', 'JKJKJKLJ', 4, '2017-14-12'),
(5, 'content', 'JKLJKLJKLJ', 5, '2017-14-12');

-- --------------------------------------------------------

--
-- Table structure for table `page_perm_group`
--

CREATE TABLE `page_perm_group` (
  `id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `perm_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page_perm_group`
--

INSERT INTO `page_perm_group` (`id`, `page_id`, `group_id`, `perm_id`) VALUES
(1, 2, 4, 2),
(2, 3, 4, 2),
(3, 4, 4, 2),
(4, 5, 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `page_perm_user`
--

CREATE TABLE `page_perm_user` (
  `perm_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `page_tag`
--

CREATE TABLE `page_tag` (
  `id` int(11) NOT NULL,
  `keyword` text NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page_tag`
--

INSERT INTO `page_tag` (`id`, `keyword`, `group_id`) VALUES
(1, 'klkl', 1),
(2, 'kll;kl;', 2),
(3, 'klkl;kl;k', 3),
(4, 'JKJKLJLKJ', 4),
(5, 'KLJKLJKL', 5);

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
(1, 0, 'http%3A%2F%2Flocalhost%3A8000%2F%2Findex.php%2Fu%2Fmy_account', '', 1, '2017-12-30', '', ''),
(2, 0, 'http%3A%2F%2Flocalhost%3A8000%2F%2Findex.php%2Ft%2Fsearch%2Fvxvxcv', '', 1, '2017-12-30', '', ''),
(3, 0, 'http%3A%2F%2Flocalhost%3A8000%2F%2Findex.php%2Fthesis', '', 1, '2017-12-30', '', ''),
(4, 0, 'http%3A%2F%2Flocalhost%3A8000%2F%2Findex.php', '', 2, '2017-12-30', '', ''),
(5, 0, 'http%3A%2F%2Flocalhost%3A8000%2F%2Findex.php%2Fthesis', '', 1, '2017-12-31', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aauth_groups`
--
ALTER TABLE `aauth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aauth_group_to_group`
--
ALTER TABLE `aauth_group_to_group`
  ADD PRIMARY KEY (`group_id`,`subgroup_id`);

--
-- Indexes for table `aauth_login_attempts`
--
ALTER TABLE `aauth_login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aauth_perms`
--
ALTER TABLE `aauth_perms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aauth_perms_req`
--
ALTER TABLE `aauth_perms_req`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aauth_perm_to_group`
--
ALTER TABLE `aauth_perm_to_group`
  ADD PRIMARY KEY (`perm_id`,`group_id`);

--
-- Indexes for table `aauth_perm_to_user`
--
ALTER TABLE `aauth_perm_to_user`
  ADD PRIMARY KEY (`perm_id`,`user_id`);

--
-- Indexes for table `aauth_pms`
--
ALTER TABLE `aauth_pms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `full_index` (`id`,`sender_id`,`receiver_id`,`date_read`);

--
-- Indexes for table `aauth_users`
--
ALTER TABLE `aauth_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aauth_user_to_group`
--
ALTER TABLE `aauth_user_to_group`
  ADD PRIMARY KEY (`user_id`,`group_id`);

--
-- Indexes for table `aauth_user_variables`
--
ALTER TABLE `aauth_user_variables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_index` (`user_id`);

--
-- Indexes for table `col_announcement`
--
ALTER TABLE `col_announcement`
  ADD PRIMARY KEY (`announcement_id`);

--
-- Indexes for table `col_category`
--
ALTER TABLE `col_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `col_images`
--
ALTER TABLE `col_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `col_template`
--
ALTER TABLE `col_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `more_group_type`
--
ALTER TABLE `more_group_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `more_user_info`
--
ALTER TABLE `more_user_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`page_id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `pageview`
--
ALTER TABLE `pageview`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_contents`
--
ALTER TABLE `page_contents`
  ADD PRIMARY KEY (`content_id`);

--
-- Indexes for table `page_perm_group`
--
ALTER TABLE `page_perm_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_perm_user`
--
ALTER TABLE `page_perm_user`
  ADD PRIMARY KEY (`perm_id`,`user_id`);

--
-- Indexes for table `page_tag`
--
ALTER TABLE `page_tag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_visits`
--
ALTER TABLE `page_visits`
  ADD PRIMARY KEY (`visit_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aauth_groups`
--
ALTER TABLE `aauth_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `aauth_login_attempts`
--
ALTER TABLE `aauth_login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `aauth_perms`
--
ALTER TABLE `aauth_perms`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `aauth_perms_req`
--
ALTER TABLE `aauth_perms_req`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `aauth_pms`
--
ALTER TABLE `aauth_pms`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `aauth_users`
--
ALTER TABLE `aauth_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `aauth_user_variables`
--
ALTER TABLE `aauth_user_variables`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `col_announcement`
--
ALTER TABLE `col_announcement`
  MODIFY `announcement_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `col_category`
--
ALTER TABLE `col_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `col_images`
--
ALTER TABLE `col_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `col_template`
--
ALTER TABLE `col_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `more_group_type`
--
ALTER TABLE `more_group_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `more_user_info`
--
ALTER TABLE `more_user_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `pageview`
--
ALTER TABLE `pageview`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `page_contents`
--
ALTER TABLE `page_contents`
  MODIFY `content_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `page_perm_group`
--
ALTER TABLE `page_perm_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `page_tag`
--
ALTER TABLE `page_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `page_visits`
--
ALTER TABLE `page_visits`
  MODIFY `visit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

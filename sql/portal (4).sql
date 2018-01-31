-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2018 at 07:55 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portal`
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
(4, 'Personal', 'jdsfjsdklfjsdk'),
(5, 'Research', 'This is where i save all my personal file only.'),
(6, 'Instructions', 'My personal research save here'),
(7, 'Not Applicable', NULL),
(8, 'Accomplishment', NULL),
(9, 'Bachelor of Science in Computer Science', NULL);

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
(2, 'public', ''),
(3, 'students', NULL),
(4, 'instructors', NULL),
(5, 'staffs', NULL);

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
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
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
  `ip_address` text,
  `isdeleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aauth_users`
--

INSERT INTO `aauth_users` (`id`, `email`, `pass`, `username`, `fname`, `mname`, `lname`, `stud_id`, `stud_id_ex`, `banned`, `last_login`, `last_activity`, `date_created`, `forgot_exp`, `remember_time`, `remember_exp`, `verification_code`, `totp_secret`, `ip_address`, `isdeleted`) VALUES
(1, 'admin123456@gmail.com', 'ec225039f1cb0c48ad528709e8e0184991e637d96db175f094b6b2037ec1a3c2', 'admin', 'r', 't', 'g', '1', '', 0, '2018-01-21 01:55:26', '2018-01-21 01:55:26', NULL, NULL, NULL, NULL, NULL, NULL, 'fe80::fc1d:efca:2bb6:3c4', 0);

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
-- Table structure for table `col_member_type`
--

CREATE TABLE `col_member_type` (
  `id` int(11) NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `col_member_type`
--

INSERT INTO `col_member_type` (`id`, `description`) VALUES
(1, 'researcher'),
(2, 'examining panel'),
(3, 'examining committee'),
(4, 'adviser'),
(5, 'thesis expert');

-- --------------------------------------------------------

--
-- Table structure for table `col_names`
--

CREATE TABLE `col_names` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `role` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `col_names`
--

INSERT INTO `col_names` (`id`, `fullname`, `fname`, `mname`, `lname`, `role`) VALUES
(1, 'harold v rita', 'harold', 'v', 'rita', 4);

-- --------------------------------------------------------

--
-- Table structure for table `col_roles`
--

CREATE TABLE `col_roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `col_roles`
--

INSERT INTO `col_roles` (`id`, `role_name`) VALUES
(1, 'researcher'),
(2, 'panel'),
(3, 'committee'),
(4, 'expert'),
(5, 'others'),
(6, 'programmer'),
(7, 'documentation'),
(8, 'study leader'),
(9, 'staff'),
(10, 'member'),
(11, 'project leader'),
(12, 'research assistant'),
(13, 'assistant'),
(14, 'admin aide'),
(15, 'secretary'),
(16, 'teacher'),
(17, 'instructor'),
(18, 'professor'),
(19, 'assistant professor'),
(20, 'director'),
(21, 'chairperson'),
(22, 'president'),
(23, 'vice president'),
(24, 'dean'),
(25, 'student'),
(26, 'parent'),
(27, 'principal'),
(28, 'brother'),
(29, 'sister');

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
(1, 4, 2),
(2, 5, 2),
(3, 6, 2),
(4, 7, 3),
(5, 8, 2),
(6, 9, 3);

-- --------------------------------------------------------

--
-- Table structure for table `more_user_perms`
--

CREATE TABLE `more_user_perms` (
  `id` int(11) NOT NULL,
  `settings_name` varchar(100) NOT NULL,
  `access` int(1) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `more_user_perms`
--

INSERT INTO `more_user_perms` (`id`, `settings_name`, `access`, `user_id`) VALUES
(1, 'edit', 1, 1),
(2, 'delete', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `page_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` text NOT NULL,
  `posted_by` int(11) NOT NULL,
  `pageview_id` varchar(255) NOT NULL,
  `group_course` varchar(50) NOT NULL,
  `page_url` varchar(255) NOT NULL,
  `date_presented` varchar(20) NOT NULL,
  `year_presented` varchar(4) NOT NULL,
  `date_created` varchar(20) NOT NULL,
  `date_updated` varchar(20) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `post_by_course`
--

CREATE TABLE `post_by_course` (
  `id` int(11) NOT NULL,
  `course_group_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `post_category`
--

CREATE TABLE `post_category` (
  `id` int(11) NOT NULL,
  `category_group_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `post_content`
--

CREATE TABLE `post_content` (
  `content_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `value` longtext NOT NULL,
  `post_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `date_updated` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `post_download`
--

CREATE TABLE `post_download` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_downloaded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `download_id` int(11) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `post_file`
--

CREATE TABLE `post_file` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `newfilename` varchar(255) NOT NULL,
  `mtype` varchar(255) NOT NULL,
  `type` varchar(25) NOT NULL,
  `status` int(1) NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `post_names_roles`
--

CREATE TABLE `post_names_roles` (
  `post_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `names_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `post_others`
--

CREATE TABLE `post_others` (
  `id` int(11) NOT NULL,
  `names_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `position` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `post_other_information`
--

CREATE TABLE `post_other_information` (
  `id` int(11) NOT NULL,
  `name_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `group_type` varchar(50) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `post_tag`
--

CREATE TABLE `post_tag` (
  `id` int(11) NOT NULL,
  `keyword` text NOT NULL,
  `group_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `post_user_logs`
--

CREATE TABLE `post_user_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `page` text NOT NULL,
  `visit` int(11) NOT NULL,
  `ip` varchar(50) NOT NULL DEFAULT '0',
  `activity` varchar(255) NOT NULL,
  `date_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `post_view`
--

CREATE TABLE `post_view` (
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

--
-- Dumping data for table `post_view`
--

INSERT INTO `post_view` (`id`, `page`, `page_id`, `userip`, `year`, `agent`, `machine`, `browser`, `last_used_browser`, `counter`, `month`, `day`, `tday`, `timeUpdate`, `complete_date`) VALUES
(150, '-index.php-file-add', 0, 'fe80::fc1d:efca:2bb6:3c4', 2018, '', 'Windows 7', 'Chrome', '', 1, 1, 21, 'Sun', 1516472506, '2018-01-21');

-- --------------------------------------------------------

--
-- Table structure for table `post_visit`
--

CREATE TABLE `post_visit` (
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
-- Dumping data for table `post_visit`
--

INSERT INTO `post_visit` (`visit_id`, `page_id`, `page`, `country`, `count`, `date_visited`, `date_updated`, `month_year`) VALUES
(1, 0, '-index.php-dashboard', '', 1, '2018-01-20', '', ''),
(2, 0, '-index.php-file-add', '', 1, '2018-01-20', '', ''),
(3, 0, '-index.php-dashboard', '', 1, '2018-01-21', '', ''),
(4, 0, '-index.php-file', '', 1, '2018-01-21', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `pos_perm_user`
--

CREATE TABLE `pos_perm_user` (
  `post_id` int(11) NOT NULL,
  `perm_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Indexes for table `col_member_type`
--
ALTER TABLE `col_member_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `col_names`
--
ALTER TABLE `col_names`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `col_roles`
--
ALTER TABLE `col_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `more_group_type`
--
ALTER TABLE `more_group_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `more_user_perms`
--
ALTER TABLE `more_user_perms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `post_by_course`
--
ALTER TABLE `post_by_course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_category`
--
ALTER TABLE `post_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_content`
--
ALTER TABLE `post_content`
  ADD PRIMARY KEY (`content_id`);

--
-- Indexes for table `post_download`
--
ALTER TABLE `post_download`
  ADD PRIMARY KEY (`download_id`);

--
-- Indexes for table `post_file`
--
ALTER TABLE `post_file`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_other_information`
--
ALTER TABLE `post_other_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_tag`
--
ALTER TABLE `post_tag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_user_logs`
--
ALTER TABLE `post_user_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_view`
--
ALTER TABLE `post_view`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_visit`
--
ALTER TABLE `post_visit`
  ADD PRIMARY KEY (`visit_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aauth_groups`
--
ALTER TABLE `aauth_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `aauth_login_attempts`
--
ALTER TABLE `aauth_login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `aauth_perms`
--
ALTER TABLE `aauth_perms`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
-- AUTO_INCREMENT for table `col_member_type`
--
ALTER TABLE `col_member_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `col_names`
--
ALTER TABLE `col_names`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `col_roles`
--
ALTER TABLE `col_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `more_group_type`
--
ALTER TABLE `more_group_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `more_user_perms`
--
ALTER TABLE `more_user_perms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `post_by_course`
--
ALTER TABLE `post_by_course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `post_category`
--
ALTER TABLE `post_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `post_content`
--
ALTER TABLE `post_content`
  MODIFY `content_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `post_download`
--
ALTER TABLE `post_download`
  MODIFY `download_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `post_file`
--
ALTER TABLE `post_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `post_other_information`
--
ALTER TABLE `post_other_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `post_tag`
--
ALTER TABLE `post_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `post_user_logs`
--
ALTER TABLE `post_user_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `post_view`
--
ALTER TABLE `post_view`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;
--
-- AUTO_INCREMENT for table `post_visit`
--
ALTER TABLE `post_visit`
  MODIFY `visit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

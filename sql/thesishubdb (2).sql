-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2017 at 06:06 AM
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
-- Table structure for table `col_groups`
--

CREATE TABLE `col_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `definition` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `col_groups`
--

INSERT INTO `col_groups` (`id`, `name`, `definition`) VALUES
(1, 'Admin', 'Super Admin Group'),
(2, 'Public', 'Public Access Group'),
(3, 'Default', 'Default Access Group'),
(4, 'Bachelor of Science in Computer Science', 'Department of Information System Management Program'),
(5, 'Bachelor of Science in Office System Management', 'Department of Information System Management Program'),
(6, 'Bachelor of Science in Forestry', ''),
(7, 'Bachelor of Science in Agriculture Engineering', '');

-- --------------------------------------------------------

--
-- Table structure for table `col_group_to_group`
--

CREATE TABLE `col_group_to_group` (
  `group_id` int(11) UNSIGNED NOT NULL,
  `subgroup_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `col_login_attempts`
--

CREATE TABLE `col_login_attempts` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(39) DEFAULT '0',
  `timestamp` datetime DEFAULT NULL,
  `login_attempts` tinyint(2) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `col_login_attempts`
--

INSERT INTO `col_login_attempts` (`id`, `ip_address`, `timestamp`, `login_attempts`) VALUES
(1, '127.0.0.1', '2017-11-24 08:26:09', 2);

-- --------------------------------------------------------

--
-- Table structure for table `col_perms`
--

CREATE TABLE `col_perms` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `definition` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `col_perms`
--

INSERT INTO `col_perms` (`id`, `name`, `definition`) VALUES
(1, 'employee', ''),
(2, 'researcher', '');

-- --------------------------------------------------------

--
-- Table structure for table `col_perms_req`
--

CREATE TABLE `col_perms_req` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `perm_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `request_status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `col_perm_to_group`
--

CREATE TABLE `col_perm_to_group` (
  `perm_id` int(11) UNSIGNED NOT NULL,
  `group_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `col_perm_to_group`
--

INSERT INTO `col_perm_to_group` (`perm_id`, `group_id`) VALUES
(1, 4),
(2, 5),
(3, 6),
(4, 7);

-- --------------------------------------------------------

--
-- Table structure for table `col_perm_to_user`
--

CREATE TABLE `col_perm_to_user` (
  `perm_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `col_perm_to_user`
--

INSERT INTO `col_perm_to_user` (`perm_id`, `user_id`) VALUES
(1, 4),
(2, 0),
(3, 2),
(3, 4),
(4, 2),
(4, 4),
(4, 12);

-- --------------------------------------------------------

--
-- Table structure for table `col_pms`
--

CREATE TABLE `col_pms` (
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

--
-- Dumping data for table `col_pms`
--

INSERT INTO `col_pms` (`id`, `sender_id`, `receiver_id`, `title`, `message`, `date_sent`, `date_read`, `pm_deleted_sender`, `pm_deleted_receiver`) VALUES
(1, 1, 4, 'sdfsdfdsf', 'sdfsdf', '2017-11-26 20:08:34', NULL, NULL, NULL),
(2, 5, 1, 'zfmkl', 'kldfksl', '2017-11-26 20:19:29', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `col_users`
--

CREATE TABLE `col_users` (
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
-- Dumping data for table `col_users`
--

INSERT INTO `col_users` (`id`, `email`, `pass`, `username`, `stud_id`, `stud_id_ex`, `banned`, `last_login`, `last_activity`, `date_created`, `forgot_exp`, `remember_time`, `remember_exp`, `verification_code`, `totp_secret`, `ip_address`) VALUES
(1, 'rhoy012@gmail.com', 'ec225039f1cb0c48ad528709e8e0184991e637d96db175f094b6b2037ec1a3c2', 'admin', '', '', 0, '2017-11-26 21:45:07', '2017-11-26 21:45:07', NULL, NULL, NULL, NULL, NULL, NULL, '127.0.0.1'),
(2, 'user2@gmail.com', '316405b08e4bf3c5fc816bfb59d286d72d3de340f34723b43199de59c909fc84', 'user2', '', '', 0, '2017-11-26 19:34:27', '2017-11-26 19:34:27', '2017-11-25 21:34:31', NULL, NULL, NULL, NULL, NULL, '127.0.0.1'),
(3, 'rhoy01@gmail.com', '84472bc68a89eb3913c954eae846b903d14cd0d1fe10bdaa81952fc63958f90e', 'user1', '', '', 0, NULL, NULL, '2017-11-25 22:20:38', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'sflsdfl@ma.l', '5db682e0bcacc3cf077cb6739a7a80440ee7841b0f6afe6b54b1565e1a8cbe68', 'Guest1511698113', '', '', 0, NULL, NULL, '2017-11-26 20:08:33', NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'sdmfs@asdfsl.vvsdvfs', '680977abc765216a8c47ed5dbe383823e49ce245b1b6511bee5668f7df0e2569', 'Guest1511698769', '', '', 0, NULL, NULL, '2017-11-26 20:19:29', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `col_user_to_group`
--

CREATE TABLE `col_user_to_group` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `col_user_to_group`
--

INSERT INTO `col_user_to_group` (`user_id`, `group_id`) VALUES
(1, 1),
(1, 3),
(2, 3),
(3, 3),
(4, 3),
(5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `col_user_variables`
--

CREATE TABLE `col_user_variables` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `data_key` varchar(100) NOT NULL,
  `value` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `more_user_info`
--

CREATE TABLE `more_user_info` (
  `id` int(11) NOT NULL,
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
(26, 'sfkskd', 'sfkskd', '', '', '', '', '', '', ''),
(27, 'sfsdlfm,l,', 'sfsdlfml', '', '', '', '', '', '', ''),
(28, 'sdcsd', 'sdcsd', '', '', '', '', '', '', ''),
(29, 'vmdmv,m', 'vmdmvm', '', '', '', '', '', '', ''),
(30, 'kkfksdfmk', 'kkfksdfmk', '', '', '', '', '', '', ''),
(31, ',fmvdsfmsm', 'fmvdsfmsm', '', '', '', '', '', '', ''),
(32, 'f,lsf,l', 'flsfl', '', '', '', '', '', '', ''),
(33, 'kfmsdfm', 'kfmsdfm', '', '', '', '', '', '', ''),
(34, 'smfmfkm', 'smfmfkm', '', '', '', '', '', '', ''),
(35, 'dfkdfkg', 'dfkdfkg', '', '', '', '', '', '', ''),
(36, 'ksdfgksdfk', 'ksdfgksdfk', '', '', '', '', '', '', ''),
(37, 'sfksdfk', 'sfksdfk', '', '', '', '', '', '', ''),
(38, 'dfksdf dkfsd ', 'dfksdf-dkfsd-', '', '', '', '', '', '', ''),
(39, 'dkfsdfsd', 'dkfsdfsd', '', '', '', '', '', '', ''),
(40, 'ksdfksdfm', 'ksdfksdfm', '', '', '', '', '', '', ''),
(41, 'dslflsd', 'dslflsd', '', '', '', '', '', '', ''),
(42, 'dfkgdkfg', 'dfkgdkfg', '', '', '', '', '', '', ''),
(43, ',dflsdf,', 'dflsdf', '', '', '', '', '', '', ''),
(44, 'kdfsdkflk', 'kdfsdkflk', '', '', '', '', '', '', ''),
(45, 'ldfl', 'ldfl', '', '', '', '', '', '', ''),
(46, 'ldfgkdlfgk', 'ldfgkdlfgk', '', '', '', '', '', '', ''),
(47, 'fkajfjf jf dj', 'fkajfjf-jf-dj', '', '', '', '', '', '', ''),
(48, 'sfl,sdfl,', 'sflsdfl', '', '', '', '', '', '', ''),
(49, 'lfkgl', 'lfkgl', '', '', '', '', '', '', ''),
(50, 'kdfgmksdfgm', 'kdfgmksdfgm', '', '', '', '', '', '', ''),
(51, 'fglsdlf,sdlf,', 'fglsdlfsdlf', '', '', '', '', '', '', ''),
(52, 'mdfgmdfgm', 'mdfgmdfgm', '', '', '', '', '', '', ''),
(53, 'sdfmsdfm', 'sdfmsdfm', '', '', '', '', '', '', ''),
(54, 'sdfs,df', 'sdfsdf', '', '', '', '', '', '', ''),
(55, 'ddf,gm', 'ddfgm', '', '', '', '', '', '', ''),
(56, 'ksdflskfl', 'ksdflskfl', '', '', '', '', '', '', ''),
(57, 'SLDKSLFK,', 'sldkslfk', '', '', '', '', '', '', ''),
(58, ',dfgldf,g', 'dfgldfg', '', '', '', '', '', '', ''),
(59, 'Effects of Biogas effluent and Guano on the Early growth of Yemane (Gmelina arborea Rox) Seedlings', 'effects-of-biogas-effluent-and-guano-on-the-early-growth-of-yemane-gmelina-arborea-rox-seedlings', '', '', '', '', '', '', ''),
(60, 'ijsjfksdj', 'ijsjfksdj', '', '', '', '', '', '', '');

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

--
-- Dumping data for table `pageview`
--

INSERT INTO `pageview` (`id`, `page`, `page_id`, `userip`, `year`, `agent`, `machine`, `browser`, `last_used_browser`, `counter`, `month`, `day`, `tday`, `timeUpdate`, `complete_date`) VALUES
(110, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php', 0, '127.0.0.1', 2017, '', 'Windows 7', 'Chrome', '', 1, 11, 27, 'Mon', 1511742537, '2017-11-27'),
(111, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2F', 0, '127.0.0.1', 2017, '', 'Windows 7', 'Chrome', '', 1, 11, 30, 'Thu', 1512000457, '2017-11-30');

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
(1, 'content', 'the thijfrk jfksdfksdj dfgjkdfg', 1, '2017-15-11'),
(2, 'proponent', '[{"name":"ako si roy","position":"loverboy"},{"name":"siya si cel","position":"my love "}]', 1, ''),
(3, 'content', '<br>', 2, '2017-17-11'),
(4, 'proponent', '[{"name":"harold","position":"roy"}]', 2, ''),
(5, 'content', 'BECAUSE YOU AND I ARE MEANT TO BE BE', 3, '2017-17-11'),
(6, 'proponent', '[{"name":"ROY","position":"LOVERBOY"}]', 3, ''),
(7, 'content', ',fj sfjksdjfiej', 4, '2017-18-11'),
(8, 'content', 'jo iuji ih', 5, '2017-18-11'),
(9, 'content', 'jeiri ejrftiej', 6, '2017-18-11'),
(10, 'content', 'dfgdgd', 7, '2017-18-11'),
(11, 'clients', '["lkldfsdf","dsfklsdfks"]', 7, ''),
(12, 'content', 'lskf es', 8, '2017-18-11'),
(13, 'clients', '["kjfjsfkj","jskfjskjdf"]', 8, ''),
(14, 'content', 'bdkfgdk ldgfjdgk', 9, '2017-18-11'),
(15, 'clients', '["kdfkgdfgd","kkdfsf"]', 9, ''),
(16, 'proponent', '[{"name":"ggdf","position":"sdfdsfgde"}]', 0, ''),
(17, 'content', 'jkjkjkj', 10, '2017-18-11'),
(18, 'clients', '["eter ttert ert","ertet"]', 10, ''),
(19, 'proponent', '[{"name":"terter","position":"erter"}]', 0, ''),
(20, 'content', 'sdfksjf sdkjfskdjfk sdflk sekfksdfsdjfksdjf', 11, '2017-18-11'),
(21, 'clients', '["mis","san san lang"]', 11, ''),
(22, 'proponent', '[{"name":"me","position":"you"}]', 0, ''),
(23, 'content', 'sdmfksdmkflsd', 12, '2017-18-11'),
(24, 'content', 'skdfmksdmf', 13, '2017-18-11'),
(25, 'content', 'lklkdflskdf', 14, '2017-18-11'),
(26, 'content', 'sdmfksmdfsdk', 15, '2017-18-11'),
(27, 'content', 'rerget', 16, '2017-18-11'),
(28, 'content', 'm,wmfwk', 17, '2017-18-11'),
(29, 'clients', '[",ls,df,,","lf,lsd,f"]', 17, ''),
(30, 'content', 'erferferfer erferf', 18, '2017-18-11'),
(31, 'clients', '[",flf,l","ld,flsd,f"]', 18, ''),
(32, 'proponent', '[{"name":"hjjhh","position":"jsdjkfsdjf"},{"name":"sdmfsdfm","position":"fsdkfmsdkfm"}]', 18, ''),
(33, 'content', 'fkmwekfwekf', 19, '2017-18-11'),
(34, 'content', 'FKDMFKSDMF', 20, '2017-18-11'),
(35, 'clients', '["XMXVDMFGK","MKSDMKSDF"]', 20, ''),
(36, 'proponent', '[{"name":"DMFGKDMFG","position":"MKSDMFKSD"}]', 20, ''),
(37, 'content', 'lf,dlfg', 21, '2017-18-11'),
(38, 'clients', '["dfgdlfg","sfdlfsd"]', 21, ''),
(39, 'proponent', '[{"name":"gbmlhbm","position":"d,fldlfg"}]', 21, ''),
(40, 'content', 'hjksfhsf', 22, '2017-18-11'),
(41, 'content', 'rfgedrgtw<div><br></div>', 23, '2017-18-11'),
(42, 'clients', '{"name":"fnjsdfnk","address":"jsdkfjs"}', 23, ''),
(43, 'proponent', '[{"name":"sdfsd","position":"sfsdf"}]', 23, ''),
(44, 'content', 'jdfkgjkdfg', 24, '2017-18-11'),
(45, 'clients', '{"name":"dfgd","address":"jdifjgdij"}', 24, ''),
(46, 'proponent', '[{"name":"fkd","position":"dfgdfg"}]', 24, ''),
(47, 'content', 'ierfjerfj', 25, '2017-18-11'),
(48, 'clients', '{"name":"wefjiwej","address":"dsfjskdjfk"}', 25, ''),
(49, 'proponent', '[{"name":"kfjsdfjsk","position":"sdkjcfksd"}]', 0, ''),
(50, 'content', 'ldfklsdkflf', 26, '2017-18-11'),
(51, 'clients', '{"name":"sdksjkdfj","address":"skdfjsd"}', 26, ''),
(52, 'proponent', '[{"name":"ksjfksdj","position":"kasdjfsdjf"},{"name":"sdfmsdmfk","position":"ksldflsd"}]', 0, ''),
(53, 'content', 'lsdf,lsdlfsdlf', 27, '2017-18-11'),
(54, 'clients', '{"name":"ldfsdlfk","address":"lsdlfksdf"}', 27, ''),
(55, 'proponent', '[{"name":"kmfvsdvm","position":"msdkcfksdm"}]', 0, ''),
(56, 'content', 'sdfsdf', 28, '2017-19-11'),
(57, 'content', 'msdvmsdkf', 29, '2017-19-11'),
(58, 'content', 'sdmkvsdk', 30, '2017-19-11'),
(59, 'content', 'mksmdcsdc', 31, '2017-19-11'),
(60, 'content', 'df,vldemvf elv,lf', 32, '2017-19-11'),
(61, 'content', 'mdfkvmdkvm', 33, '2017-19-11'),
(62, 'content', 'sdmkvsmdkf', 34, '2017-19-11'),
(63, 'content', 'sgkdjkfgjsdgt', 35, '2017-20-11'),
(64, 'clients', '{"client":"olkfgldfkgl","address":"klsdfksldkf"}', 35, ''),
(65, 'proponent', '[{"name":"ksdfksdjfk","position":"jdskfjskdf"}]', 0, ''),
(66, 'content', '<br>', 36, '2017-20-11'),
(67, 'clients', '{"client":"skdfksdkfl","address":"sdkfsdf"}', 36, ''),
(68, 'proponent', '[{"name":"ksdfsd","position":"sdkfsd"}]', 0, ''),
(69, 'content', 'sdklfsdf', 37, '2017-20-11'),
(70, 'clients', '{"client":"ld,flsdflk","address":",ksdlf,sldf"}', 37, ''),
(71, 'proponent', '[{"name":"lsdflsdfk","position":",sdfls,df"}]', 0, ''),
(72, 'content', 'kflsdkf lsdfk sdlfk', 38, '2017-20-11'),
(73, 'clients', '{"client":",k,dflksdflk","address":"ksdlfksldf"}', 38, ''),
(74, 'proponent', '[{"name":"kldflsdkflk","position":"ksdlfskdlf"}]', 0, ''),
(75, 'college', '{"college":"3","course":"2"}', 0, ''),
(76, 'committee', '[{"committee":"ksdmfsdf","committeeposition":"ksdfmksdf"}]', 0, ''),
(77, 'content', 'sdkfsdf', 39, '2017-20-11'),
(78, 'clients', '{"client":"kdfsdf","address":"dlfklsdkf"}', 39, ''),
(79, 'proponent', '[{"name":"kfgkdlfgk","position":"ksdlfkds"}]', 0, ''),
(80, 'college', '{"college":"3","course":"2"}', 0, ''),
(81, 'committee', '[{"committee":"oksdfskdf","committeeposition":"ksdfksdl"}]', 0, ''),
(82, 'content', 'ksdfmksdmfsd', 40, '2017-20-11'),
(83, 'clients', '{"client":"sdflsdkfl","address":"kldsfksdf"}', 40, ''),
(84, 'proponent', '[{"name":"ldflsdfk","position":"l,sdlfsd"}]', 0, ''),
(85, 'college', '{"college":"3","course":"2"}', 0, ''),
(86, 'committee', '[{"committee":"l,dflvg,","committeeposition":",fvsd"}]', 0, ''),
(87, 'content', 'sdf,lsdf,', 41, '2017-20-11'),
(88, 'clients', '{"client":",flvgsdlf","address":"sd,flsd"}', 41, ''),
(89, 'proponent', '[{"name":"sdfl,s","position":"s,dfls"}]', 0, ''),
(90, 'college', '{"college":"3","course":"2"}', 0, ''),
(91, 'committee', '[{"committee":",lsdf,l","committeeposition":"sd,fls"}]', 0, ''),
(92, 'content', 'sdklflskf', 42, '2017-20-11'),
(93, 'clients', '{"client":"kdflksdlfk","address":"lsdfklsdkfsldfksdlkf"}', 42, ''),
(94, 'proponent', '[{"name":"ldfkgldflgk","position":"klsdfksdf"}]', 0, ''),
(95, 'college', '{"college":"3","course":"2"}', 0, ''),
(96, 'committee', '[{"committee":"ldf;sdf","committeeposition":"lsdfs"}]', 0, ''),
(97, 'panel', '[{"panel":"l,kdlfsl","position":",sdlf"}]', 0, ''),
(98, 'panel', '[{"panel":"l,kdlfsl","position":",sdlf"}]', 0, ''),
(99, 'panel', '[{"panel":"l,kdlfsl","position":",sdlf"}]', 0, ''),
(100, 'content', 's,dfl,sdlf', 43, '2017-20-11'),
(101, 'content', 'lsdkflskdf', 44, '2017-20-11'),
(102, 'content', 'lsdf,lsdf,', 45, '2017-20-11'),
(103, 'content', '<br>', 46, '2017-20-11'),
(104, 'panel', '[{"panel":"LFKGLDFKGL","position":"LSDFLSDF"}]', 0, ''),
(105, 'content', 'wjfi we weirjiwejir weirj iwejri wer qwiejri wefjedvnjsejdfio ejfsdjcsdjfvjui sedvfjsbfvj3', 47, '2017-21-11'),
(106, 'clients', '{"client":"mmsdmfm","address":"dmdfkmsdf"}', 47, ''),
(107, 'proponent', '[{"name":"sdmfkm","position":"mfkmsdfkmsksmfk fm dmfksdm"}]', 0, ''),
(108, 'college', '{"college":"2","course":"2"}', 0, ''),
(109, 'committee', '[{"committee":"efkwfj","committeeposition":"kfksf"}]', 0, ''),
(110, 'panel', '[{"panel":"dfmk","position":"mwkfmksdf"}]', 0, ''),
(111, 'content', 'sd,flsd,f', 48, '2017-21-11'),
(112, 'clients', '{"client":"dmfcvmd","address":",sdf,lsdf"}', 48, ''),
(113, 'proponent', '[{"name":"sdfl,sdlf,","position":",sdfl,sdfl"}]', 0, ''),
(114, 'college', '{"college":"2","course":"2"}', 0, ''),
(115, 'committee', '[{"committee":"l,sdlf,","committeeposition":"sdfmsd"}]', 0, ''),
(116, 'panel', '[{"panel":"sflsdfk","position":"sdlfsd,f"}]', 0, ''),
(117, 'content', 'smdkfmsd', 49, '2017-21-11'),
(118, 'clients', '{"client":"sdfkllwfm,","address":"sd,flsd,f"}', 49, ''),
(119, 'proponent', '[{"name":",fglds,gl,","position":",lsd,fsd"}]', 0, ''),
(120, 'college', '{"college":"2","course":"2"}', 0, ''),
(121, 'committee', '[{"committee":"lkdflsdlf,","committeeposition":"l,sdf,sldf,"}]', 0, ''),
(122, 'panel', '[{"panel":"sd,lf,sld,f","position":"lsd,fsld"}]', 0, ''),
(123, 'content', 'sdflsmdf,l', 50, '2017-21-11'),
(124, 'clients', '{"client":"kdfsdflk","address":"lsdflsd,f"}', 50, ''),
(125, 'proponent', '[{"name":"df,le,f,","position":",lf,sdlf"}]', 0, ''),
(126, 'college', '{"college":"2","course":"2"}', 0, ''),
(127, 'committee', '[{"committee":"dfgl,ldfgl","committeeposition":",df,lsd,flsd,f"}]', 0, ''),
(128, 'panel', '[{"panel":"lfsdfl,","position":",sdlf,sdf"}]', 0, ''),
(129, 'content', ',sdflsdlf,sdf', 51, '2017-21-11'),
(130, 'clients', '{"client":"sdflsdlfk","address":",lsdf,sld"}', 51, ''),
(131, 'proponent', '[{"name":"sdlf,sld,f","position":",sdlf,sd"}]', 0, ''),
(132, 'college', '{"college":"2","course":"2"}', 0, ''),
(133, 'committee', '[{"committee":"sdf,sdlf,","committeeposition":",sdfl,sd"}]', 0, ''),
(134, 'panels', '[{"name":"sdfsdlf,","position":",sdfl,sdf"}]', 0, ''),
(135, 'content', 'msdfsdmf', 52, '2017-21-11'),
(136, 'clients', '{"client":"kdflgsdlfg,","address":",lsdf,sldf,"}', 52, ''),
(137, 'proponent', '[{"name":",k,lfsldfkl","position":"ldf,sldf"}]', 0, ''),
(138, 'college', '{"college":"2","course":"2"}', 0, ''),
(139, 'committee', '[{"committee":"dslfsdlf,","committeeposition":",ksdlf,sdf"}]', 0, ''),
(140, 'panels', '[{"name":"sdfsdlf,","position":"l,sdfsldf,s"}]', 0, ''),
(141, 'content', 'msdfsmdf', 53, '2017-21-11'),
(142, 'clients', '{"client":"sdfsdfm","address":"msdkfmsdf"}', 53, ''),
(143, 'proponent', '[{"name":"sdfmsdfm","position":"dsmfksdmf"}]', 0, ''),
(144, 'college', '{"college":"2","course":"2"}', 0, ''),
(145, 'committee', '[{"committee":"sdfmsdkmf","committeeposition":"dsfmskdfm"}]', 0, ''),
(146, 'panels', '[{"name":"sdfsdmf","position":"msdfmsdf"}]', 0, ''),
(147, 'content', 'dm,f,sdmf', 54, '2017-21-11'),
(148, 'content', ',df,df', 55, '2017-21-11'),
(149, 'content', 'ksdfmsdmf', 56, '2017-21-11'),
(150, 'clients', '{"client":"sdflsdkl","address":"DCFLSD"}', 56, ''),
(151, 'proponent', '[{"name":"SDFLSDKLF","position":"SDLFSLDF"}]', 0, ''),
(152, 'content', 'lkldfklsdfksldfk', 57, '2017-21-11'),
(153, 'clients', '{"client":"ssdflsdkf","address":"sdlsdlfsdkf"}', 57, ''),
(154, 'proponent', '[{"name":"sfsldfk","position":"sdlfsldf"}]', 0, ''),
(155, 'content', 'sd,flsdf', 58, '2017-21-11'),
(156, 'clients', '{"client":"lsdfsldfk","address":",sdlf,sd"}', 58, ''),
(157, 'proponent', '[{"name":"sdlfsdlf,","position":",sdlf,sd"}]', 0, ''),
(158, 'college', '{"college":"2","course":"2"}', 0, ''),
(159, 'committee', '[{"committee":"lsd,flsdlf,","committeeposition":"dlf,lsdf"}]', 0, ''),
(160, 'content', 'The study was conducted at central Visayas State College of Agriculture Forestry and Technology (CVSCAFT) Main Campus, Zamora, Bilar, Bohol from August16 to Novemebr 16 2005 to determine...', 59, '2017-22-11'),
(161, 'content', 'ijsdifjsdifhsdfh', 60, '2017-24-11'),
(162, 'clients', '{"client":"jhjuhjh","address":"yuy"}', 60, '');

-- --------------------------------------------------------

--
-- Table structure for table `page_perm_group`
--

CREATE TABLE `page_perm_group` (
  `perm_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'her is ist, when is it, thesis', 1),
(2, 'super, man, batman, hero', 2),
(3, 'I LOVE YOU, HERE AND THERE FOREVER', 3),
(4, 'sdfjksj sdlfklsdkf sdkflsd', 4),
(5, 'jkjkjk', 5),
(6, 'jiiijij ijij', 6),
(7, 'sdfgsd', 7),
(8, 'klslfsdlfk', 8),
(9, 'kllklk', 9),
(10, 'ijkhjhjk', 10),
(11, 'hello', 11),
(12, ',smdf,m', 12),
(13, 'sdmfksdm', 13),
(14, 'klklkl', 14),
(15, 'm,ksdmf,sdm', 15),
(16, 'wwerfter', 16),
(17, 'sm,fmsd,fm', 17),
(18, 'ferferf', 18),
(19, 'dfweofkwoefowe', 19),
(20, 'mdkmskm', 20),
(21, ',sdlf,sdf', 21),
(22, 'hjhjhjk', 22),
(23, 'sdfs', 23),
(24, 'jksdfksd', 24),
(25, 'sdkfksjd, dfsdfvg, edfsdf', 25),
(26, 'skdflskd', 26),
(27, 'sld,sl,', 27),
(28, 'sdcfsdf', 28),
(29, 'mdsmvsdm', 29),
(30, 'smdksmk', 30),
(31, 'mlmm', 31),
(32, 'df,vl,sdfl', 32),
(33, 'mskdfmsdm`', 33),
(34, 'msdkfmskdm', 34),
(35, 'ksdsfjkj', 35),
(36, 'kdsflskdlfksd', 36),
(37, 'dfksldf', 37),
(38, 'ksdf ', 38),
(39, 'ksdfksdf', 39),
(40, 'sdkfsdkm', 40),
(41, 'sdlfs,dl', 41),
(42, 'klaskdlk', 42),
(43, 'fd,dsf,', 43),
(44, 'lkadeflskdl', 44),
(45, 'ldflsd,', 45),
(46, 'ksldfksdf', 46),
(47, 'ijfiejf c', 47),
(48, ',sdfl,sd', 48),
(49, 'sdkflsdk', 49),
(50, 'llsdflm', 50),
(51, ',sldf,sdlfl,', 51),
(52, 'msfmsdmf', 52),
(53, 'dfmsdfmsdfm', 53),
(54, ',dfsdf,', 54),
(55, 'dlf,sdf', 55),
(56, 'klfksldfk ldfvlsdf,', 56),
(57, 'sdfsldfl', 57),
(58, ',sldf,sld', 58),
(59, 'Effects, Biogas, Seedlings', 59),
(60, 'jih', 60);

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
(1, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2F', '', 3, '2017-11-19', '', ''),
(2, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php', '', 3, '2017-11-19', '', ''),
(3, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fabout', '', 1, '2017-11-19', '', ''),
(4, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fdashboard', '', 3, '2017-11-19', '', ''),
(5, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fpost%2Fcreate', '', 3, '2017-11-19', '', ''),
(6, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fcounter', '', 1, '2017-11-20', '', ''),
(7, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fpost%2Fview', '', 1, '2017-11-20', '', ''),
(8, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fdashboard%2Findex%2F2', '', 1, '2017-11-21', '', ''),
(9, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fdashboard%2Findex', '', 16, '2017-11-21', '', ''),
(10, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fdashboard%2Findex%2F4', '', 1, '2017-11-21', '', ''),
(11, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fdashboard%2Findex%2F6', '', 1, '2017-11-21', '', ''),
(12, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fdashboard%2Findex%2F8', '', 1, '2017-11-21', '', ''),
(13, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fdashboard%2Findex%2F10', '', 1, '2017-11-21', '', ''),
(14, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fdashboard%2Findex%2F12', '', 1, '2017-11-21', '', ''),
(15, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fdashboard%2Findex%2F16', '', 1, '2017-11-21', '', ''),
(16, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fdashboard%2Findex%2F20', '', 1, '2017-11-21', '', ''),
(17, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fdashboard%2Findex%2F24', '', 1, '2017-11-21', '', ''),
(18, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php', '', 1, '2017-11-21', '', ''),
(19, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fsearch', '', 1, '2017-11-22', '', ''),
(20, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fdashboard', '', 1, '2017-11-22', '', ''),
(21, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2F', '', 1, '2017-11-22', '', ''),
(22, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php', '', 4, '2017-11-22', '', ''),
(23, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fpost%2Fcreate', '', 1, '2017-11-22', '', ''),
(24, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fsearch%2Findex%2F20', '', 1, '2017-11-22', '', ''),
(25, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fsearch%2Findex%2F10', '', 1, '2017-11-22', '', ''),
(26, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fsearch%2Findex', '', 1, '2017-11-22', '', ''),
(27, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fsearch%2Findex%2F2', '', 1, '2017-11-22', '', ''),
(28, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fdashboard%2Findex%2F2', '', 1, '2017-11-22', '', ''),
(29, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fpost%2Fmore%2Fthis-is-the-new-thesos', '', 1, '2017-11-22', '', ''),
(30, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fsearch%2Fread%2Feffects-of-biogas-effluent-and-guano-on-the-early-growth-of-yemane-gmelina-arborea-rox-seedlings', '', 1, '2017-11-22', '', ''),
(31, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fie', '', 1, '2017-11-23', '', ''),
(32, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fpost%2Fcreate', '', 1, '2017-11-23', '', ''),
(33, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fcounter', '', 1, '2017-11-23', '', ''),
(34, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fsearch%2Findex%2F10', '', 2, '2017-11-23', '', ''),
(35, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fsearch%2Findex%2F5', '', 2, '2017-11-23', '', ''),
(36, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fsearch%2Fread%2Feffects-of-biogas-effluent-and-guano-on-the-early-growth-of-yemane-gmelina-arborea-rox-seedlings', '', 1, '2017-11-23', '', ''),
(37, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fsearch', '', 1, '2017-11-23', '', ''),
(38, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2F', '', 1, '2017-11-23', '', ''),
(39, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fdashboard', '', 1, '2017-11-23', '', ''),
(40, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fie%2Flogin%2Ferror', '', 1, '2017-11-23', '', ''),
(41, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fie%2Flogin%2Ferrorsdsdf', '', 1, '2017-11-23', '', ''),
(42, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fie%2Flogin%2FUser+does+not+exist', '', 1, '2017-11-23', '', ''),
(43, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fie%2Flogin%2FUser-does-not-exist', '', 1, '2017-11-23', '', ''),
(44, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fie%2Flogin%2FE-mail-Address-and-Password-do-not-match.', '', 1, '2017-11-23', '', ''),
(45, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fie%2Flogin%2FYou-have-exceeded-your-login-attempts-your-account-has-now-been-locked', '', 1, '2017-11-23', '', ''),
(46, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fie%2Flogin%2FE-mail-Address-and-Password-do-not-match', '', 1, '2017-11-23', '', ''),
(47, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php', '', 3, '2017-11-23', '', ''),
(48, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fabout', '', 1, '2017-11-23', '', ''),
(49, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fcontact', '', 1, '2017-11-23', '', ''),
(50, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fsearch%2Findex%2F20', '', 1, '2017-11-23', '', ''),
(51, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fsearch%2Findex', '', 1, '2017-11-23', '', ''),
(52, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fsettings', '', 1, '2017-11-23', '', ''),
(53, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fsearch', '', 1, '2017-11-24', '', ''),
(54, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fpermission', '', 1, '2017-11-24', '', ''),
(55, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php', '', 3, '2017-11-24', '', ''),
(56, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fdashboard', '', 1, '2017-11-24', '', ''),
(57, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2F', '', 1, '2017-11-24', '', ''),
(58, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fusers', '', 1, '2017-11-23', '', ''),
(59, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fsignup', '', 1, '2017-11-25', '', ''),
(60, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fusers', '', 1, '2017-11-25', '', ''),
(61, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fdashboard', '', 1, '2017-11-25', '', ''),
(62, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2F', '', 1, '2017-11-25', '', ''),
(63, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fsearch', '', 1, '2017-11-25', '', ''),
(64, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fsearch%2Findex%2F5', '', 1, '2017-11-24', '', ''),
(65, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fsearch%2Findex', '', 1, '2017-11-24', '', ''),
(66, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fpost%2Fcreate', '', 1, '2017-11-24', '', ''),
(67, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fgroup', '', 2, '2017-11-24', '', ''),
(68, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fsearch', '', 2, '2017-11-26', '', ''),
(69, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fsearch%2Fread%2Fgrecilda-my-love', '', 1, '2017-11-26', '', ''),
(70, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fdashboard', '', 1, '2017-11-26', '', ''),
(71, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fpost%2Fcreate', '', 1, '2017-11-26', '', ''),
(72, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fgroup', '', 1, '2017-11-26', '', ''),
(73, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fgroup%2Fcreate', '', 1, '2017-11-26', '', ''),
(74, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fsignup', '', 1, '2017-11-26', '', ''),
(75, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fpost%2Fread%2Fdfsdf', '', 1, '2017-11-26', '', ''),
(76, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fpost%2Fread%2Fgjdfkgk', '', 1, '2017-11-26', '', ''),
(77, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fpost%2Fread%2Fjf-sjdfjsjfj', '', 1, '2017-11-26', '', ''),
(78, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php', '', 2, '2017-11-26', '', ''),
(79, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fpost%2Fread%2Fsfkskd', '', 1, '2017-11-26', '', ''),
(80, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fusers', '', 1, '2017-11-26', '', ''),
(81, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fpermission', '', 1, '2017-11-26', '', ''),
(82, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2F', '', 1, '2017-11-26', '', ''),
(83, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fcontact', '', 1, '2017-11-26', '', ''),
(84, 0, 'http%3A%2F%2Fwww.thesis.hub%3A8000%2F%2Findex.php%2Fabout', '', 1, '2017-11-26', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `col_groups`
--
ALTER TABLE `col_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `col_group_to_group`
--
ALTER TABLE `col_group_to_group`
  ADD PRIMARY KEY (`group_id`,`subgroup_id`);

--
-- Indexes for table `col_login_attempts`
--
ALTER TABLE `col_login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `col_perms`
--
ALTER TABLE `col_perms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `col_perms_req`
--
ALTER TABLE `col_perms_req`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `col_perm_to_group`
--
ALTER TABLE `col_perm_to_group`
  ADD PRIMARY KEY (`perm_id`,`group_id`);

--
-- Indexes for table `col_perm_to_user`
--
ALTER TABLE `col_perm_to_user`
  ADD PRIMARY KEY (`perm_id`,`user_id`);

--
-- Indexes for table `col_pms`
--
ALTER TABLE `col_pms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `full_index` (`id`,`sender_id`,`receiver_id`,`date_read`);

--
-- Indexes for table `col_users`
--
ALTER TABLE `col_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `col_user_to_group`
--
ALTER TABLE `col_user_to_group`
  ADD PRIMARY KEY (`user_id`,`group_id`);

--
-- Indexes for table `col_user_variables`
--
ALTER TABLE `col_user_variables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_index` (`user_id`);

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
  ADD PRIMARY KEY (`perm_id`,`group_id`);

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
-- AUTO_INCREMENT for table `col_groups`
--
ALTER TABLE `col_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `col_login_attempts`
--
ALTER TABLE `col_login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `col_perms`
--
ALTER TABLE `col_perms`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `col_perms_req`
--
ALTER TABLE `col_perms_req`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `col_pms`
--
ALTER TABLE `col_pms`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `col_users`
--
ALTER TABLE `col_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `col_user_variables`
--
ALTER TABLE `col_user_variables`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `more_user_info`
--
ALTER TABLE `more_user_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `pageview`
--
ALTER TABLE `pageview`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;
--
-- AUTO_INCREMENT for table `page_contents`
--
ALTER TABLE `page_contents`
  MODIFY `content_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;
--
-- AUTO_INCREMENT for table `page_tag`
--
ALTER TABLE `page_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `page_visits`
--
ALTER TABLE `page_visits`
  MODIFY `visit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

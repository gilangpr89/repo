-- phpMyAdmin SQL Dump
-- version 3.5.8.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 15, 2013 at 03:15 AM
-- Server version: 5.5.31-0ubuntu0.13.04.1
-- PHP Version: 5.3.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ihc_training`
--

-- --------------------------------------------------------

--
-- Table structure for table `GROUPS`
--

CREATE TABLE IF NOT EXISTS `GROUPS` (
  `GROUP_ID` int(19) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(40) NOT NULL,
  `ACTIVE` int(1) NOT NULL DEFAULT '1',
  `CREATED_DATE` datetime NOT NULL,
  `MODIFIED_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`GROUP_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `GROUPS`
--

INSERT INTO `GROUPS` (`GROUP_ID`, `NAME`, `ACTIVE`, `CREATED_DATE`, `MODIFIED_DATE`) VALUES
(28, 'Administrator', 1, '2013-07-02 02:37:37', '2013-07-11 09:00:27');

-- --------------------------------------------------------

--
-- Table structure for table `GROUP_USER`
--

CREATE TABLE IF NOT EXISTS `GROUP_USER` (
  `GROUP_ID` int(19) NOT NULL,
  `USER_ID` int(19) NOT NULL,
  PRIMARY KEY (`GROUP_ID`,`USER_ID`),
  KEY `USER_ID` (`USER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `GROUP_USER`
--

INSERT INTO `GROUP_USER` (`GROUP_ID`, `USER_ID`) VALUES
(28, 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `GROUP_USER_VIEW`
--
CREATE TABLE IF NOT EXISTS `GROUP_USER_VIEW` (
`GROUP_ID` int(19)
,`NAME` varchar(40)
,`USER_ID` int(19)
,`USERNAME` varchar(40)
,`EMAIL` varchar(255)
,`ACTIVE` int(1)
,`IP_ADDRESS` varchar(15)
,`LAST_IP_ADDRESS` varchar(15)
,`LAST_LOGIN` datetime
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `GROUP_VIEW`
--
CREATE TABLE IF NOT EXISTS `GROUP_VIEW` (
`GROUP_ID` int(19)
,`NAME` varchar(40)
,`TOTAL_USER` bigint(21)
,`ACTIVE` int(1)
,`CREATED_DATE` datetime
,`MODIFIED_DATE` timestamp
);
-- --------------------------------------------------------

--
-- Table structure for table `MENUS`
--

CREATE TABLE IF NOT EXISTS `MENUS` (
  `MENU_ID` int(19) NOT NULL AUTO_INCREMENT,
  `MENU_TITLE` varchar(40) NOT NULL,
  `ACTIVE` int(1) NOT NULL DEFAULT '1',
  `INDEX` int(2) NOT NULL DEFAULT '0',
  `ACTION` varchar(255) DEFAULT NULL,
  `TYPE` varchar(10) NOT NULL,
  `ICONCLS` varchar(50) NOT NULL,
  `PARENT_ID` int(19) NOT NULL DEFAULT '0',
  `CREATED_DATE` datetime NOT NULL,
  `MODIFIED_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`MENU_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `MENUS`
--

INSERT INTO `MENUS` (`MENU_ID`, `MENU_TITLE`, `ACTIVE`, `INDEX`, `ACTION`, `TYPE`, `ICONCLS`, `PARENT_ID`, `CREATED_DATE`, `MODIFIED_DATE`) VALUES
(1, 'Administrator', 1, 0, NULL, 'MENU', '', 0, '2013-06-28 14:54:31', '2013-07-01 06:21:11'),
(2, 'Groups', 1, 0, 'onGroupsClicked', 'SUBMENU', '', 1, '2013-06-28 14:55:08', '2013-07-01 04:10:31'),
(3, 'Users', 1, 1, 'onUsersClicked', 'SUBMENU', '', 1, '2013-06-28 14:55:32', '2013-07-01 04:10:37'),
(4, 'Add New Group', 1, 0, 'create', 'ACTION', 'icon-accept', 2, '2013-07-01 11:11:17', '2013-07-14 16:08:20'),
(5, 'Update Group', 1, 1, 'update', 'ACTION', 'icon-pencil', 2, '2013-07-01 11:11:42', '2013-07-01 04:23:08'),
(6, 'Delete Group', 1, 2, 'delete', 'ACTION', 'icon-cross', 2, '2013-07-01 11:12:03', '2013-07-01 06:31:13'),
(7, 'Manage Users', 1, 3, 'manage', 'ACTION', 'icon-detail', 2, '2013-07-01 11:12:26', '2013-07-14 16:10:13'),
(8, 'Search Groups', 1, 5, 'search', 'ACTION', 'icon-search', 2, '2013-07-01 11:12:44', '2013-07-14 16:10:40'),
(9, 'Menu Management', 0, 2, NULL, 'SUBMENU', '', 1, '2013-07-10 18:15:07', '2013-07-14 16:04:29'),
(10, 'Add New user', 1, 0, 'add', 'ACTION', 'icon-accept', 3, '2013-07-11 14:37:16', '2013-07-11 07:37:16'),
(11, 'Update User', 1, 1, 'update', 'ACTION', 'icon-pencil', 3, '2013-07-11 14:38:43', '2013-07-11 07:38:43'),
(12, 'Delete User', 1, 2, 'delete', 'ACTION', 'icon-cross', 3, '2013-07-11 14:38:43', '2013-07-11 07:38:43'),
(13, 'Search User', 1, 3, 'search', 'ACTION', 'icon-search', 3, '2013-07-11 14:38:43', '2013-07-11 07:38:43'),
(14, 'Manage Privilege', 1, 4, 'privilege', 'ACTION', 'icon-lock-open', 2, '2013-07-14 23:11:03', '2013-07-14 16:11:39');

-- --------------------------------------------------------

--
-- Table structure for table `MS_AREA_LEVELS`
--

CREATE TABLE IF NOT EXISTS `MS_AREA_LEVELS` (
  `ID` int(19) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(100) NOT NULL,
  `TYPE` varchar(100) NOT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `MODIFIED_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `MS_BENEFICIARIES`
--

CREATE TABLE IF NOT EXISTS `MS_BENEFICIARIES` (
  `ID` int(19) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(100) NOT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `MODIFIED_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `MS_CITY`
--

CREATE TABLE IF NOT EXISTS `MS_CITY` (
  `ID` int(19) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(100) NOT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `MODIFIED_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `MS_COUNTRY`
--

CREATE TABLE IF NOT EXISTS `MS_COUNTRY` (
  `ID` int(19) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(100) NOT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `MODIFIED_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `MS_FUNDING_SOURCES`
--

CREATE TABLE IF NOT EXISTS `MS_FUNDING_SOURCES` (
  `ID` int(19) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(100) NOT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `MODIFIED_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `MS_ORGANIZATIONS`
--

CREATE TABLE IF NOT EXISTS `MS_ORGANIZATIONS` (
  `ID` int(19) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(100) NOT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `MODIFIED_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `MS_PARTICIPANTS`
--

CREATE TABLE IF NOT EXISTS `MS_PARTICIPANTS` (
  `ID` int(19) NOT NULL AUTO_INCREMENT,
  `FNAME` varchar(100) NOT NULL,
  `MNAME` varchar(100) DEFAULT NULL,
  `LNAME` varchar(100) DEFAULT NULL,
  `SNAME` varchar(100) DEFAULT NULL,
  `GENDER` varchar(100) NOT NULL,
  `BDATE` date NOT NULL,
  `MOBILE_NO` varchar(20) NOT NULL,
  `PHONE_NO` varchar(20) DEFAULT NULL,
  `EMAIL1` varchar(100) DEFAULT NULL,
  `EMAIL2` varchar(100) DEFAULT NULL,
  `FB` varchar(100) DEFAULT NULL,
  `TWITTER` varchar(100) DEFAULT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `MODIFIED_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `MS_POSITIONS`
--

CREATE TABLE IF NOT EXISTS `MS_POSITIONS` (
  `ID` int(19) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(100) NOT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `MODIFIED_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `MS_PROVINCE`
--

CREATE TABLE IF NOT EXISTS `MS_PROVINCE` (
  `ID` int(19) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(100) NOT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `MODIFIED_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `MS_ROLES`
--

CREATE TABLE IF NOT EXISTS `MS_ROLES` (
  `ID` int(19) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(100) NOT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `MODIFIED_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `MS_TRAINERS`
--

CREATE TABLE IF NOT EXISTS `MS_TRAINERS` (
  `ID` int(19) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(100) NOT NULL,
  `NICKNAME` varchar(100) DEFAULT NULL,
  `GENDER` varchar(100) NOT NULL,
  `ADDRESS` text,
  `BDATE` date DEFAULT NULL,
  `MOBILE_NO` varchar(20) NOT NULL,
  `PHONE_NO` varchar(20) DEFAULT NULL,
  `EMAIL1` varchar(100) DEFAULT NULL,
  `EMAIL2` varchar(100) DEFAULT NULL,
  `FB` varchar(100) DEFAULT NULL,
  `TWITTER` varchar(100) DEFAULT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `MODIFIED_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `MS_TRAININGS`
--

CREATE TABLE IF NOT EXISTS `MS_TRAININGS` (
  `ID` int(19) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(100) NOT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `MODIFIED_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `MS_VENUES`
--

CREATE TABLE IF NOT EXISTS `MS_VENUES` (
  `ID` int(19) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(100) NOT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `MODIFIED_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `PRIVILEGES`
--

CREATE TABLE IF NOT EXISTS `PRIVILEGES` (
  `GROUP_ID` int(19) NOT NULL,
  `USER_ID` int(19) NOT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `MODIFIED_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`GROUP_ID`,`USER_ID`),
  KEY `USER_ID` (`USER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TR_TRAININGS`
--

CREATE TABLE IF NOT EXISTS `TR_TRAININGS` (
  `ID` int(19) NOT NULL AUTO_INCREMENT,
  `USER_ID` int(19) DEFAULT NULL,
  `TRAINING_ID` int(19) NOT NULL,
  `AREA_LEVEL_ID` int(19) NOT NULL,
  `BENEFICIARIES_ID` int(19) NOT NULL,
  `FUNDING_SOURCE_ID` int(19) NOT NULL,
  `VENUE_ID` int(19) NOT NULL,
  `ORGANIZATION_ID` int(19) NOT NULL,
  `SDATE` date NOT NULL,
  `EDATE` date NOT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `MODIFIED_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  KEY `TRAINING_ID` (`TRAINING_ID`),
  KEY `AREA_LEVEL_ID` (`AREA_LEVEL_ID`),
  KEY `BENEFICIARIES_ID` (`BENEFICIARIES_ID`),
  KEY `FUNDING_SOURCE_ID` (`FUNDING_SOURCE_ID`),
  KEY `VENUE_ID` (`VENUE_ID`),
  KEY `ORGANIZATION_ID` (`ORGANIZATION_ID`),
  KEY `fk_TR_TRAINING_USER_ID` (`USER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `TR_TRAINING_MODULES`
--

CREATE TABLE IF NOT EXISTS `TR_TRAINING_MODULES` (
  `ID` int(19) NOT NULL AUTO_INCREMENT,
  `TRAINING_ID` int(19) NOT NULL,
  `FILE_NAME` varchar(255) NOT NULL,
  `FILE_SIZE` int(11) NOT NULL,
  `FILE_MIME_TYPE` varchar(20) NOT NULL,
  `FILE_PATH` varchar(255) NOT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `MODIFIED_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  KEY `TRAINING_ID` (`TRAINING_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `TR_TRAINING_OUTPUT`
--

CREATE TABLE IF NOT EXISTS `TR_TRAINING_OUTPUT` (
  `ID` int(19) NOT NULL AUTO_INCREMENT,
  `TRAINING_ID` int(19) NOT NULL,
  `PARTICIPANT_ID` int(19) NOT NULL,
  `ORGANIZATION_ID` int(19) NOT NULL,
  `FILE_NAME` varchar(255) NOT NULL,
  `FILE_SIZE` int(11) NOT NULL,
  `FILE_MIME_TYPE` varchar(20) NOT NULL,
  `FILE_PATH` varchar(255) NOT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `MODIFIED_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  KEY `TRAINING_ID` (`TRAINING_ID`),
  KEY `PARTICIPANT_ID` (`PARTICIPANT_ID`),
  KEY `ORGANIZATION_ID` (`ORGANIZATION_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `TR_TRAINING_PARTICIPANTS`
--

CREATE TABLE IF NOT EXISTS `TR_TRAINING_PARTICIPANTS` (
  `ID` int(19) NOT NULL AUTO_INCREMENT,
  `TRAINING_ID` int(19) NOT NULL,
  `PARTICIPANT_ID` int(19) NOT NULL,
  `ORGANIZATION_ID` int(19) NOT NULL,
  `POSITION_ID` int(19) NOT NULL,
  `PRE_TEST` float DEFAULT NULL,
  `POST_TEST` float DEFAULT NULL,
  `DIFF` float DEFAULT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `MODIFIED_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  KEY `TRAINING_ID` (`TRAINING_ID`),
  KEY `PARTICIPANT_ID` (`PARTICIPANT_ID`),
  KEY `ORGANIZATION_ID` (`ORGANIZATION_ID`),
  KEY `POSITION_ID` (`POSITION_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `TR_TRAINING_SUPPORTING_DOCUMENTS`
--

CREATE TABLE IF NOT EXISTS `TR_TRAINING_SUPPORTING_DOCUMENTS` (
  `ID` int(19) NOT NULL AUTO_INCREMENT,
  `TRAINING_ID` int(19) NOT NULL,
  `FILE_NAME` varchar(255) NOT NULL,
  `FILE_SIZE` int(11) NOT NULL,
  `FILE_MIME_TYPE` varchar(20) NOT NULL,
  `FILE_PATH` varchar(255) NOT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `MODIFIED_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  KEY `TRAINING_ID` (`TRAINING_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `TR_TRAINING_TRAINERS`
--

CREATE TABLE IF NOT EXISTS `TR_TRAINING_TRAINERS` (
  `ID` int(19) NOT NULL AUTO_INCREMENT,
  `TRAINING_ID` int(19) NOT NULL,
  `TRAINER_ID` int(19) NOT NULL,
  `ROLE_ID` int(19) NOT NULL,
  `CITY_ID` int(19) NOT NULL,
  `PROVINCE_ID` int(19) NOT NULL,
  `COUNTRY_ID` int(19) NOT NULL,
  `CV_NAME` varchar(255) DEFAULT NULL,
  `CV_PATH` varchar(255) DEFAULT NULL,
  `CV_MIME_TYPE` varchar(20) DEFAULT NULL,
  `CV_SIZE` int(11) DEFAULT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `MODIFIED_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  KEY `TRAINING_ID` (`TRAINING_ID`),
  KEY `TRAINER_ID` (`TRAINER_ID`),
  KEY `ROLE_ID` (`ROLE_ID`),
  KEY `CITY_ID` (`CITY_ID`),
  KEY `PROVINCE_ID` (`PROVINCE_ID`),
  KEY `COUNTRY_ID` (`COUNTRY_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `USERS`
--

CREATE TABLE IF NOT EXISTS `USERS` (
  `USER_ID` int(19) NOT NULL AUTO_INCREMENT,
  `USERNAME` varchar(40) NOT NULL,
  `PASSWORD` varchar(40) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `ACTIVE` int(1) NOT NULL DEFAULT '1',
  `IP_ADDRESS` varchar(15) DEFAULT NULL,
  `LAST_IP_ADDRESS` varchar(15) DEFAULT NULL,
  `LAST_LOGIN` datetime DEFAULT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `MODIFIED_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`USER_ID`),
  UNIQUE KEY `USERNAME` (`USERNAME`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `USERS`
--

INSERT INTO `USERS` (`USER_ID`, `USERNAME`, `PASSWORD`, `EMAIL`, `ACTIVE`, `IP_ADDRESS`, `LAST_IP_ADDRESS`, `LAST_LOGIN`, `CREATED_DATE`, `MODIFIED_DATE`) VALUES
(1, 'admin', '7b3311da916a2454a0c47a6aa2e0c69279a6b85e', 'admin@ihp.com', 1, '127.0.0.1', '127.0.0.1', '2013-07-15 01:40:15', '2013-06-28 15:49:48', '2013-07-14 18:40:15'),
(2, 'admin2', '7b3311da916a2454a0c47a6aa2e0c69279a6b85e', 'admin2@ihc.com', 1, '127.0.0.1', '127.0.0.1', '2013-06-28 15:52:39', '2013-06-28 15:52:39', '2013-06-28 08:52:39'),
(3, 'gilangpr89', 'bedd3253c3b3914419aa0c1e27114d4d43e0e253', 'gilangpr89@yahoo.com', 1, '127.0.0.1', '127.0.0.1', '2013-07-15 02:25:28', '2013-07-15 02:25:17', '2013-07-14 19:25:28');

-- --------------------------------------------------------

--
-- Structure for view `GROUP_USER_VIEW`
--
DROP TABLE IF EXISTS `GROUP_USER_VIEW`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `GROUP_USER_VIEW` AS select `grp`.`GROUP_ID` AS `GROUP_ID`,`grp`.`NAME` AS `NAME`,`usr`.`USER_ID` AS `USER_ID`,`usr`.`USERNAME` AS `USERNAME`,`usr`.`EMAIL` AS `EMAIL`,`usr`.`ACTIVE` AS `ACTIVE`,`usr`.`IP_ADDRESS` AS `IP_ADDRESS`,`usr`.`LAST_IP_ADDRESS` AS `LAST_IP_ADDRESS`,`usr`.`LAST_LOGIN` AS `LAST_LOGIN` from ((`GROUP_USER` `grpusr` join `GROUPS` `grp`) join `USERS` `usr`) where ((`grpusr`.`GROUP_ID` = `grp`.`GROUP_ID`) and (`grpusr`.`USER_ID` = `usr`.`USER_ID`));

-- --------------------------------------------------------

--
-- Structure for view `GROUP_VIEW`
--
DROP TABLE IF EXISTS `GROUP_VIEW`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `GROUP_VIEW` AS select `a`.`GROUP_ID` AS `GROUP_ID`,`a`.`NAME` AS `NAME`,count(`b`.`USER_ID`) AS `TOTAL_USER`,`a`.`ACTIVE` AS `ACTIVE`,`a`.`CREATED_DATE` AS `CREATED_DATE`,`a`.`MODIFIED_DATE` AS `MODIFIED_DATE` from (`GROUPS` `a` left join `GROUP_USER` `b` on((`a`.`GROUP_ID` = `b`.`GROUP_ID`))) group by `a`.`GROUP_ID`;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `GROUP_USER`
--
ALTER TABLE `GROUP_USER`
  ADD CONSTRAINT `GROUP_USER_ibfk_1` FOREIGN KEY (`GROUP_ID`) REFERENCES `GROUPS` (`GROUP_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `GROUP_USER_ibfk_2` FOREIGN KEY (`USER_ID`) REFERENCES `USERS` (`USER_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `PRIVILEGES`
--
ALTER TABLE `PRIVILEGES`
  ADD CONSTRAINT `PRIVILEGES_ibfk_1` FOREIGN KEY (`GROUP_ID`) REFERENCES `GROUPS` (`GROUP_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `PRIVILEGES_ibfk_2` FOREIGN KEY (`USER_ID`) REFERENCES `USERS` (`USER_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `TR_TRAININGS`
--
ALTER TABLE `TR_TRAININGS`
  ADD CONSTRAINT `fk_TR_TRAINING_USER_ID` FOREIGN KEY (`USER_ID`) REFERENCES `USERS` (`USER_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `TR_TRAININGS_ibfk_1` FOREIGN KEY (`TRAINING_ID`) REFERENCES `MS_TRAININGS` (`ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `TR_TRAININGS_ibfk_2` FOREIGN KEY (`AREA_LEVEL_ID`) REFERENCES `MS_AREA_LEVELS` (`ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `TR_TRAININGS_ibfk_3` FOREIGN KEY (`BENEFICIARIES_ID`) REFERENCES `MS_BENEFICIARIES` (`ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `TR_TRAININGS_ibfk_4` FOREIGN KEY (`FUNDING_SOURCE_ID`) REFERENCES `MS_FUNDING_SOURCES` (`ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `TR_TRAININGS_ibfk_5` FOREIGN KEY (`VENUE_ID`) REFERENCES `MS_VENUES` (`ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `TR_TRAININGS_ibfk_6` FOREIGN KEY (`ORGANIZATION_ID`) REFERENCES `MS_ORGANIZATIONS` (`ID`) ON UPDATE CASCADE;

--
-- Constraints for table `TR_TRAINING_MODULES`
--
ALTER TABLE `TR_TRAINING_MODULES`
  ADD CONSTRAINT `TR_TRAINING_MODULES_ibfk_1` FOREIGN KEY (`TRAINING_ID`) REFERENCES `TR_TRAININGS` (`ID`) ON UPDATE CASCADE;

--
-- Constraints for table `TR_TRAINING_OUTPUT`
--
ALTER TABLE `TR_TRAINING_OUTPUT`
  ADD CONSTRAINT `TR_TRAINING_OUTPUT_ibfk_1` FOREIGN KEY (`TRAINING_ID`) REFERENCES `TR_TRAININGS` (`ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `TR_TRAINING_OUTPUT_ibfk_2` FOREIGN KEY (`PARTICIPANT_ID`) REFERENCES `MS_PARTICIPANTS` (`ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `TR_TRAINING_OUTPUT_ibfk_3` FOREIGN KEY (`ORGANIZATION_ID`) REFERENCES `MS_ORGANIZATIONS` (`ID`) ON UPDATE CASCADE;

--
-- Constraints for table `TR_TRAINING_PARTICIPANTS`
--
ALTER TABLE `TR_TRAINING_PARTICIPANTS`
  ADD CONSTRAINT `TR_TRAINING_PARTICIPANTS_ibfk_1` FOREIGN KEY (`TRAINING_ID`) REFERENCES `TR_TRAININGS` (`ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `TR_TRAINING_PARTICIPANTS_ibfk_2` FOREIGN KEY (`PARTICIPANT_ID`) REFERENCES `MS_PARTICIPANTS` (`ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `TR_TRAINING_PARTICIPANTS_ibfk_3` FOREIGN KEY (`ORGANIZATION_ID`) REFERENCES `MS_ORGANIZATIONS` (`ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `TR_TRAINING_PARTICIPANTS_ibfk_4` FOREIGN KEY (`POSITION_ID`) REFERENCES `MS_POSITIONS` (`ID`) ON UPDATE CASCADE;

--
-- Constraints for table `TR_TRAINING_SUPPORTING_DOCUMENTS`
--
ALTER TABLE `TR_TRAINING_SUPPORTING_DOCUMENTS`
  ADD CONSTRAINT `TR_TRAINING_SUPPORTING_DOCUMENTS_ibfk_1` FOREIGN KEY (`TRAINING_ID`) REFERENCES `TR_TRAININGS` (`ID`) ON UPDATE CASCADE;

--
-- Constraints for table `TR_TRAINING_TRAINERS`
--
ALTER TABLE `TR_TRAINING_TRAINERS`
  ADD CONSTRAINT `TR_TRAINING_TRAINERS_ibfk_1` FOREIGN KEY (`TRAINING_ID`) REFERENCES `TR_TRAININGS` (`ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `TR_TRAINING_TRAINERS_ibfk_2` FOREIGN KEY (`TRAINER_ID`) REFERENCES `MS_TRAINERS` (`ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `TR_TRAINING_TRAINERS_ibfk_3` FOREIGN KEY (`ROLE_ID`) REFERENCES `MS_ROLES` (`ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `TR_TRAINING_TRAINERS_ibfk_4` FOREIGN KEY (`CITY_ID`) REFERENCES `MS_CITY` (`ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `TR_TRAINING_TRAINERS_ibfk_5` FOREIGN KEY (`PROVINCE_ID`) REFERENCES `MS_PROVINCE` (`ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `TR_TRAINING_TRAINERS_ibfk_6` FOREIGN KEY (`COUNTRY_ID`) REFERENCES `MS_COUNTRY` (`ID`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

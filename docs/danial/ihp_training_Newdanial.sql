-- phpMyAdmin SQL Dump
-- version 3.5.8.1
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Oct 21, 2013 at 01:43 PM
-- Server version: 5.5.32-log
-- PHP Version: 5.3.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ihp_training`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `GROUPS`
--

INSERT INTO `GROUPS` (`GROUP_ID`, `NAME`, `ACTIVE`, `CREATED_DATE`, `MODIFIED_DATE`) VALUES
(1, 'Administrator', 1, '2013-07-02 02:37:37', '2013-08-30 09:35:04'),
(29, 'Sub Admin', 1, '2013-08-03 22:12:26', '2013-08-03 15:12:26');

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
(1, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=125 ;

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
(8, 'Filter', 1, 5, 'filter', 'ACTION', 'icon-search', 2, '2013-07-01 11:12:44', '2013-07-16 03:39:49'),
(9, 'Menu Management', 0, 2, 'onMenuManagementClicked', 'SUBMENU', '', 1, '2013-07-10 18:15:07', '2013-07-17 04:25:32'),
(10, 'Add New user', 1, 0, 'add', 'ACTION', 'icon-accept', 3, '2013-07-11 14:37:16', '2013-07-11 07:37:16'),
(11, 'Update User', 1, 1, 'update', 'ACTION', 'icon-pencil', 3, '2013-07-11 14:38:43', '2013-07-11 07:38:43'),
(12, 'Delete User', 1, 2, 'delete', 'ACTION', 'icon-cross', 3, '2013-07-11 14:38:43', '2013-07-11 07:38:43'),
(13, 'Filter', 1, 3, 'filter', 'ACTION', 'icon-search', 3, '2013-07-11 14:38:43', '2013-07-16 10:33:53'),
(14, 'Manage Privilege', 1, 4, 'privilege', 'ACTION', 'icon-lock-open', 2, '2013-07-14 23:11:03', '2013-07-14 16:11:39'),
(15, 'Master', 1, 1, NULL, 'MENU', '', 0, '2013-07-15 23:11:00', '2013-07-15 16:11:00'),
(16, 'City', 1, 2, 'onMsCityClicked', 'SUBMENU', '', 15, '2013-07-17 10:06:23', '2013-07-23 08:52:58'),
(17, 'Add City', 1, 0, 'add', 'ACTION', 'icon-accept', 16, '2013-07-17 11:23:12', '2013-07-17 04:23:12'),
(18, 'Edit City', 1, 1, 'update', 'ACTION', 'icon-pencil', 16, '2013-07-17 11:24:27', '2013-07-17 07:22:01'),
(19, 'Delete City', 1, 2, 'delete', 'ACTION', 'icon-cross', 16, '2013-07-17 11:24:27', '2013-07-17 04:24:27'),
(20, 'Filter', 1, 3, 'filter', 'ACTION', 'icon-filter', 16, '2013-07-17 11:24:27', '2013-07-17 04:24:27'),
(21, 'Area Levels', 1, 0, 'onMsAreaLevelsClicked', 'SUBMENU', '', 15, '2013-07-23 15:53:49', '2013-07-23 09:00:11'),
(22, 'Add New Area Level', 1, 0, 'add', 'ACTION', 'icon-accept', 21, '2013-07-23 15:54:58', '2013-07-23 08:54:58'),
(23, 'Edit Area Level', 1, 1, 'update', 'ACTION', 'icon-pencil', 21, '2013-07-23 15:55:56', '2013-07-23 09:12:08'),
(24, 'Delete Area Level', 1, 2, 'delete', 'ACTION', 'icon-cross', 21, '2013-07-23 15:55:56', '2013-07-23 08:55:56'),
(25, 'Filter Area Level', 1, 3, 'filter', 'ACTION', 'icon-filter', 21, '2013-07-23 15:55:56', '2013-07-23 09:12:14'),
(26, 'Beneficiaries', 1, 1, 'onMsBeneficiariesClicked', 'SUBMENU', '', 15, '2013-07-23 16:30:19', '2013-07-23 09:32:50'),
(27, 'Add Beneficiaries', 1, 0, 'add', 'ACTION', 'icon-accept', 26, '2013-07-23 16:31:42', '2013-07-23 09:31:42'),
(28, 'Edit Beneficiaries', 1, 1, 'update', 'ACTION', 'icon-pencil', 26, '2013-07-23 16:32:26', '2013-07-23 09:32:26'),
(29, 'Delete Beneficiaries', 1, 2, 'delete', 'ACTION', 'icon-cross', 26, '2013-07-23 16:32:26', '2013-07-23 09:32:26'),
(30, 'Filter Beneficiaries', 1, 3, 'filter', 'ACTION', 'icon-filter', 26, '2013-07-23 16:32:26', '2013-07-23 09:32:26'),
(31, 'Countries', 1, 3, 'onMsCountriesClicked', 'SUBMENU', '', 15, '2013-07-23 16:53:00', '2013-07-23 09:53:00'),
(32, 'Add New Country', 1, 0, 'add', 'ACTION', 'icon-accept', 31, '2013-07-23 16:54:26', '2013-07-23 09:54:26'),
(34, 'Update Country', 1, 1, 'update', 'ACTION', 'icon-pencil', 31, '2013-07-23 16:55:04', '2013-07-23 09:55:04'),
(35, 'Delete Country', 1, 2, 'delete', 'ACTION', 'icon-cross', 31, '2013-07-23 16:55:04', '2013-07-23 09:55:04'),
(36, 'Filter Country', 1, 3, 'filter', 'ACTION', 'icon-accept', 31, '2013-07-23 16:55:04', '2013-07-23 09:55:04'),
(37, 'Funding Sources', 1, 4, 'onMsFundingSourcesClicked', 'SUBMENU', '', 15, '2013-07-23 17:01:36', '2013-07-23 10:01:36'),
(38, 'Add New Funding Sources', 1, 0, 'add', 'ACTION', 'icon-accept', 37, '2013-07-23 17:03:14', '2013-07-23 10:03:14'),
(39, 'Update Funding Sources', 1, 1, 'update', 'ACTION', 'icon-pencil', 37, '2013-07-23 17:03:14', '2013-07-23 10:03:14'),
(40, 'Delete Funding Sources', 1, 2, 'delete', 'ACTION', 'icon-cross', 37, '2013-07-23 17:03:14', '2013-07-23 10:03:14'),
(41, 'Filter Funding Sources', 1, 3, 'filter', 'ACTION', 'icon-filter', 37, '2013-07-23 17:03:14', '2013-07-23 10:03:14'),
(42, 'Organizations', 1, 5, 'onMsOrganizationsClicked', 'SUBMENU', '', 15, '2013-07-23 17:24:51', '2013-07-23 10:24:51'),
(43, 'Add New Organization', 1, 0, 'add', 'ACTION', 'icon-accept', 42, '2013-07-23 17:25:40', '2013-07-23 10:25:40'),
(44, 'Update Organization', 1, 1, 'update', 'ACTION', 'icon-pencil', 42, '2013-07-23 17:26:19', '2013-07-23 10:26:19'),
(45, 'Delete Organization', 1, 2, 'delete', 'ACTION', 'icon-cross', 42, '2013-07-23 17:26:19', '2013-07-23 10:26:19'),
(46, 'Filter Organization', 1, 3, 'filter', 'ACTION', 'icon-filter', 42, '2013-07-23 17:26:19', '2013-07-23 10:26:19'),
(47, 'Positions', 1, 7, 'onMsPositionsClicked', 'SUBMENU', '', 15, '2013-07-23 17:34:27', '2013-07-23 10:46:58'),
(48, 'Add New Position', 1, 0, 'add', 'ACTION', 'icon-accept', 47, '2013-07-23 17:34:57', '2013-07-23 10:34:57'),
(49, 'Update Position', 1, 1, 'update', 'ACTION', 'icon-pencil', 47, '2013-07-23 17:35:38', '2013-07-23 10:35:38'),
(50, 'Delete Position', 1, 2, 'delete', 'ACTION', 'icon-cross', 47, '2013-07-23 17:35:38', '2013-07-23 10:35:38'),
(51, 'Filter Position', 1, 3, 'filter', 'ACTION', 'icon-filter', 47, '2013-07-23 17:35:38', '2013-07-23 10:35:38'),
(52, 'Provinces', 1, 8, 'onMsProvincesClicked', 'SUBMENU', '', 15, '2013-07-23 17:39:57', '2013-07-23 10:47:03'),
(53, 'Add New Province', 1, 0, 'add', 'ACTION', 'icon-accept', 52, '2013-07-23 17:40:23', '2013-07-23 10:45:54'),
(54, 'Update Province', 1, 1, 'update', 'ACTION', 'icon-pencil', 52, '2013-07-23 17:41:05', '2013-07-23 10:45:56'),
(55, 'Delete Province', 1, 2, 'delete', 'ACTION', 'icon-cross', 52, '2013-07-23 17:41:05', '2013-07-23 10:45:58'),
(56, 'Filter Province', 1, 3, 'filter', 'ACTION', 'icon-filter', 52, '2013-07-23 17:41:05', '2013-07-23 10:45:59'),
(57, 'Participants', 1, 6, 'onMsParticipantsClicked', 'SUBMENU', '', 15, '2013-07-23 17:47:37', '2013-07-23 10:47:37'),
(58, 'Add New Participant', 1, 0, 'add', 'ACTION', 'icon-accept', 57, '2013-07-23 17:48:06', '2013-07-23 10:48:06'),
(59, 'Update Participant', 1, 1, 'update', 'ACTION', 'icon-pencil', 57, '2013-07-23 17:48:52', '2013-07-23 10:48:52'),
(60, 'Delete Participant', 1, 2, 'delete', 'ACTION', 'icon-cross', 57, '2013-07-23 17:48:52', '2013-07-23 10:48:52'),
(61, 'Filter Participant', 1, 3, 'filter', 'ACTION', 'icon-filter', 57, '2013-07-23 17:48:52', '2013-07-23 10:48:52'),
(62, 'Roles', 1, 9, 'onMsRolesClicked', 'SUBMENU', '', 15, '2013-07-23 17:56:25', '2013-07-23 10:56:25'),
(63, 'Add New Role', 1, 0, 'add', 'ACTION', 'icon-accept', 62, '2013-07-23 18:21:29', '2013-07-23 11:21:29'),
(64, 'Update Role', 1, 1, 'update', 'ACTION', 'icon-pencil', 62, '2013-07-23 18:22:20', '2013-07-23 11:22:20'),
(65, 'Edit Role', 1, 2, 'delete', 'ACTION', 'icon-cross', 62, '2013-07-23 18:22:20', '2013-07-23 11:22:20'),
(66, 'Filter Role', 1, 3, 'filter', 'ACTION', 'icon-filter', 62, '2013-07-23 18:22:20', '2013-07-23 15:17:19'),
(67, 'Trainers', 1, 10, 'onMsTrainersClicked', 'SUBMENU', '', 15, '2013-07-23 22:18:03', '2013-07-23 15:18:03'),
(68, 'Add New Trainer', 1, 0, 'add', 'ACTION', 'icon-accept', 67, '2013-07-23 22:18:26', '2013-07-23 15:18:26'),
(69, 'Update Trainer', 1, 1, 'update', 'ACTION', 'icon-pencil', 67, '2013-07-23 22:19:04', '2013-07-23 15:19:04'),
(70, 'Delete Trainer', 1, 2, 'delete', 'ACTION', 'icon-cross', 67, '2013-07-23 22:19:04', '2013-07-23 15:19:04'),
(71, 'Filter Trainer', 1, 3, 'filter', 'ACTION', 'icon-filter', 67, '2013-07-23 22:19:04', '2013-07-23 15:19:04'),
(72, 'Venues', 1, 12, 'onMsVenuesClicked', 'SUBMENU', '', 15, '2013-07-23 22:20:01', '2013-07-23 15:26:14'),
(73, 'Add New Venue', 1, 0, 'add', 'ACTION', 'icon-accept', 72, '2013-07-23 22:20:27', '2013-07-23 15:20:27'),
(74, 'Update Venue', 1, 1, 'update', 'ACTION', 'icon-pencil', 72, '2013-07-23 22:21:07', '2013-07-23 15:21:07'),
(75, 'Delete Venue', 1, 2, 'delete', 'ACTION', 'icon-cross', 72, '2013-07-23 22:21:07', '2013-07-23 15:21:07'),
(76, 'Filter Venue', 1, 2, 'filter', 'ACTION', 'icon-filter', 72, '2013-07-23 22:21:07', '2013-07-23 15:21:07'),
(77, 'Trainings', 1, 11, 'onMsTrainingsClicked', 'SUBMENU', '', 15, '2013-07-23 22:26:50', '2013-07-23 15:26:50'),
(78, 'Add New Training', 1, 0, 'add', 'ACTION', 'icon-accept', 77, '2013-07-23 22:27:11', '2013-07-23 15:27:11'),
(79, 'Update Training', 1, 1, 'update', 'ACTION', 'icon-pencil', 77, '2013-07-23 22:27:42', '2013-07-23 15:27:42'),
(80, 'Delete Training', 1, 2, 'delete', 'ACTION', 'icon-cross', 77, '2013-07-23 22:27:42', '2013-07-23 15:27:42'),
(81, 'Filter Training', 1, 2, 'filter', 'ACTION', 'icon-filter', 77, '2013-07-23 22:27:42', '2013-07-23 15:27:42'),
(84, 'Transaction', 1, 2, NULL, 'MENU', '', 0, '2013-07-24 17:05:23', '2013-07-24 10:05:23'),
(85, 'Trainings', 1, 0, 'onTrTrainingsClicked', 'SUBMENU', '', 84, '2013-07-24 17:06:23', '2013-07-24 10:06:23'),
(86, 'Create New Training', 1, 0, 'add', 'ACTION', 'icon-accept', 85, '2013-07-24 17:06:46', '2013-07-25 10:50:09'),
(87, 'Update Training', 1, 1, 'update', 'ACTION', 'icon-pencil', 85, '2013-07-25 20:32:11', '2013-07-25 13:57:32'),
(88, 'Manage Participants', 1, 2, 'manage-participants', 'ACTION', 'icon-user', 85, '2013-07-25 21:23:57', '2013-07-31 17:58:16'),
(89, 'Manage Trainers', 1, 3, 'manage-trainers', 'ACTION', 'icon-user-suit', 85, '2013-08-01 00:57:58', '2013-07-31 17:57:58'),
(91, 'Report Organizations', 1, 4, 'report-organizations', 'ACTION', 'icon-pencil', 42, '2013-08-21 10:29:24', '2013-08-21 03:29:24'),
(95, 'Report', 1, 3, NULL, 'MENU', '', 0, '2013-08-21 14:18:55', '2013-08-21 07:18:55'),
(97, 'Capacity Profile', 1, 0, NULL, 'MENU', '', 95, '2013-08-21 15:38:40', '2013-08-21 10:02:39'),
(98, 'Individual', 1, 0, 'onReportCapacityProfileIndividualClicked', 'SUBMENU', '', 97, '2013-08-21 15:40:15', '2013-08-22 06:50:08'),
(99, 'CBO', 1, 1, 'onReportCapacityProfileCboClicked', 'SUBMENU', '', 97, '2013-08-21 15:41:06', '2013-08-22 08:27:12'),
(102, 'Filter', 1, 0, 'filter', 'ACTION', 'icon-filter', 98, '2013-08-21 21:22:55', '2013-08-25 03:34:10'),
(103, 'Print', 1, 1, 'print-capacityprofile-individual', 'ACTION', 'icon-printer', 98, '2013-08-22 12:55:16', '2013-08-25 13:03:22'),
(104, 'Filter', 1, 0, 'filter', 'ACTION', 'icon-filter', 99, '2013-08-22 20:54:59', '2013-08-25 13:03:58'),
(105, 'Print', 1, 1, 'print-capacityprofile-cbo', 'ACTION', 'icon-pencil', 99, '2013-08-23 11:01:42', '2013-08-24 13:50:25'),
(110, 'Filter', 1, 0, 'filter', 'ACTION', 'icon-filter', 96, '2013-08-26 10:19:12', '2013-08-26 04:18:12'),
(111, 'Print', 1, 1, 'print-report-participant', 'ACTION', 'icon-printer', 96, '2013-08-26 10:27:08', '2013-08-26 04:34:34'),
(112, 'Organization', 1, 1, 'onReportOrganizationClicked', 'SUBMENU', '', 121, '2013-08-26 20:50:02', '2013-10-11 13:42:12'),
(113, 'Print', 1, 1, 'print-report-organization', 'ACTION', 'icon-printer', 112, '2013-08-26 21:08:43', '2013-08-28 04:35:41'),
(114, 'Filter', 1, 0, 'filter', 'ACTION', 'icon-filter', 112, '2013-08-26 21:09:26', '2013-08-26 14:09:26'),
(115, 'TrainingEvaluation', 1, 2, 'onReportTrainingEvaluationClicked', 'SUBMENU', '', 95, '2013-08-26 23:54:16', '2013-08-26 17:01:18'),
(116, 'Print', 1, 1, 'print-report-trainingevaluation', 'ACTION', 'icon-printer', 115, '2013-08-27 00:26:01', '2013-08-26 17:26:01'),
(117, 'Filter', 1, 0, 'filter', 'ACTION', 'icon-filter', 115, '2013-08-27 00:26:43', '2013-08-26 17:26:43'),
(118, 'Training Modules', 1, 4, 'training-modules', 'ACTION', 'icon-file-extension-pps', 85, '2013-08-28 15:14:19', '2013-08-28 08:14:19'),
(119, 'Upload', 1, 4, 'upload', 'ACTION', 'icon-file-extension-pps', 42, '2013-10-10 20:45:13', '2013-10-10 13:45:13'),
(120, 'Detail', 1, 5, 'detail', 'ACTION', 'icon-detail', 42, '2013-10-11 10:44:35', '2013-10-11 03:44:35'),
(121, 'Statistik', 1, 1, NULL, 'MENU', '', 95, '2013-10-11 20:37:54', '2013-10-11 13:38:19'),
(122, 'Participant', 1, 0, 'onReportParticipantsClicked', 'SUBMENU', '', 121, '2013-10-11 20:40:57', '2013-10-11 13:40:57'),
(123, 'Detail', 1, 0, 'print-report-participant', 'ACTION', 'icon-detail', 122, '2013-10-15 19:12:46', '2013-10-15 12:12:46'),
(124, 'Filter', 1, 1, 'filter', 'ACTION', 'icon-printer', 122, '2013-10-15 19:19:48', '2013-10-15 12:19:48');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `MS_AREA_LEVELS`
--

INSERT INTO `MS_AREA_LEVELS` (`ID`, `NAME`, `TYPE`, `CREATED_DATE`, `MODIFIED_DATE`) VALUES
(4, 'ISEAN Region', 'Regional Level', '2013-07-24 17:10:53', '2013-07-24 10:12:39'),
(5, 'ASEAN', 'Regional Level', '2013-07-24 17:11:00', '2013-07-24 10:11:00'),
(6, 'ASIA Pacific', 'Regional Level', '2013-07-24 17:11:15', '2013-07-24 10:11:15'),
(7, 'ID', 'Country Level', '2013-07-24 17:11:22', '2013-07-24 10:11:22'),
(8, 'MY', 'Country Level', '2013-07-24 17:11:28', '2013-07-24 10:11:28'),
(9, 'PH', 'Country Level', '2013-07-24 17:11:38', '2013-07-24 10:12:13'),
(10, 'TL', 'Country Level', '2013-07-24 17:11:55', '2013-07-24 10:11:55'),
(11, 'SG', 'Country Level', '2013-07-24 17:12:01', '2013-07-24 10:12:01');

-- --------------------------------------------------------

--
-- Stand-in structure for view `MS_AREA_LEVELS_VIEW`
--
CREATE TABLE IF NOT EXISTS `MS_AREA_LEVELS_VIEW` (
`ID` int(19)
,`DISPLAY_NAME` varchar(203)
,`NAME` varchar(100)
,`TYPE` varchar(100)
,`CREATED_DATE` datetime
,`MODIFIED_DATE` timestamp
);
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `MS_BENEFICIARIES`
--

INSERT INTO `MS_BENEFICIARIES` (`ID`, `NAME`, `CREATED_DATE`, `MODIFIED_DATE`) VALUES
(2, 'SR Staff', '2013-07-24 17:13:09', '2013-07-24 10:13:09'),
(3, 'Local CBO Staff', '2013-07-24 17:13:18', '2013-07-24 10:13:18'),
(4, 'Health Care Provider', '2013-07-24 17:13:24', '2013-07-24 10:13:24'),
(5, 'Community / Non Staff', '2013-07-24 17:13:32', '2013-07-24 10:13:32');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `MS_CITY`
--

INSERT INTO `MS_CITY` (`ID`, `NAME`, `CREATED_DATE`, `MODIFIED_DATE`) VALUES
(11, 'Jakarta Selatan', '2013-08-01 15:35:13', '2013-08-01 08:35:13'),
(12, 'Jakarta Timur', '2013-09-21 20:13:09', '2013-09-21 13:13:09'),
(13, 'Jakarta Utara', '2013-09-21 20:14:16', '2013-09-21 13:14:16'),
(14, 'Singapore', '2013-10-11 21:05:43', '2013-10-11 14:05:43');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `MS_COUNTRY`
--

INSERT INTO `MS_COUNTRY` (`ID`, `NAME`, `CREATED_DATE`, `MODIFIED_DATE`) VALUES
(8, 'Indonesia', '2013-08-01 15:22:15', '2013-08-01 08:22:15'),
(9, 'Singapore', '2013-08-02 01:03:40', '2013-08-01 18:03:40'),
(10, 'Timor Leste', '2013-09-18 10:20:31', '2013-09-18 03:20:31');

-- --------------------------------------------------------

--
-- Table structure for table `MS_FUNDING_SOURCES`
--

CREATE TABLE IF NOT EXISTS `MS_FUNDING_SOURCES` (
  `ID` int(19) NOT NULL AUTO_INCREMENT,
  `CITY_ID` int(19) NOT NULL,
  `PROVINCE_ID` int(19) NOT NULL,
  `COUNTRY_ID` int(19) NOT NULL,
  `NAME` varchar(100) NOT NULL,
  `PHONE_NO1` varchar(20) NOT NULL,
  `PHONE_NO2` varchar(20) DEFAULT NULL,
  `EMAIL1` varchar(100) NOT NULL,
  `EMAIL2` varchar(100) DEFAULT NULL,
  `WEBSITE` varchar(100) DEFAULT NULL,
  `ADDRESS` text,
  `CREATED_DATE` datetime NOT NULL,
  `MODIFIED_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  KEY `fk_CITY_ID` (`CITY_ID`),
  KEY `fk_COUNTRY_ID` (`COUNTRY_ID`),
  KEY `PROVINCE_ID` (`PROVINCE_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `MS_FUNDING_SOURCES`
--

INSERT INTO `MS_FUNDING_SOURCES` (`ID`, `CITY_ID`, `PROVINCE_ID`, `COUNTRY_ID`, `NAME`, `PHONE_NO1`, `PHONE_NO2`, `EMAIL1`, `EMAIL2`, `WEBSITE`, `ADDRESS`, `CREATED_DATE`, `MODIFIED_DATE`) VALUES
(10, 11, 36, 8, 'PT MyIndo Cyber Media', '021-7224190', '', 'mail@myindo.co.id', '', '', '', '2013-08-01 15:35:45', '2013-08-01 08:35:45'),
(11, 11, 37, 8, 'aaaa', '12234345', '1232344', 's@y.com', 'b@g.com', 'www.ser.com', 'aaaaa', '2013-08-20 11:46:43', '2013-08-20 04:46:43');

-- --------------------------------------------------------

--
-- Stand-in structure for view `MS_FUNDING_SOURCES_VIEW`
--
CREATE TABLE IF NOT EXISTS `MS_FUNDING_SOURCES_VIEW` (
`ID` int(19)
,`CITY_ID` int(19)
,`CITY_NAME` varchar(100)
,`PROVINCE_ID` int(19)
,`PROVINCE_NAME` varchar(100)
,`COUNTRY_ID` int(19)
,`COUNTRY_NAME` varchar(100)
,`NAME` varchar(100)
,`PHONE_NO1` varchar(20)
,`PHONE_NO2` varchar(20)
,`EMAIL1` varchar(100)
,`EMAIL2` varchar(100)
,`WEBSITE` varchar(100)
,`ADDRESS` text
,`CREATED_DATE` datetime
,`MODIFIED_DATE` timestamp
);
-- --------------------------------------------------------

--
-- Table structure for table `MS_ORGANIZATIONS`
--

CREATE TABLE IF NOT EXISTS `MS_ORGANIZATIONS` (
  `ID` int(19) NOT NULL AUTO_INCREMENT,
  `CITY_ID` int(19) NOT NULL,
  `PROVINCE_ID` int(19) NOT NULL,
  `COUNTRY_ID` int(19) NOT NULL,
  `NAME` varchar(100) NOT NULL,
  `PHONE_NO1` varchar(20) NOT NULL,
  `PHONE_NO2` varchar(20) DEFAULT NULL,
  `EMAIL1` varchar(100) DEFAULT NULL,
  `EMAIL2` varchar(100) DEFAULT NULL,
  `WEBSITE` varchar(100) DEFAULT NULL,
  `ADDRESS` text,
  `CREATED_DATE` datetime NOT NULL,
  `MODIFIED_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  KEY `CITY_ID` (`CITY_ID`),
  KEY `COUNTRY_ID` (`COUNTRY_ID`),
  KEY `PROVINCE_ID` (`PROVINCE_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `MS_ORGANIZATIONS`
--

INSERT INTO `MS_ORGANIZATIONS` (`ID`, `CITY_ID`, `PROVINCE_ID`, `COUNTRY_ID`, `NAME`, `PHONE_NO1`, `PHONE_NO2`, `EMAIL1`, `EMAIL2`, `WEBSITE`, `ADDRESS`, `CREATED_DATE`, `MODIFIED_DATE`) VALUES
(5, 11, 36, 8, 'PT MyIndo Cyber Media', '021-7224190', '', 'mail@myindo.co.id', '', '', '', '2013-08-01 15:36:12', '2013-08-01 08:36:12'),
(6, 14, 38, 9, 'test', '021678564', '021989762', 'm@ymail.com', 't@mail.com', 'www.myindo.com', 'aaaaaaa', '2013-08-20 11:29:03', '2013-10-11 14:08:19'),
(7, 11, 37, 8, 'ssss', '122444', '11111', 'a@t.com', 'b@s.com', 'www.det.com', 'aaaaa', '2013-08-20 11:45:47', '2013-08-20 04:45:47');

-- --------------------------------------------------------

--
-- Table structure for table `MS_ORGANIZATIONS_UPLOAD`
--

CREATE TABLE IF NOT EXISTS `MS_ORGANIZATIONS_UPLOAD` (
  `ID` int(19) NOT NULL AUTO_INCREMENT,
  `ORGANIZATION_ID` int(19) NOT NULL,
  `FILE_NAME` varchar(255) NOT NULL,
  `TRAINING_ID` int(19) NOT NULL,
  `FILE_SIZE` int(11) NOT NULL,
  `FILE_MIME_TYPE` varchar(20) NOT NULL,
  `FILE_PATH` varchar(255) NOT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `MODIFIED_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `MS_ORGANIZATIONS_UPLOAD`
--

INSERT INTO `MS_ORGANIZATIONS_UPLOAD` (`ID`, `ORGANIZATION_ID`, `FILE_NAME`, `TRAINING_ID`, `FILE_SIZE`, `FILE_MIME_TYPE`, `FILE_PATH`, `CREATED_DATE`, `MODIFIED_DATE`) VALUES
(10, 7, 'test2', 3, 82568, 'application/pdf', 'uploads/test2_2013_10_20_19_58_06.pdf', '2013-10-20 19:58:06', '2013-10-20 12:58:06');

-- --------------------------------------------------------

--
-- Stand-in structure for view `MS_ORGANIZATIONS_UPLOAD_VIEW`
--
CREATE TABLE IF NOT EXISTS `MS_ORGANIZATIONS_UPLOAD_VIEW` (
`ID` int(19)
,`ORGANIZATION_ID` int(19)
,`ORGANIZATION_NAME` varchar(100)
,`FILE_NAME` varchar(255)
,`TRAINING_ID` int(19)
,`TRAINING_NAME` varchar(100)
,`FILE_SIZE` int(11)
,`FILE_MIME_TYPE` varchar(20)
,`FILE_PATH` varchar(255)
,`CREATED_DATE` datetime
,`MODIFIED_DATE` timestamp
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `MS_ORGANIZATIONS_VIEW`
--
CREATE TABLE IF NOT EXISTS `MS_ORGANIZATIONS_VIEW` (
`ID` int(19)
,`CITY_ID` int(19)
,`CITY_NAME` varchar(100)
,`PROVINCE_ID` int(19)
,`PROVINCE_NAME` varchar(100)
,`COUNTRY_ID` int(19)
,`COUNTRY_NAME` varchar(100)
,`NAME` varchar(100)
,`PHONE_NO1` varchar(20)
,`PHONE_NO2` varchar(20)
,`EMAIL1` varchar(100)
,`EMAIL2` varchar(100)
,`WEBSITE` varchar(100)
,`ADDRESS` text
,`CREATED_DATE` datetime
,`MODIFIED_DATE` timestamp
);
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `MS_PARTICIPANTS`
--

INSERT INTO `MS_PARTICIPANTS` (`ID`, `FNAME`, `MNAME`, `LNAME`, `SNAME`, `GENDER`, `BDATE`, `MOBILE_NO`, `PHONE_NO`, `EMAIL1`, `EMAIL2`, `FB`, `TWITTER`, `CREATED_DATE`, `MODIFIED_DATE`) VALUES
(2, 'Gilang', 'Pratama', 'Putra', 'Gilang', 'Male', '0000-00-00', '08119811010', '', 'gilang.pratama@myindo.co.id', '', '', '', '2013-08-01 15:36:57', '2013-08-01 08:36:57'),
(3, 'Deni', 'Permana', '', 'Deni', 'Male', '0000-00-00', '081112331', '', 'deni@myindo.co.id', '', '', '', '2013-08-02 01:52:00', '2013-08-01 18:52:00'),
(4, 'ccccc', 'cc', '', 'wer', 'Transgender', '0000-00-00', '12344555', '', 'a@ymail.com', '', '', '', '2013-08-28 12:08:57', '2013-08-28 05:08:57'),
(5, 'qqq', '', '', 'wsa', 'Male', '0000-00-00', '1234567', '', 'a@ymail.com', '', '', '', '2013-08-28 12:09:23', '2013-08-28 05:09:23'),
(6, 'asd', '', '', 'wer', 'Male', '0000-00-00', '2334444', '', 'Input primary Email..', '', '', '', '2013-09-05 18:13:59', '2013-09-05 11:13:59'),
(7, 'Danial', '', '', 'Danial', 'Male', '0000-00-00', '12343456', '', 'Input primary Email..', '', '', '', '2013-09-10 10:45:37', '2013-09-10 03:45:37'),
(8, 'esr', '', '', 'ses', 'Transgender', '0000-00-00', '111111', '', 'Input primary Email..', '', '', '', '2013-09-10 10:59:21', '2013-09-10 03:59:21');

-- --------------------------------------------------------

--
-- Stand-in structure for view `MS_PARTICIPANTS_VIEW`
--
CREATE TABLE IF NOT EXISTS `MS_PARTICIPANTS_VIEW` (
`ID` int(19)
,`NAME` varchar(302)
,`FNAME` varchar(100)
,`MNAME` varchar(100)
,`LNAME` varchar(100)
,`SNAME` varchar(100)
,`GENDER` varchar(100)
,`BDATE` date
,`MOBILE_NO` varchar(20)
,`PHONE_NO` varchar(20)
,`EMAIL1` varchar(100)
,`EMAIL2` varchar(100)
,`FB` varchar(100)
,`TWITTER` varchar(100)
,`CREATED_DATE` datetime
,`MODIFIED_DATE` timestamp
);
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `MS_POSITIONS`
--

INSERT INTO `MS_POSITIONS` (`ID`, `NAME`, `CREATED_DATE`, `MODIFIED_DATE`) VALUES
(2, 'Director', '2013-07-25 16:38:42', '2013-07-25 09:38:42'),
(3, 'CEO', '2013-07-25 16:38:48', '2013-07-25 09:38:48'),
(4, 'Manager', '2013-07-25 16:38:52', '2013-07-25 09:38:52'),
(5, 'Programmer', '2013-07-25 16:38:56', '2013-07-25 09:38:56'),
(6, 'System Analyst', '2013-07-25 16:39:02', '2013-07-25 09:39:02');

-- --------------------------------------------------------

--
-- Table structure for table `MS_PROVINCE`
--

CREATE TABLE IF NOT EXISTS `MS_PROVINCE` (
  `ID` int(19) NOT NULL AUTO_INCREMENT,
  `COUNTRY_ID` int(19) NOT NULL,
  `NAME` varchar(100) NOT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `MODIFIED_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  KEY `ID` (`ID`),
  KEY `ID_2` (`ID`),
  KEY `COUNTRY_ID` (`COUNTRY_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `MS_PROVINCE`
--

INSERT INTO `MS_PROVINCE` (`ID`, `COUNTRY_ID`, `NAME`, `CREATED_DATE`, `MODIFIED_DATE`) VALUES
(36, 8, 'DKI Jakarta', '2013-08-01 15:28:00', '2013-08-01 08:28:00'),
(37, 8, 'Bandung', '2013-08-01 15:30:33', '2013-08-01 08:30:33'),
(38, 9, 'Singapore', '2013-08-02 01:03:58', '2013-08-01 18:03:58'),
(39, 8, 'serewr', '2013-08-20 10:10:31', '2013-08-20 03:10:31'),
(40, 8, 'jakarta', '2013-08-20 11:01:01', '2013-08-20 04:01:01');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `MS_ROLES`
--

INSERT INTO `MS_ROLES` (`ID`, `NAME`, `CREATED_DATE`, `MODIFIED_DATE`) VALUES
(4, 'Trainer', '2013-07-30 22:45:33', '2013-07-30 15:45:33'),
(5, 'Documentator', '2013-07-30 22:45:40', '2013-07-30 15:45:40'),
(6, 'Facilitator', '2013-07-30 22:45:47', '2013-07-30 15:45:47');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `MS_TRAINERS`
--

INSERT INTO `MS_TRAINERS` (`ID`, `NAME`, `NICKNAME`, `GENDER`, `ADDRESS`, `BDATE`, `MOBILE_NO`, `PHONE_NO`, `EMAIL1`, `EMAIL2`, `FB`, `TWITTER`, `CREATED_DATE`, `MODIFIED_DATE`) VALUES
(3, 'Gilang Pratama Putra', 'Gilang', 'Male', 'Jl. Kelapa Tiga No 3', '1989-03-20', '08119811010', '', 'gilang.pratama@myindo.co.id', '', '', '', '2013-08-01 15:37:38', '2013-08-01 08:37:38'),
(4, 'Danial', 'Danial', 'Male', 'Jl.damai 1', '2013-09-05', '08767543', '9897650', 'm@ymail.com', '', '', '', '2013-09-02 11:35:41', '2013-09-02 04:35:41');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `MS_TRAININGS`
--

INSERT INTO `MS_TRAININGS` (`ID`, `NAME`, `CREATED_DATE`, `MODIFIED_DATE`) VALUES
(3, 'PHP Zend Training', '2013-08-01 15:38:22', '2013-08-01 08:38:22'),
(4, 'Sencha ExtJS Training', '2013-08-02 01:41:16', '2013-08-01 18:41:16'),
(5, 'Sencha Touch Training', '2013-08-02 01:50:01', '2013-08-01 18:50:01'),
(6, 'TESTAJA', '2013-10-11 21:01:36', '2013-10-11 14:01:36');

-- --------------------------------------------------------

--
-- Table structure for table `MS_VENUES`
--

CREATE TABLE IF NOT EXISTS `MS_VENUES` (
  `ID` int(19) NOT NULL AUTO_INCREMENT,
  `CITY_ID` int(19) NOT NULL,
  `PROVINCE_ID` int(19) NOT NULL,
  `COUNTRY_ID` int(19) NOT NULL,
  `NAME` varchar(100) NOT NULL,
  `PHONE_NO1` varchar(20) NOT NULL,
  `PHONE_NO2` varchar(20) DEFAULT NULL,
  `EMAIL1` varchar(100) NOT NULL,
  `EMAIL2` varchar(100) DEFAULT NULL,
  `WEBSITE` varchar(100) DEFAULT NULL,
  `ADDRESS` text,
  `CREATED_DATE` datetime NOT NULL,
  `MODIFIED_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  KEY `CITY_ID` (`CITY_ID`),
  KEY `PROVINCE_ID` (`PROVINCE_ID`),
  KEY `COUNTRY_ID` (`COUNTRY_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `MS_VENUES`
--

INSERT INTO `MS_VENUES` (`ID`, `CITY_ID`, `PROVINCE_ID`, `COUNTRY_ID`, `NAME`, `PHONE_NO1`, `PHONE_NO2`, `EMAIL1`, `EMAIL2`, `WEBSITE`, `ADDRESS`, `CREATED_DATE`, `MODIFIED_DATE`) VALUES
(4, 11, 36, 8, 'PT MyIndo Cyber Media', '021-7224190', '', 'mail@myindo.co.id', '', '', '', '2013-08-01 15:38:07', '2013-08-01 08:38:07'),
(5, 11, 37, 8, 'baqyu', '021334433', '021777789', 'm@ymail.com', 'b@gmail.com', 'www.det.com', 'ssssssss', '2013-08-20 11:44:26', '2013-08-20 04:44:26'),
(6, 14, 38, 9, 'PT MyIndo Cyber Media', '111111111', '111111', 'a@ymail.com', '', 'www.w.com', 'gdgdgdgdgdgdg', '2013-10-11 21:57:10', '2013-10-11 14:57:10');

-- --------------------------------------------------------

--
-- Stand-in structure for view `MS_VENUES_VIEW`
--
CREATE TABLE IF NOT EXISTS `MS_VENUES_VIEW` (
`ID` int(19)
,`CITY_ID` int(19)
,`CITY_NAME` varchar(100)
,`COUNTRY_ID` int(19)
,`PROVINCE_ID` int(19)
,`PROVINCE_NAME` varchar(100)
,`COUNTRY_NAME` varchar(100)
,`NAME` varchar(100)
,`PHONE_NO1` varchar(20)
,`PHONE_NO2` varchar(20)
,`EMAIL1` varchar(100)
,`EMAIL2` varchar(100)
,`WEBSITE` varchar(100)
,`ADDRESS` text
,`CREATED_DATE` datetime
,`MODIFIED_DATE` timestamp
);
-- --------------------------------------------------------

--
-- Table structure for table `PRIVILEGES`
--

CREATE TABLE IF NOT EXISTS `PRIVILEGES` (
  `GROUP_ID` int(19) NOT NULL,
  `MENU_ID` int(19) NOT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `MODIFIED_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`GROUP_ID`,`MENU_ID`),
  KEY `MENU_ID` (`MENU_ID`)
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `TR_TRAININGS`
--

INSERT INTO `TR_TRAININGS` (`ID`, `USER_ID`, `TRAINING_ID`, `AREA_LEVEL_ID`, `BENEFICIARIES_ID`, `FUNDING_SOURCE_ID`, `VENUE_ID`, `ORGANIZATION_ID`, `SDATE`, `EDATE`, `CREATED_DATE`, `MODIFIED_DATE`) VALUES
(4, 1, 3, 5, 2, 10, 4, 5, '2013-08-01', '2013-08-07', '2013-08-01 15:39:00', '2013-08-01 08:39:00'),
(5, 1, 4, 5, 3, 10, 4, 5, '2013-08-02', '2013-08-10', '2013-08-02 01:41:35', '2013-08-01 18:41:35'),
(6, 1, 5, 5, 3, 10, 4, 5, '2013-08-09', '2013-08-16', '2013-08-02 01:50:22', '2013-08-01 18:50:22'),
(7, 1, 3, 5, 4, 10, 4, 5, '2013-08-13', '2013-08-20', '2013-08-20 15:03:23', '2013-08-20 08:03:23'),
(8, 1, 5, 5, 5, 10, 6, 6, '2013-10-11', '2013-10-11', '2013-10-11 20:56:20', '2013-10-11 14:57:52');

-- --------------------------------------------------------

--
-- Stand-in structure for view `TR_TRAININGS_VIEW`
--
CREATE TABLE IF NOT EXISTS `TR_TRAININGS_VIEW` (
`ID` int(19)
,`USER_ID` int(19)
,`USERNAME` varchar(40)
,`TRAINING_ID` int(19)
,`TRAINING_NAME` varchar(100)
,`AREA_LEVEL_ID` int(19)
,`AREA_LEVEL_NAME` varchar(100)
,`BENEFICIARIES_ID` int(19)
,`BENEFICIARIES_NAME` varchar(100)
,`FUNDING_SOURCE_ID` int(19)
,`FUNDING_SOURCE_NAME` varchar(100)
,`FUNDING_SOURCE_CITY_ID` int(19)
,`FUNDING_SOURCE_CITY_NAME` varchar(100)
,`FUNDING_SOURCE_PROVINCE_ID` int(19)
,`FUNDING_SOURCE_PROVINCE_NAME` varchar(100)
,`FUNDING_SOURCE_COUNTRY_ID` int(19)
,`FUNDING_SOURCE_COUNTRY_NAME` varchar(100)
,`FUNDING_SOURCE_PHONE_NO1` varchar(20)
,`FUNDING_SOURCE_PHONE_NO2` varchar(20)
,`FUNDING_SOURCE_EMAIL1` varchar(100)
,`FUNDING_SOURCE_EMAIL2` varchar(100)
,`FUNDING_SOURCE_WEBSITE` varchar(100)
,`FUNDING_SOURCE_ADDRESS` text
,`VENUE_ID` int(19)
,`VENUE_NAME` varchar(100)
,`VENUE_CITY_ID` int(19)
,`VENUE_CITY_NAME` varchar(100)
,`VENUE_PROVINCE_ID` int(19)
,`VENUE_PROVINCE_NAME` varchar(100)
,`VENUE_COUNTRY_ID` int(19)
,`VENUE_COUNTRY_NAME` varchar(100)
,`VENUE_PHONE_NO1` varchar(20)
,`VENUE_PHONE_NO2` varchar(20)
,`VENUE_EMAIL1` varchar(100)
,`VENUE_EMAIL2` varchar(100)
,`VENUE_WEBSITE` varchar(100)
,`VENUE_ADDRESS` text
,`ORGANIZATION_ID` int(19)
,`ORGANIZATION_NAME` varchar(100)
,`ORGANIZATION_CITY_ID` int(19)
,`ORGANIZATION_CITY_NAME` varchar(100)
,`ORGANIZATION_PROVINCE_ID` int(19)
,`ORGANIZATION_PROVINCE_NAME` varchar(100)
,`ORGANIZATION_COUNTRY_ID` int(19)
,`ORGANIZATION_COUNTRY_NAME` varchar(100)
,`ORGANIZATION_PHONE_NO1` varchar(20)
,`ORGANIZATION_PHONE_NO2` varchar(20)
,`ORGANIZATION_EMAIL1` varchar(100)
,`ORGANIZATION_EMAIL2` varchar(100)
,`ORGANIZATION_WEBSITE` varchar(100)
,`ORGANIZATION_ADDRESS` text
,`SDATE` date
,`EDATE` date
,`CREATED_DATE` datetime
,`MODIFIED_DATE` timestamp
);
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `TR_TRAINING_PARTICIPANTS`
--

INSERT INTO `TR_TRAINING_PARTICIPANTS` (`ID`, `TRAINING_ID`, `PARTICIPANT_ID`, `ORGANIZATION_ID`, `POSITION_ID`, `PRE_TEST`, `POST_TEST`, `DIFF`, `CREATED_DATE`, `MODIFIED_DATE`) VALUES
(11, 4, 2, 5, 3, 7, 0, 0, '2013-08-02 02:18:12', '2013-09-09 06:18:02'),
(12, 4, 3, 5, 2, 0, 0, 0, '2013-08-20 19:40:51', '2013-08-20 12:40:51'),
(13, 5, 2, 5, 6, 0, 0, 0, '2013-08-20 19:44:22', '2013-08-20 13:16:23'),
(14, 6, 2, 5, 4, 0, 0, 0, '2013-08-21 11:31:55', '2013-08-21 04:31:55'),
(15, 4, 5, 6, 2, 0, 0, 0, '2013-08-28 13:18:31', '2013-08-28 06:18:31'),
(16, 6, 4, 7, 3, 0, 0, 0, '2013-08-28 13:27:30', '2013-08-28 06:27:30'),
(18, 5, 3, 7, 3, 0, 0, 0, '2013-09-05 14:46:06', '2013-09-05 07:46:06'),
(19, 5, 4, 5, 3, 0, 0, 0, '2013-09-05 14:49:19', '2013-09-05 07:49:19'),
(20, 4, 4, 7, 5, 0, 0, 0, '2013-09-05 14:51:36', '2013-09-05 07:51:36'),
(21, 5, 5, 7, 2, 0, 0, 0, '2013-09-05 17:45:53', '2013-09-05 10:45:53'),
(22, 6, 7, 5, 3, 0, 0, 0, '2013-09-17 19:55:16', '2013-09-17 12:55:16'),
(23, 7, 4, 5, 3, 0, 0, 0, '2013-09-18 10:31:48', '2013-09-18 03:31:48'),
(24, 8, 7, 5, 3, 0, 0, 0, '2013-10-11 20:57:58', '2013-10-11 13:57:58');

-- --------------------------------------------------------

--
-- Stand-in structure for view `TR_TRAINING_PARTICIPANTS_VIEW`
--
CREATE TABLE IF NOT EXISTS `TR_TRAINING_PARTICIPANTS_VIEW` (
`ID` int(19)
,`TRAINING_ID` int(19)
,`TRAINING_NAME` varchar(100)
,`PARTICIPANT_ID` int(19)
,`PARTICIPANT_NAME` varchar(302)
,`PARTICIPANT_FNAME` varchar(100)
,`PARTICIPANT_MNAME` varchar(100)
,`PARTICIPANT_LNAME` varchar(100)
,`PARTICIPANT_SNAME` varchar(100)
,`PARTICIPANT_GENDER` varchar(100)
,`PARTICIPANT_BDATE` date
,`PARTICIPANT_MOBILE_NO` varchar(20)
,`PARTCIPANT_PHONE_NO` varchar(20)
,`PARTICIPANT_EMAIL1` varchar(100)
,`PARTICIPANT_EMAIL2` varchar(100)
,`PARTICIPANT_FB` varchar(100)
,`PARTICIPANT_TWITTER` varchar(100)
,`ORGANIZATION_ID` int(19)
,`ORGANIZATION_CITY_ID` int(19)
,`ORGANIZATION_CITY_NAME` varchar(100)
,`ORGANIZATION_PROVINCE_ID` int(19)
,`ORGANIZATION_PROVINCE_NAME` varchar(100)
,`ORGANIZATION_COUNTRY_ID` int(19)
,`ORGANIZATION_COUNTRY_NAME` varchar(100)
,`ORGANIZATION_NAME` varchar(100)
,`ORGANIZATION_PHONE_NO1` varchar(20)
,`ORGANIZATION_PHONE_NO2` varchar(20)
,`ORGANIZATION_EMAIL1` varchar(100)
,`ORGANIZATION_EMAIL2` varchar(100)
,`ORGANIZATION_WEBSITE` varchar(100)
,`ORGANIZATION_ADDRESS` text
,`POSITION_ID` int(19)
,`POSITION_NAME` varchar(100)
,`PRE_TEST` float
,`POST_TEST` float
,`DIFF` float
,`CREATED_DATE` datetime
,`MODIFIED_DATE` timestamp
);
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `TR_TRAINING_TRAINERS`
--

INSERT INTO `TR_TRAINING_TRAINERS` (`ID`, `TRAINING_ID`, `TRAINER_ID`, `ROLE_ID`, `CITY_ID`, `PROVINCE_ID`, `COUNTRY_ID`, `CV_NAME`, `CV_PATH`, `CV_MIME_TYPE`, `CV_SIZE`, `CREATED_DATE`, `MODIFIED_DATE`) VALUES
(1, 5, 3, 5, 11, 36, 8, NULL, NULL, NULL, NULL, '2013-08-13 17:15:02', '2013-08-13 10:15:02'),
(2, 4, 3, 5, 11, 37, 8, 'test', 'uploads/trainers/test_2013_09_06_19_22_23.xlsx', 'text/plain', 649, '2013-08-14 09:59:27', '2013-09-06 12:22:23'),
(3, 7, 3, 4, 11, 36, 8, NULL, NULL, NULL, NULL, '2013-08-20 15:06:09', '2013-08-20 08:06:09'),
(4, 4, 4, 4, 11, 40, 8, 'ser', 'uploads/trainers/ser_2013_09_06_19_34_01.xlsx', 'application/zip', 18969, '2013-09-02 11:36:17', '2013-09-06 12:34:01'),
(5, 7, 4, 5, 11, 36, 8, 'as', 'uploads/trainers/as_2013_09_25_14_25_51.xlsx', 'text/plain', 649, '2013-09-02 11:36:36', '2013-09-25 07:25:51'),
(6, 8, 3, 5, 14, 38, 9, NULL, NULL, NULL, NULL, '2013-10-11 21:06:09', '2013-10-11 14:06:09');

-- --------------------------------------------------------

--
-- Stand-in structure for view `TR_TRAINING_TRAINERS_VIEW`
--
CREATE TABLE IF NOT EXISTS `TR_TRAINING_TRAINERS_VIEW` (
`ID` int(19)
,`TR_TRAININGS_ID` int(19)
,`TRAINER_ID` int(19)
,`ROLE_ID` int(19)
,`CITY_ID` int(19)
,`PROVINCE_ID` int(19)
,`COUNTRY_ID` int(19)
,`CV_NAME` varchar(255)
,`CV_PATH` varchar(255)
,`CV_MIME_TYPE` varchar(20)
,`CV_SIZE` int(11)
,`CREATED_DATE` datetime
,`MODIFIED_DATE` timestamp
,`TRAINING_USER_ID` int(19)
,`TRAINING_ID` int(19)
,`TRAINING_AREA_LEVEL_ID` int(19)
,`TRAINING_BENEFICIARIES_ID` int(19)
,`TRAINING_FUNDING_SOURCE_ID` int(19)
,`TRAINING_VENUE_ID` int(19)
,`TRAINING_ORGANIZATION_ID` int(19)
,`TRAINING_SDATE` date
,`TRAINING_EDATE` date
,`USERNAME` varchar(40)
,`USER_EMAIL` varchar(255)
,`USER_ACTIVE` int(1)
,`USER_IP_ADDRESS` varchar(15)
,`USER_LAST_IP_ADDRESS` varchar(15)
,`USER_LAST_LOGIN` datetime
,`TRAINING_NAME` varchar(100)
,`TRAINING_AREA_LEVEL_NAME` varchar(100)
,`TRAINING_AREA_LEVEL_TYPE` varchar(100)
,`TRAINING_BENEFICIARIES_NAME` varchar(100)
,`TRAINING_FUNDING_SOURCE_CITY_ID` int(19)
,`TRAINING_FUNDING_SOURCE_PROVINCE_ID` int(19)
,`TRAINING_FUNDING_SOURCE_COUNTRY_ID` int(19)
,`TRAINING_FUNDING_SOURCE_NAME` varchar(100)
,`TRAINING_FUNDING_SOURCE_PHONE_NO1` varchar(20)
,`TRAINING_FUNDING_SOURCE_PHONE_NO2` varchar(20)
,`TRAINING_FUNDING_SOURCE_EMAIL1` varchar(100)
,`TRAINING_FUNDING_SOURCE_EMAIL2` varchar(100)
,`TRAINNG_FUNDING_SOURCE_WEBSITE` varchar(100)
,`TRAINING_FUNDING_SOURCE_ADDRESS` text
,`TRAINING_VENUE_CITY_ID` int(19)
,`TRAINING_VENUE_PROVINCE_ID` int(19)
,`TRAINING_VENUE_COUNTRY_ID` int(19)
,`TRAINING_VENUE_NAME` varchar(100)
,`TRAINING_VENUE_PHONE_NO1` varchar(20)
,`TRAINING_VENUE_PHONE_NO2` varchar(20)
,`TRAINING_VENUE_EMAIL1` varchar(100)
,`TRAINING_VENUE_EMAIL2` varchar(100)
,`TRAINING_VENUE_WEBSITE` varchar(100)
,`TRAINING_VENUE_ADDRESS` text
,`TRAINING_ORGANIZATION_CITY_ID` int(19)
,`TRAINING_ORGANIZATION_PROVINCE_ID` int(19)
,`TRAINING_ORGANIZATION_COUNTRY_ID` int(19)
,`TRAINING_ORGANIZATION_NAME` varchar(100)
,`TRAINING_ORGANIZATION_PHONE_NO1` varchar(20)
,`TRAINING_ORGANIZATION_PHONE_NO2` varchar(20)
,`TRAINING_ORGANIZATION_EMAIL1` varchar(100)
,`TRAINING_ORGANIZATION_EMAIL2` varchar(100)
,`TRAINING_ORGANIZATION_WEBSITE` varchar(100)
,`TRAINING_ORGANIZATION_ADDRESS` text
,`CITY_NAME` varchar(100)
,`PROVINCE_NAME` varchar(100)
,`COUNTRY_NAME` varchar(100)
,`TRAINER_NAME` varchar(100)
,`TRAINER_NICKNAME` varchar(100)
,`TRAINER_GENDER` varchar(100)
,`TRAINER_ADDRESS` text
,`TRAINER_BDATE` date
,`TRAINER_MOBILE_NO` varchar(20)
,`TRAINER_PHONE_NO` varchar(20)
,`TRAINER_EMAIL1` varchar(100)
,`TRAINER_EMAIL2` varchar(100)
,`TRAINER_FB` varchar(100)
,`TRAINER_TWITTER` varchar(100)
,`ROLE_NAME` varchar(100)
);
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `USERS`
--

INSERT INTO `USERS` (`USER_ID`, `USERNAME`, `PASSWORD`, `EMAIL`, `ACTIVE`, `IP_ADDRESS`, `LAST_IP_ADDRESS`, `LAST_LOGIN`, `CREATED_DATE`, `MODIFIED_DATE`) VALUES
(1, 'admin', '7b3311da916a2454a0c47a6aa2e0c69279a6b85e', 'admin@satudunia.com', 1, '127.0.0.1', '127.0.0.1', '2013-10-21 10:59:34', '2013-06-28 15:49:48', '2013-10-21 03:59:34');

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

-- --------------------------------------------------------

--
-- Structure for view `MS_AREA_LEVELS_VIEW`
--
DROP TABLE IF EXISTS `MS_AREA_LEVELS_VIEW`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `MS_AREA_LEVELS_VIEW` AS select `MS_AREA_LEVELS`.`ID` AS `ID`,concat(`MS_AREA_LEVELS`.`NAME`,' [',`MS_AREA_LEVELS`.`TYPE`,']') AS `DISPLAY_NAME`,`MS_AREA_LEVELS`.`NAME` AS `NAME`,`MS_AREA_LEVELS`.`TYPE` AS `TYPE`,`MS_AREA_LEVELS`.`CREATED_DATE` AS `CREATED_DATE`,`MS_AREA_LEVELS`.`MODIFIED_DATE` AS `MODIFIED_DATE` from `MS_AREA_LEVELS`;

-- --------------------------------------------------------

--
-- Structure for view `MS_FUNDING_SOURCES_VIEW`
--
DROP TABLE IF EXISTS `MS_FUNDING_SOURCES_VIEW`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `MS_FUNDING_SOURCES_VIEW` AS select `fsr`.`ID` AS `ID`,`fsr`.`CITY_ID` AS `CITY_ID`,`cty`.`NAME` AS `CITY_NAME`,`fsr`.`PROVINCE_ID` AS `PROVINCE_ID`,`prv`.`NAME` AS `PROVINCE_NAME`,`fsr`.`COUNTRY_ID` AS `COUNTRY_ID`,`ctr`.`NAME` AS `COUNTRY_NAME`,`fsr`.`NAME` AS `NAME`,`fsr`.`PHONE_NO1` AS `PHONE_NO1`,`fsr`.`PHONE_NO2` AS `PHONE_NO2`,`fsr`.`EMAIL1` AS `EMAIL1`,`fsr`.`EMAIL2` AS `EMAIL2`,`fsr`.`WEBSITE` AS `WEBSITE`,`fsr`.`ADDRESS` AS `ADDRESS`,`fsr`.`CREATED_DATE` AS `CREATED_DATE`,`fsr`.`MODIFIED_DATE` AS `MODIFIED_DATE` from (((`MS_CITY` `cty` join `MS_COUNTRY` `ctr`) join `MS_PROVINCE` `prv`) join `MS_FUNDING_SOURCES` `fsr`) where ((`fsr`.`CITY_ID` = `cty`.`ID`) and (`fsr`.`COUNTRY_ID` = `ctr`.`ID`) and (`fsr`.`PROVINCE_ID` = `prv`.`ID`));

-- --------------------------------------------------------

--
-- Structure for view `MS_ORGANIZATIONS_UPLOAD_VIEW`
--
DROP TABLE IF EXISTS `MS_ORGANIZATIONS_UPLOAD_VIEW`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `MS_ORGANIZATIONS_UPLOAD_VIEW` AS select `MS_ORGANIZATIONS_UPLOAD`.`ID` AS `ID`,`MS_ORGANIZATIONS_UPLOAD`.`ORGANIZATION_ID` AS `ORGANIZATION_ID`,`MS_ORGANIZATIONS`.`NAME` AS `ORGANIZATION_NAME`,`MS_ORGANIZATIONS_UPLOAD`.`FILE_NAME` AS `FILE_NAME`,`MS_ORGANIZATIONS_UPLOAD`.`TRAINING_ID` AS `TRAINING_ID`,`MS_TRAININGS`.`NAME` AS `TRAINING_NAME`,`MS_ORGANIZATIONS_UPLOAD`.`FILE_SIZE` AS `FILE_SIZE`,`MS_ORGANIZATIONS_UPLOAD`.`FILE_MIME_TYPE` AS `FILE_MIME_TYPE`,`MS_ORGANIZATIONS_UPLOAD`.`FILE_PATH` AS `FILE_PATH`,`MS_ORGANIZATIONS_UPLOAD`.`CREATED_DATE` AS `CREATED_DATE`,`MS_ORGANIZATIONS_UPLOAD`.`MODIFIED_DATE` AS `MODIFIED_DATE` from ((`MS_ORGANIZATIONS_UPLOAD` join `MS_ORGANIZATIONS` on((`MS_ORGANIZATIONS`.`ID` = `MS_ORGANIZATIONS_UPLOAD`.`ORGANIZATION_ID`))) join `MS_TRAININGS` on((`MS_ORGANIZATIONS_UPLOAD`.`TRAINING_ID` = `MS_TRAININGS`.`ID`)));

-- --------------------------------------------------------

--
-- Structure for view `MS_ORGANIZATIONS_VIEW`
--
DROP TABLE IF EXISTS `MS_ORGANIZATIONS_VIEW`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `MS_ORGANIZATIONS_VIEW` AS select `org`.`ID` AS `ID`,`org`.`CITY_ID` AS `CITY_ID`,`cty`.`NAME` AS `CITY_NAME`,`org`.`PROVINCE_ID` AS `PROVINCE_ID`,`prv`.`NAME` AS `PROVINCE_NAME`,`org`.`COUNTRY_ID` AS `COUNTRY_ID`,`ctr`.`NAME` AS `COUNTRY_NAME`,`org`.`NAME` AS `NAME`,`org`.`PHONE_NO1` AS `PHONE_NO1`,`org`.`PHONE_NO2` AS `PHONE_NO2`,`org`.`EMAIL1` AS `EMAIL1`,`org`.`EMAIL2` AS `EMAIL2`,`org`.`WEBSITE` AS `WEBSITE`,`org`.`ADDRESS` AS `ADDRESS`,`org`.`CREATED_DATE` AS `CREATED_DATE`,`org`.`MODIFIED_DATE` AS `MODIFIED_DATE` from (((`MS_CITY` `cty` join `MS_COUNTRY` `ctr`) join `MS_PROVINCE` `prv`) join `MS_ORGANIZATIONS` `org`) where ((`org`.`CITY_ID` = `cty`.`ID`) and (`org`.`COUNTRY_ID` = `ctr`.`ID`) and (`org`.`PROVINCE_ID` = `prv`.`ID`));

-- --------------------------------------------------------

--
-- Structure for view `MS_PARTICIPANTS_VIEW`
--
DROP TABLE IF EXISTS `MS_PARTICIPANTS_VIEW`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `MS_PARTICIPANTS_VIEW` AS select `MS_PARTICIPANTS`.`ID` AS `ID`,concat(`MS_PARTICIPANTS`.`FNAME`,' ',`MS_PARTICIPANTS`.`MNAME`,' ',`MS_PARTICIPANTS`.`LNAME`) AS `NAME`,`MS_PARTICIPANTS`.`FNAME` AS `FNAME`,`MS_PARTICIPANTS`.`MNAME` AS `MNAME`,`MS_PARTICIPANTS`.`LNAME` AS `LNAME`,`MS_PARTICIPANTS`.`SNAME` AS `SNAME`,`MS_PARTICIPANTS`.`GENDER` AS `GENDER`,`MS_PARTICIPANTS`.`BDATE` AS `BDATE`,`MS_PARTICIPANTS`.`MOBILE_NO` AS `MOBILE_NO`,`MS_PARTICIPANTS`.`PHONE_NO` AS `PHONE_NO`,`MS_PARTICIPANTS`.`EMAIL1` AS `EMAIL1`,`MS_PARTICIPANTS`.`EMAIL2` AS `EMAIL2`,`MS_PARTICIPANTS`.`FB` AS `FB`,`MS_PARTICIPANTS`.`TWITTER` AS `TWITTER`,`MS_PARTICIPANTS`.`CREATED_DATE` AS `CREATED_DATE`,`MS_PARTICIPANTS`.`MODIFIED_DATE` AS `MODIFIED_DATE` from `MS_PARTICIPANTS`;

-- --------------------------------------------------------

--
-- Structure for view `MS_VENUES_VIEW`
--
DROP TABLE IF EXISTS `MS_VENUES_VIEW`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `MS_VENUES_VIEW` AS select `org`.`ID` AS `ID`,`org`.`CITY_ID` AS `CITY_ID`,`cty`.`NAME` AS `CITY_NAME`,`org`.`COUNTRY_ID` AS `COUNTRY_ID`,`org`.`PROVINCE_ID` AS `PROVINCE_ID`,`prv`.`NAME` AS `PROVINCE_NAME`,`ctr`.`NAME` AS `COUNTRY_NAME`,`org`.`NAME` AS `NAME`,`org`.`PHONE_NO1` AS `PHONE_NO1`,`org`.`PHONE_NO2` AS `PHONE_NO2`,`org`.`EMAIL1` AS `EMAIL1`,`org`.`EMAIL2` AS `EMAIL2`,`org`.`WEBSITE` AS `WEBSITE`,`org`.`ADDRESS` AS `ADDRESS`,`org`.`CREATED_DATE` AS `CREATED_DATE`,`org`.`MODIFIED_DATE` AS `MODIFIED_DATE` from (((`MS_CITY` `cty` join `MS_COUNTRY` `ctr`) join `MS_PROVINCE` `prv`) join `MS_VENUES` `org`) where ((`org`.`CITY_ID` = `cty`.`ID`) and (`org`.`COUNTRY_ID` = `ctr`.`ID`) and (`org`.`PROVINCE_ID` = `prv`.`ID`));

-- --------------------------------------------------------

--
-- Structure for view `TR_TRAININGS_VIEW`
--
DROP TABLE IF EXISTS `TR_TRAININGS_VIEW`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `TR_TRAININGS_VIEW` AS select `trtr`.`ID` AS `ID`,`trtr`.`USER_ID` AS `USER_ID`,`usr`.`USERNAME` AS `USERNAME`,`trtr`.`TRAINING_ID` AS `TRAINING_ID`,`mstr`.`NAME` AS `TRAINING_NAME`,`trtr`.`AREA_LEVEL_ID` AS `AREA_LEVEL_ID`,`msal`.`NAME` AS `AREA_LEVEL_NAME`,`trtr`.`BENEFICIARIES_ID` AS `BENEFICIARIES_ID`,`msbf`.`NAME` AS `BENEFICIARIES_NAME`,`trtr`.`FUNDING_SOURCE_ID` AS `FUNDING_SOURCE_ID`,`msfs`.`NAME` AS `FUNDING_SOURCE_NAME`,`msfs`.`CITY_ID` AS `FUNDING_SOURCE_CITY_ID`,`msfs`.`CITY_NAME` AS `FUNDING_SOURCE_CITY_NAME`,`msfs`.`PROVINCE_ID` AS `FUNDING_SOURCE_PROVINCE_ID`,`msfs`.`PROVINCE_NAME` AS `FUNDING_SOURCE_PROVINCE_NAME`,`msfs`.`COUNTRY_ID` AS `FUNDING_SOURCE_COUNTRY_ID`,`msfs`.`COUNTRY_NAME` AS `FUNDING_SOURCE_COUNTRY_NAME`,`msfs`.`PHONE_NO1` AS `FUNDING_SOURCE_PHONE_NO1`,`msfs`.`PHONE_NO2` AS `FUNDING_SOURCE_PHONE_NO2`,`msfs`.`EMAIL1` AS `FUNDING_SOURCE_EMAIL1`,`msfs`.`EMAIL2` AS `FUNDING_SOURCE_EMAIL2`,`msfs`.`WEBSITE` AS `FUNDING_SOURCE_WEBSITE`,`msfs`.`ADDRESS` AS `FUNDING_SOURCE_ADDRESS`,`trtr`.`VENUE_ID` AS `VENUE_ID`,`msvn`.`NAME` AS `VENUE_NAME`,`msvn`.`CITY_ID` AS `VENUE_CITY_ID`,`msvn`.`CITY_NAME` AS `VENUE_CITY_NAME`,`msvn`.`PROVINCE_ID` AS `VENUE_PROVINCE_ID`,`msvn`.`PROVINCE_NAME` AS `VENUE_PROVINCE_NAME`,`msvn`.`COUNTRY_ID` AS `VENUE_COUNTRY_ID`,`msvn`.`COUNTRY_NAME` AS `VENUE_COUNTRY_NAME`,`msvn`.`PHONE_NO1` AS `VENUE_PHONE_NO1`,`msvn`.`PHONE_NO2` AS `VENUE_PHONE_NO2`,`msvn`.`EMAIL1` AS `VENUE_EMAIL1`,`msvn`.`EMAIL2` AS `VENUE_EMAIL2`,`msvn`.`WEBSITE` AS `VENUE_WEBSITE`,`msvn`.`ADDRESS` AS `VENUE_ADDRESS`,`trtr`.`ORGANIZATION_ID` AS `ORGANIZATION_ID`,`msor`.`NAME` AS `ORGANIZATION_NAME`,`msor`.`CITY_ID` AS `ORGANIZATION_CITY_ID`,`msor`.`CITY_NAME` AS `ORGANIZATION_CITY_NAME`,`msor`.`PROVINCE_ID` AS `ORGANIZATION_PROVINCE_ID`,`msor`.`PROVINCE_NAME` AS `ORGANIZATION_PROVINCE_NAME`,`msor`.`COUNTRY_ID` AS `ORGANIZATION_COUNTRY_ID`,`msor`.`COUNTRY_NAME` AS `ORGANIZATION_COUNTRY_NAME`,`msor`.`PHONE_NO1` AS `ORGANIZATION_PHONE_NO1`,`msor`.`PHONE_NO2` AS `ORGANIZATION_PHONE_NO2`,`msor`.`EMAIL1` AS `ORGANIZATION_EMAIL1`,`msor`.`EMAIL2` AS `ORGANIZATION_EMAIL2`,`msor`.`WEBSITE` AS `ORGANIZATION_WEBSITE`,`msor`.`ADDRESS` AS `ORGANIZATION_ADDRESS`,`trtr`.`SDATE` AS `SDATE`,`trtr`.`EDATE` AS `EDATE`,`trtr`.`CREATED_DATE` AS `CREATED_DATE`,`trtr`.`MODIFIED_DATE` AS `MODIFIED_DATE` from (((((((`TR_TRAININGS` `trtr` join `USERS` `usr`) join `MS_TRAININGS` `mstr`) join `MS_AREA_LEVELS` `msal`) join `MS_BENEFICIARIES` `msbf`) join `MS_FUNDING_SOURCES_VIEW` `msfs`) join `MS_VENUES_VIEW` `msvn`) join `MS_ORGANIZATIONS_VIEW` `msor`) where ((`trtr`.`USER_ID` = `usr`.`USER_ID`) and (`trtr`.`TRAINING_ID` = `mstr`.`ID`) and (`trtr`.`AREA_LEVEL_ID` = `msal`.`ID`) and (`trtr`.`BENEFICIARIES_ID` = `msbf`.`ID`) and (`trtr`.`FUNDING_SOURCE_ID` = `msfs`.`ID`) and (`trtr`.`VENUE_ID` = `msvn`.`ID`) and (`trtr`.`ORGANIZATION_ID` = `msor`.`ID`));

-- --------------------------------------------------------

--
-- Structure for view `TR_TRAINING_PARTICIPANTS_VIEW`
--
DROP TABLE IF EXISTS `TR_TRAINING_PARTICIPANTS_VIEW`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `TR_TRAINING_PARTICIPANTS_VIEW` AS select `TR_TRAINING_PARTICIPANTS`.`ID` AS `ID`,`TR_TRAINING_PARTICIPANTS`.`TRAINING_ID` AS `TRAINING_ID`,`MS_TRAININGS`.`NAME` AS `TRAINING_NAME`,`MS_PARTICIPANTS`.`ID` AS `PARTICIPANT_ID`,concat(`MS_PARTICIPANTS`.`FNAME`,' ',`MS_PARTICIPANTS`.`MNAME`,' ',`MS_PARTICIPANTS`.`LNAME`) AS `PARTICIPANT_NAME`,`MS_PARTICIPANTS`.`FNAME` AS `PARTICIPANT_FNAME`,`MS_PARTICIPANTS`.`MNAME` AS `PARTICIPANT_MNAME`,`MS_PARTICIPANTS`.`LNAME` AS `PARTICIPANT_LNAME`,`MS_PARTICIPANTS`.`SNAME` AS `PARTICIPANT_SNAME`,`MS_PARTICIPANTS`.`GENDER` AS `PARTICIPANT_GENDER`,`MS_PARTICIPANTS`.`BDATE` AS `PARTICIPANT_BDATE`,`MS_PARTICIPANTS`.`MOBILE_NO` AS `PARTICIPANT_MOBILE_NO`,`MS_PARTICIPANTS`.`PHONE_NO` AS `PARTCIPANT_PHONE_NO`,`MS_PARTICIPANTS`.`EMAIL1` AS `PARTICIPANT_EMAIL1`,`MS_PARTICIPANTS`.`EMAIL2` AS `PARTICIPANT_EMAIL2`,`MS_PARTICIPANTS`.`FB` AS `PARTICIPANT_FB`,`MS_PARTICIPANTS`.`TWITTER` AS `PARTICIPANT_TWITTER`,`MS_ORGANIZATIONS`.`ID` AS `ORGANIZATION_ID`,`MS_ORGANIZATIONS`.`CITY_ID` AS `ORGANIZATION_CITY_ID`,`MS_CITY`.`NAME` AS `ORGANIZATION_CITY_NAME`,`MS_ORGANIZATIONS`.`PROVINCE_ID` AS `ORGANIZATION_PROVINCE_ID`,`MS_PROVINCE`.`NAME` AS `ORGANIZATION_PROVINCE_NAME`,`MS_ORGANIZATIONS`.`COUNTRY_ID` AS `ORGANIZATION_COUNTRY_ID`,`MS_COUNTRY`.`NAME` AS `ORGANIZATION_COUNTRY_NAME`,`MS_ORGANIZATIONS`.`NAME` AS `ORGANIZATION_NAME`,`MS_ORGANIZATIONS`.`PHONE_NO1` AS `ORGANIZATION_PHONE_NO1`,`MS_ORGANIZATIONS`.`PHONE_NO2` AS `ORGANIZATION_PHONE_NO2`,`MS_ORGANIZATIONS`.`EMAIL1` AS `ORGANIZATION_EMAIL1`,`MS_ORGANIZATIONS`.`EMAIL2` AS `ORGANIZATION_EMAIL2`,`MS_ORGANIZATIONS`.`WEBSITE` AS `ORGANIZATION_WEBSITE`,`MS_ORGANIZATIONS`.`ADDRESS` AS `ORGANIZATION_ADDRESS`,`TR_TRAINING_PARTICIPANTS`.`POSITION_ID` AS `POSITION_ID`,`MS_POSITIONS`.`NAME` AS `POSITION_NAME`,`TR_TRAINING_PARTICIPANTS`.`PRE_TEST` AS `PRE_TEST`,`TR_TRAINING_PARTICIPANTS`.`POST_TEST` AS `POST_TEST`,`TR_TRAINING_PARTICIPANTS`.`DIFF` AS `DIFF`,`TR_TRAINING_PARTICIPANTS`.`CREATED_DATE` AS `CREATED_DATE`,`TR_TRAINING_PARTICIPANTS`.`MODIFIED_DATE` AS `MODIFIED_DATE` from ((((((((`TR_TRAINING_PARTICIPANTS` join `TR_TRAININGS` on((`TR_TRAINING_PARTICIPANTS`.`TRAINING_ID` = `TR_TRAININGS`.`ID`))) join `MS_TRAININGS` on((`TR_TRAININGS`.`TRAINING_ID` = `MS_TRAININGS`.`ID`))) join `MS_PARTICIPANTS` on((`TR_TRAINING_PARTICIPANTS`.`PARTICIPANT_ID` = `MS_PARTICIPANTS`.`ID`))) join `MS_ORGANIZATIONS` on((`TR_TRAINING_PARTICIPANTS`.`ORGANIZATION_ID` = `MS_ORGANIZATIONS`.`ID`))) join `MS_POSITIONS` on((`TR_TRAINING_PARTICIPANTS`.`POSITION_ID` = `MS_POSITIONS`.`ID`))) join `MS_CITY` on((`MS_ORGANIZATIONS`.`CITY_ID` = `MS_CITY`.`ID`))) join `MS_PROVINCE` on((`MS_ORGANIZATIONS`.`PROVINCE_ID` = `MS_PROVINCE`.`ID`))) join `MS_COUNTRY` on((`MS_ORGANIZATIONS`.`COUNTRY_ID` = `MS_COUNTRY`.`ID`)));

-- --------------------------------------------------------

--
-- Structure for view `TR_TRAINING_TRAINERS_VIEW`
--
DROP TABLE IF EXISTS `TR_TRAINING_TRAINERS_VIEW`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `TR_TRAINING_TRAINERS_VIEW` AS select `TR_TRAINING_TRAINERS`.`ID` AS `ID`,`TR_TRAINING_TRAINERS`.`TRAINING_ID` AS `TR_TRAININGS_ID`,`TR_TRAINING_TRAINERS`.`TRAINER_ID` AS `TRAINER_ID`,`TR_TRAINING_TRAINERS`.`ROLE_ID` AS `ROLE_ID`,`TR_TRAINING_TRAINERS`.`CITY_ID` AS `CITY_ID`,`TR_TRAINING_TRAINERS`.`PROVINCE_ID` AS `PROVINCE_ID`,`TR_TRAINING_TRAINERS`.`COUNTRY_ID` AS `COUNTRY_ID`,`TR_TRAINING_TRAINERS`.`CV_NAME` AS `CV_NAME`,`TR_TRAINING_TRAINERS`.`CV_PATH` AS `CV_PATH`,`TR_TRAINING_TRAINERS`.`CV_MIME_TYPE` AS `CV_MIME_TYPE`,`TR_TRAINING_TRAINERS`.`CV_SIZE` AS `CV_SIZE`,`TR_TRAINING_TRAINERS`.`CREATED_DATE` AS `CREATED_DATE`,`TR_TRAINING_TRAINERS`.`MODIFIED_DATE` AS `MODIFIED_DATE`,`TR_TRAININGS`.`USER_ID` AS `TRAINING_USER_ID`,`TR_TRAININGS`.`TRAINING_ID` AS `TRAINING_ID`,`TR_TRAININGS`.`AREA_LEVEL_ID` AS `TRAINING_AREA_LEVEL_ID`,`TR_TRAININGS`.`BENEFICIARIES_ID` AS `TRAINING_BENEFICIARIES_ID`,`TR_TRAININGS`.`FUNDING_SOURCE_ID` AS `TRAINING_FUNDING_SOURCE_ID`,`TR_TRAININGS`.`VENUE_ID` AS `TRAINING_VENUE_ID`,`TR_TRAININGS`.`ORGANIZATION_ID` AS `TRAINING_ORGANIZATION_ID`,`TR_TRAININGS`.`SDATE` AS `TRAINING_SDATE`,`TR_TRAININGS`.`EDATE` AS `TRAINING_EDATE`,`USERS`.`USERNAME` AS `USERNAME`,`USERS`.`EMAIL` AS `USER_EMAIL`,`USERS`.`ACTIVE` AS `USER_ACTIVE`,`USERS`.`IP_ADDRESS` AS `USER_IP_ADDRESS`,`USERS`.`LAST_IP_ADDRESS` AS `USER_LAST_IP_ADDRESS`,`USERS`.`LAST_LOGIN` AS `USER_LAST_LOGIN`,`MS_TRAININGS`.`NAME` AS `TRAINING_NAME`,`MS_AREA_LEVELS`.`NAME` AS `TRAINING_AREA_LEVEL_NAME`,`MS_AREA_LEVELS`.`TYPE` AS `TRAINING_AREA_LEVEL_TYPE`,`MS_BENEFICIARIES`.`NAME` AS `TRAINING_BENEFICIARIES_NAME`,`MS_FUNDING_SOURCES`.`CITY_ID` AS `TRAINING_FUNDING_SOURCE_CITY_ID`,`MS_FUNDING_SOURCES`.`PROVINCE_ID` AS `TRAINING_FUNDING_SOURCE_PROVINCE_ID`,`MS_FUNDING_SOURCES`.`COUNTRY_ID` AS `TRAINING_FUNDING_SOURCE_COUNTRY_ID`,`MS_FUNDING_SOURCES`.`NAME` AS `TRAINING_FUNDING_SOURCE_NAME`,`MS_FUNDING_SOURCES`.`PHONE_NO1` AS `TRAINING_FUNDING_SOURCE_PHONE_NO1`,`MS_FUNDING_SOURCES`.`PHONE_NO2` AS `TRAINING_FUNDING_SOURCE_PHONE_NO2`,`MS_FUNDING_SOURCES`.`EMAIL1` AS `TRAINING_FUNDING_SOURCE_EMAIL1`,`MS_FUNDING_SOURCES`.`EMAIL2` AS `TRAINING_FUNDING_SOURCE_EMAIL2`,`MS_FUNDING_SOURCES`.`WEBSITE` AS `TRAINNG_FUNDING_SOURCE_WEBSITE`,`MS_FUNDING_SOURCES`.`ADDRESS` AS `TRAINING_FUNDING_SOURCE_ADDRESS`,`MS_VENUES`.`CITY_ID` AS `TRAINING_VENUE_CITY_ID`,`MS_VENUES`.`PROVINCE_ID` AS `TRAINING_VENUE_PROVINCE_ID`,`MS_VENUES`.`COUNTRY_ID` AS `TRAINING_VENUE_COUNTRY_ID`,`MS_VENUES`.`NAME` AS `TRAINING_VENUE_NAME`,`MS_VENUES`.`PHONE_NO1` AS `TRAINING_VENUE_PHONE_NO1`,`MS_VENUES`.`PHONE_NO2` AS `TRAINING_VENUE_PHONE_NO2`,`MS_VENUES`.`EMAIL1` AS `TRAINING_VENUE_EMAIL1`,`MS_VENUES`.`EMAIL2` AS `TRAINING_VENUE_EMAIL2`,`MS_VENUES`.`WEBSITE` AS `TRAINING_VENUE_WEBSITE`,`MS_VENUES`.`ADDRESS` AS `TRAINING_VENUE_ADDRESS`,`MS_ORGANIZATIONS`.`CITY_ID` AS `TRAINING_ORGANIZATION_CITY_ID`,`MS_ORGANIZATIONS`.`PROVINCE_ID` AS `TRAINING_ORGANIZATION_PROVINCE_ID`,`MS_ORGANIZATIONS`.`COUNTRY_ID` AS `TRAINING_ORGANIZATION_COUNTRY_ID`,`MS_ORGANIZATIONS`.`NAME` AS `TRAINING_ORGANIZATION_NAME`,`MS_ORGANIZATIONS`.`PHONE_NO1` AS `TRAINING_ORGANIZATION_PHONE_NO1`,`MS_ORGANIZATIONS`.`PHONE_NO2` AS `TRAINING_ORGANIZATION_PHONE_NO2`,`MS_ORGANIZATIONS`.`EMAIL1` AS `TRAINING_ORGANIZATION_EMAIL1`,`MS_ORGANIZATIONS`.`EMAIL2` AS `TRAINING_ORGANIZATION_EMAIL2`,`MS_ORGANIZATIONS`.`WEBSITE` AS `TRAINING_ORGANIZATION_WEBSITE`,`MS_ORGANIZATIONS`.`ADDRESS` AS `TRAINING_ORGANIZATION_ADDRESS`,`CITYTR`.`NAME` AS `CITY_NAME`,`PROVINCETR`.`NAME` AS `PROVINCE_NAME`,`COUNTRYTR`.`NAME` AS `COUNTRY_NAME`,`MS_TRAINERS`.`NAME` AS `TRAINER_NAME`,`MS_TRAINERS`.`NICKNAME` AS `TRAINER_NICKNAME`,`MS_TRAINERS`.`GENDER` AS `TRAINER_GENDER`,`MS_TRAINERS`.`ADDRESS` AS `TRAINER_ADDRESS`,`MS_TRAINERS`.`BDATE` AS `TRAINER_BDATE`,`MS_TRAINERS`.`MOBILE_NO` AS `TRAINER_MOBILE_NO`,`MS_TRAINERS`.`PHONE_NO` AS `TRAINER_PHONE_NO`,`MS_TRAINERS`.`EMAIL1` AS `TRAINER_EMAIL1`,`MS_TRAINERS`.`EMAIL2` AS `TRAINER_EMAIL2`,`MS_TRAINERS`.`FB` AS `TRAINER_FB`,`MS_TRAINERS`.`TWITTER` AS `TRAINER_TWITTER`,`MS_ROLES`.`NAME` AS `ROLE_NAME` from (((((((((((((`TR_TRAINING_TRAINERS` join `TR_TRAININGS` on((`TR_TRAINING_TRAINERS`.`TRAINING_ID` = `TR_TRAININGS`.`ID`))) join `USERS` on((`TR_TRAININGS`.`USER_ID` = `USERS`.`USER_ID`))) join `MS_TRAININGS` on((`TR_TRAININGS`.`TRAINING_ID` = `MS_TRAININGS`.`ID`))) join `MS_AREA_LEVELS` on((`TR_TRAININGS`.`AREA_LEVEL_ID` = `MS_AREA_LEVELS`.`ID`))) join `MS_BENEFICIARIES` on((`TR_TRAININGS`.`BENEFICIARIES_ID` = `MS_BENEFICIARIES`.`ID`))) join `MS_FUNDING_SOURCES` on((`TR_TRAININGS`.`FUNDING_SOURCE_ID` = `MS_FUNDING_SOURCES`.`ID`))) join `MS_VENUES` on((`TR_TRAININGS`.`VENUE_ID` = `MS_VENUES`.`ID`))) join `MS_ORGANIZATIONS` on((`TR_TRAININGS`.`ORGANIZATION_ID` = `MS_ORGANIZATIONS`.`ID`))) join `MS_CITY` `CITYTR` on((`TR_TRAINING_TRAINERS`.`CITY_ID` = `CITYTR`.`ID`))) join `MS_PROVINCE` `PROVINCETR` on((`TR_TRAINING_TRAINERS`.`PROVINCE_ID` = `PROVINCETR`.`ID`))) join `MS_COUNTRY` `COUNTRYTR` on((`TR_TRAINING_TRAINERS`.`COUNTRY_ID` = `COUNTRYTR`.`ID`))) join `MS_TRAINERS` on((`TR_TRAINING_TRAINERS`.`TRAINER_ID` = `MS_TRAINERS`.`ID`))) join `MS_ROLES` on((`TR_TRAINING_TRAINERS`.`ROLE_ID` = `MS_ROLES`.`ID`)));

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
-- Constraints for table `MS_FUNDING_SOURCES`
--
ALTER TABLE `MS_FUNDING_SOURCES`
  ADD CONSTRAINT `fk_CITY_ID` FOREIGN KEY (`CITY_ID`) REFERENCES `MS_CITY` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_COUNTRY_ID` FOREIGN KEY (`COUNTRY_ID`) REFERENCES `MS_COUNTRY` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `MS_FUNDING_SOURCES_ibfk_1` FOREIGN KEY (`PROVINCE_ID`) REFERENCES `MS_PROVINCE` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `MS_ORGANIZATIONS`
--
ALTER TABLE `MS_ORGANIZATIONS`
  ADD CONSTRAINT `MS_ORGANIZATIONS_ibfk_1` FOREIGN KEY (`CITY_ID`) REFERENCES `MS_CITY` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `MS_ORGANIZATIONS_ibfk_2` FOREIGN KEY (`COUNTRY_ID`) REFERENCES `MS_COUNTRY` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `MS_ORGANIZATIONS_ibfk_3` FOREIGN KEY (`PROVINCE_ID`) REFERENCES `MS_PROVINCE` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `MS_PROVINCE`
--
ALTER TABLE `MS_PROVINCE`
  ADD CONSTRAINT `MS_PROVINCE_ibfk_1` FOREIGN KEY (`COUNTRY_ID`) REFERENCES `MS_COUNTRY` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `MS_VENUES`
--
ALTER TABLE `MS_VENUES`
  ADD CONSTRAINT `MS_VENUES_ibfk_1` FOREIGN KEY (`CITY_ID`) REFERENCES `MS_CITY` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `MS_VENUES_ibfk_2` FOREIGN KEY (`PROVINCE_ID`) REFERENCES `MS_PROVINCE` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `MS_VENUES_ibfk_3` FOREIGN KEY (`COUNTRY_ID`) REFERENCES `MS_COUNTRY` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `PRIVILEGES`
--
ALTER TABLE `PRIVILEGES`
  ADD CONSTRAINT `PRIVILEGES_ibfk_1` FOREIGN KEY (`GROUP_ID`) REFERENCES `GROUPS` (`GROUP_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `PRIVILEGES_ibfk_2` FOREIGN KEY (`MENU_ID`) REFERENCES `MENUS` (`MENU_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

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

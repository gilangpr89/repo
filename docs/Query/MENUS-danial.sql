-- phpMyAdmin SQL Dump
-- version 3.5.8.1
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Aug 22, 2013 at 10:13 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=105 ;

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
(90, 'Report Participants', 1, 4, 'report-participants', 'ACTION', 'icon-pencil', 57, '2013-08-14 10:44:01', '2013-08-15 08:31:22'),
(91, 'Report Organizations', 1, 4, 'report-organizations', 'ACTION', 'icon-pencil', 42, '2013-08-21 10:29:24', '2013-08-21 03:29:24'),
(95, 'Report', 1, 3, NULL, 'MENU', '', 0, '2013-08-21 14:18:55', '2013-08-21 07:18:55'),
(96, 'Participant', 1, 0, 'onReportParticipantsClicked', 'SUBMENU', '', 95, '2013-08-21 14:21:36', '2013-08-22 05:53:34'),
(97, 'Capacity Profile', 1, 0, NULL, 'MENU', '', 95, '2013-08-21 15:38:40', '2013-08-21 10:02:39'),
(98, 'Individual', 1, 0, 'onReportCapacityProfileIndividualClicked', 'SUBMENU', '', 97, '2013-08-21 15:40:15', '2013-08-22 06:50:08'),
(99, 'CBO', 1, 1, 'onReportCapacityProfileCboClicked', 'SUBMENU', '', 97, '2013-08-21 15:41:06', '2013-08-22 08:27:12'),
(100, 'SR (Country)', 1, 1, NULL, 'SUBMENU', '', 97, '2013-08-21 15:41:45', '2013-08-21 08:41:45'),
(101, 'Region', 1, 1, NULL, 'SUBMENU', '', 97, '2013-08-21 15:41:45', '2013-08-21 08:41:45'),
(102, 'Search', 1, 0, 'search', 'ACTION', 'icon-search', 98, '2013-08-21 21:22:55', '2013-08-21 14:23:57'),
(103, 'Print', 1, 1, 'onManageReportindividual', 'ACTION', 'icon-pencil', 98, '2013-08-22 12:55:16', '2013-08-22 05:58:04'),
(104, 'Search', 1, 0, 'search', 'ACTION', 'icon-search', 99, '2013-08-22 20:54:59', '2013-08-22 13:54:59');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

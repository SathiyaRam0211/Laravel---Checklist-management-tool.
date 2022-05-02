-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2021 at 01:36 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `checklist_manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_log_audit`
--

CREATE TABLE `access_log_audit` (
  `employee_id` varchar(8) COLLATE utf8_bin NOT NULL,
  `last_login` datetime NOT NULL,
  `last_logout` datetime NOT NULL,
  `delete_flag` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `access_log_audit`
--

INSERT INTO `access_log_audit` (`employee_id`, `last_login`, `last_logout`, `delete_flag`) VALUES
('sathie1p', '2021-03-11 16:00:11', '2021-03-11 16:12:35', 0),
('aravin1s', '2021-03-11 16:12:45', '2021-03-11 16:13:31', 0),
('dhines1j', '2021-03-11 15:54:45', '2021-03-11 15:59:54', 0),
('parani1p', '2021-03-11 12:38:00', '2021-03-11 12:39:14', 0);

-- --------------------------------------------------------

--
-- Table structure for table `checkitems_master`
--

CREATE TABLE `checkitems_master` (
  `checklist_id` int(11) NOT NULL,
  `checkitem_id` int(11) NOT NULL,
  `checkitem` varchar(255) COLLATE utf8_bin NOT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `checkitems_master`
--

INSERT INTO `checkitems_master` (`checklist_id`, `checkitem_id`, `checkitem`, `delete_flag`) VALUES
(1, 1, 'M1', 0),
(1, 2, 'M4', 0),
(1, 3, 'Acronis Backup Check', 0),
(2, 1, 'Security log Check', 0),
(2, 2, 'VBCorp Search Policy', 0);

-- --------------------------------------------------------

--
-- Table structure for table `checklist_approval`
--

CREATE TABLE `checklist_approval` (
  `task_id` int(11) NOT NULL,
  `changed_on` datetime NOT NULL DEFAULT current_timestamp(),
  `changed_by` varchar(50) COLLATE utf8_bin NOT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `checklist_approval`
--

INSERT INTO `checklist_approval` (`task_id`, `changed_on`, `changed_by`, `delete_flag`) VALUES
(1, '2021-03-11 15:53:45', 'dhines1j', 0),
(1, '2021-03-11 15:55:15', 'dhines1j', 0);

-- --------------------------------------------------------

--
-- Table structure for table `checklist_assignment`
--

CREATE TABLE `checklist_assignment` (
  `assignment_id` int(11) NOT NULL,
  `checklist_id` int(11) NOT NULL,
  `assigned_to` varchar(50) COLLATE utf8_bin NOT NULL,
  `approver` varchar(50) COLLATE utf8_bin NOT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `checklist_assignment`
--

INSERT INTO `checklist_assignment` (`assignment_id`, `checklist_id`, `assigned_to`, `approver`, `delete_flag`) VALUES
(1, 1, 'aravin1s', 'dhines1j', 0),
(2, 2, 'aravin1s', 'parani1p', 0);

-- --------------------------------------------------------

--
-- Table structure for table `checklist_assignment_task`
--

CREATE TABLE `checklist_assignment_task` (
  `task_id` int(11) NOT NULL,
  `assignment_id` int(11) NOT NULL,
  `assigned_on` datetime NOT NULL DEFAULT current_timestamp(),
  `status_id` int(11) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `checklist_assignment_task`
--

INSERT INTO `checklist_assignment_task` (`task_id`, `assignment_id`, `assigned_on`, `status_id`, `delete_flag`) VALUES
(1, 1, '2021-03-11 15:04:49', 3, 0),
(2, 2, '2021-03-11 16:01:38', 1, 0),
(3, 1, '2021-03-11 16:02:02', 1, 0),
(4, 1, '2021-03-11 16:06:36', 1, 0),
(5, 1, '2021-03-11 16:08:35', 1, 0),
(6, 1, '2021-03-11 16:09:09', 1, 0),
(7, 1, '2021-03-11 16:09:31', 1, 0),
(8, 1, '2021-03-11 16:11:15', 1, 0),
(9, 1, '2021-03-11 16:12:02', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `checklist_data`
--

CREATE TABLE `checklist_data` (
  `task_id` int(11) NOT NULL,
  `checkitem_id` int(11) NOT NULL,
  `value_id` int(11) NOT NULL DEFAULT 1,
  `remarks` varchar(255) COLLATE utf8_bin NOT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `checklist_data`
--

INSERT INTO `checklist_data` (`task_id`, `checkitem_id`, `value_id`, `remarks`, `delete_flag`) VALUES
(1, 1, 2, '', 0),
(1, 2, 2, '', 0),
(1, 3, 3, 'Still having Issue with it.', 0),
(2, 1, 1, '', 0),
(2, 2, 1, '', 0),
(3, 1, 1, '', 0),
(3, 2, 1, '', 0),
(3, 3, 1, '', 0),
(4, 1, 1, '', 0),
(4, 2, 1, '', 0),
(4, 3, 1, '', 0),
(5, 1, 1, '', 0),
(5, 2, 1, '', 0),
(5, 3, 1, '', 0),
(6, 1, 1, '', 0),
(6, 2, 1, '', 0),
(6, 3, 1, '', 0),
(7, 1, 1, '', 0),
(7, 2, 1, '', 0),
(7, 3, 1, '', 0),
(7, 1, 1, '', 0),
(7, 2, 1, '', 0),
(7, 3, 1, '', 0),
(8, 1, 1, '', 0),
(8, 2, 1, '', 0),
(8, 3, 1, '', 0),
(9, 1, 1, '', 0),
(9, 2, 1, '', 0),
(9, 3, 1, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `checklist_execution_value_master`
--

CREATE TABLE `checklist_execution_value_master` (
  `value_id` int(11) NOT NULL,
  `value_name` varchar(30) COLLATE utf8_bin NOT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `checklist_execution_value_master`
--

INSERT INTO `checklist_execution_value_master` (`value_id`, `value_name`, `delete_flag`) VALUES
(1, 'Incomplete', 0),
(2, 'Completed', 0),
(3, 'Excluded', 0);

-- --------------------------------------------------------

--
-- Table structure for table `checklist_master`
--

CREATE TABLE `checklist_master` (
  `checklist_id` int(11) NOT NULL,
  `checklist_name` varchar(100) COLLATE utf8_bin NOT NULL,
  `purpose` varchar(255) COLLATE utf8_bin NOT NULL,
  `created_by` varchar(50) COLLATE utf8_bin NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(50) COLLATE utf8_bin NOT NULL,
  `updated_on` datetime NOT NULL DEFAULT current_timestamp(),
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `checklist_master`
--

INSERT INTO `checklist_master` (`checklist_id`, `checklist_name`, `purpose`, `created_by`, `created_on`, `updated_by`, `updated_on`, `delete_flag`) VALUES
(1, 'Daily Task Monitoring', 'SECPF', 'Sathieaswarram P', '2021-03-11 15:04:11', 'Sathieaswarram P', '2021-03-11 15:04:11', 0),
(2, 'Weekly Task Monitoring', 'SECPF', 'Sathieaswarram P', '2021-03-11 16:01:09', 'Sathieaswarram P', '2021-03-11 16:01:09', 0);

-- --------------------------------------------------------

--
-- Table structure for table `checklist_status_master`
--

CREATE TABLE `checklist_status_master` (
  `status_id` int(11) NOT NULL,
  `status` varchar(50) COLLATE utf8_bin NOT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `checklist_status_master`
--

INSERT INTO `checklist_status_master` (`status_id`, `status`, `delete_flag`) VALUES
(1, 'Incomplete', 0),
(2, 'Submitted', 0),
(3, 'Approved', 0),
(4, 'Rejected', 0);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `task_id` int(11) NOT NULL,
  `comment` varchar(255) COLLATE utf8_bin NOT NULL,
  `created_by` varchar(50) COLLATE utf8_bin NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`task_id`, `comment`, `created_by`, `created_on`, `delete_flag`) VALUES
(1, 'Okay.', 'dhines1j', '2021-03-11 15:04:49', 0),
(2, '', '', '2021-03-11 16:01:38', 0),
(3, '', '', '2021-03-11 16:02:02', 0),
(4, '', '', '2021-03-11 16:06:36', 0),
(5, '', '', '2021-03-11 16:08:35', 0),
(6, '', '', '2021-03-11 16:09:09', 0),
(7, '', '', '2021-03-11 16:09:31', 0),
(7, '', '', '2021-03-11 16:11:11', 0),
(8, '', '', '2021-03-11 16:11:15', 0),
(9, '', '', '2021-03-11 16:12:03', 0);

-- --------------------------------------------------------

--
-- Table structure for table `display_menu_authority`
--

CREATE TABLE `display_menu_authority` (
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `display_menu_authority`
--

INSERT INTO `display_menu_authority` (`role_id`, `menu_id`, `delete_flag`) VALUES
(1, 1, 0),
(1, 2, 0),
(1, 3, 0),
(1, 4, 0),
(1, 5, 0),
(2, 6, 0),
(2, 7, 0),
(3, 8, 0),
(3, 9, 0),
(4, 6, 0),
(4, 7, 0),
(4, 8, 0),
(4, 9, 0);

-- --------------------------------------------------------

--
-- Table structure for table `display_menu_master`
--

CREATE TABLE `display_menu_master` (
  `menu_id` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8_bin NOT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `display_menu_master`
--

INSERT INTO `display_menu_master` (`menu_id`, `title`, `delete_flag`) VALUES
(1, 'Checklists', 0),
(2, 'Assign Checklists', 0),
(3, 'Assignment History', 0),
(4, 'Users', 0),
(5, 'Audit Log', 0),
(6, 'Checklist Execution', 0),
(7, 'User Checklists', 0),
(8, 'Checklist Approval', 0),
(9, 'Approver Checklists', 0);

-- --------------------------------------------------------

--
-- Table structure for table `role_master`
--

CREATE TABLE `role_master` (
  `role_id` int(11) NOT NULL,
  `role` varchar(50) COLLATE utf8_bin NOT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `role_master`
--

INSERT INTO `role_master` (`role_id`, `role`, `delete_flag`) VALUES
(1, 'admin', 0),
(2, 'user', 0),
(3, 'approver', 0),
(4, 'user_approver', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `employee_id` varchar(8) COLLATE utf8_bin NOT NULL,
  `username` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `created_by` varchar(50) COLLATE utf8_bin NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`employee_id`, `username`, `password`, `created_by`, `created_on`, `delete_flag`) VALUES
('aravin1s', 'Aravindh S', '$2y$10$dDt61TBs7JfGctoEkaODgOMmiWta84s2q/RpypHjuCy5/O4iBrQkW', 'Sathieaswarram P', '2021-03-01 08:51:56', 0),
('dhines1j', 'Dhinesh J', '$2y$10$LIlqO2AeldNRvuFGC/uWyuseMV.vBdGHexe3wBfI4lNOR5aVWK8mm', 'Sathieaswarram P', '2021-03-01 08:52:34', 0),
('parani1p', 'Paranikumar P', '$2y$10$M8cWgXPwIW3twJLAzMzFROYw3dMkf5zPk8QMxtPXGj3SG5HXzqPSS', 'Sathieaswarram P', '2021-03-01 08:53:04', 0),
('sathie1p', 'Sathieaswarram P', '$2y$10$Rj0YQjvIR0Aaid.4MIhOPu1JHDM6nnZ/En94HD8g12PYvcMGrRwm6', 'test_admin', '2021-02-25 10:58:19', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_authority`
--

CREATE TABLE `user_authority` (
  `employee_id` varchar(8) COLLATE utf8_bin NOT NULL,
  `role_id` int(11) NOT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `user_authority`
--

INSERT INTO `user_authority` (`employee_id`, `role_id`, `delete_flag`) VALUES
('sathie1p', 1, 0),
('aravin1s', 2, 0),
('dhines1j', 4, 0),
('parani1p', 3, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_log_audit`
--
ALTER TABLE `access_log_audit`
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `checklist_approval`
--
ALTER TABLE `checklist_approval`
  ADD KEY `task_id` (`task_id`);

--
-- Indexes for table `checklist_assignment`
--
ALTER TABLE `checklist_assignment`
  ADD PRIMARY KEY (`assignment_id`),
  ADD KEY `checklist_id` (`checklist_id`);

--
-- Indexes for table `checklist_assignment_task`
--
ALTER TABLE `checklist_assignment_task`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `assignment_id` (`assignment_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `checklist_data`
--
ALTER TABLE `checklist_data`
  ADD KEY `value_id` (`value_id`);

--
-- Indexes for table `checklist_execution_value_master`
--
ALTER TABLE `checklist_execution_value_master`
  ADD PRIMARY KEY (`value_id`);

--
-- Indexes for table `checklist_master`
--
ALTER TABLE `checklist_master`
  ADD PRIMARY KEY (`checklist_id`);

--
-- Indexes for table `checklist_status_master`
--
ALTER TABLE `checklist_status_master`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD KEY `task_id` (`task_id`);

--
-- Indexes for table `display_menu_authority`
--
ALTER TABLE `display_menu_authority`
  ADD KEY `menu_id` (`menu_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `display_menu_master`
--
ALTER TABLE `display_menu_master`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `role_master`
--
ALTER TABLE `role_master`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `user_authority`
--
ALTER TABLE `user_authority`
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checklist_assignment`
--
ALTER TABLE `checklist_assignment`
  MODIFY `assignment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `checklist_assignment_task`
--
ALTER TABLE `checklist_assignment_task`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `checklist_master`
--
ALTER TABLE `checklist_master`
  MODIFY `checklist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `access_log_audit`
--
ALTER TABLE `access_log_audit`
  ADD CONSTRAINT `access_log_audit_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `users` (`employee_id`);

--
-- Constraints for table `checklist_assignment`
--
ALTER TABLE `checklist_assignment`
  ADD CONSTRAINT `checklist_assignment_ibfk_1` FOREIGN KEY (`checklist_id`) REFERENCES `checklist_master` (`checklist_id`);

--
-- Constraints for table `checklist_assignment_task`
--
ALTER TABLE `checklist_assignment_task`
  ADD CONSTRAINT `checklist_assignment_task_ibfk_1` FOREIGN KEY (`assignment_id`) REFERENCES `checklist_assignment` (`assignment_id`),
  ADD CONSTRAINT `checklist_assignment_task_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `checklist_status_master` (`status_id`);

--
-- Constraints for table `display_menu_authority`
--
ALTER TABLE `display_menu_authority`
  ADD CONSTRAINT `display_menu_authority_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `display_menu_master` (`menu_id`),
  ADD CONSTRAINT `display_menu_authority_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `role_master` (`role_id`);

--
-- Constraints for table `user_authority`
--
ALTER TABLE `user_authority`
  ADD CONSTRAINT `user_authority_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `users` (`employee_id`),
  ADD CONSTRAINT `user_authority_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `role_master` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

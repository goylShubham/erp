-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2017 at 01:21 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ierp`
--

-- --------------------------------------------------------

--
-- Table structure for table `aadhar_info`
--

CREATE TABLE `aadhar_info` (
  `aadhar_number` bigint(12) NOT NULL,
  `aadhar_name` varchar(50) NOT NULL,
  `aadhar_address` varchar(100) NOT NULL,
  `aadhar_mobile` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aadhar_info`
--



-- --------------------------------------------------------

--
-- Table structure for table `department_info`
--

CREATE TABLE `department_info` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(50) NOT NULL,
  `department_helpline` bigint(20) NOT NULL,
  `department_icon` varchar(50) NOT NULL,
  `department_vehicle` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department_info`
--



-- --------------------------------------------------------

--
-- Table structure for table `report_info`
--

CREATE TABLE `report_info` (
  `report_id` int(11) NOT NULL,
  `report_by` int(11) NOT NULL,
  `sender_address` varchar(255) NOT NULL,
  `sender_lat` double NOT NULL,
  `sender_lng` double NOT NULL,
  `report_date` varchar(50) NOT NULL,
  `report_time` varchar(10) NOT NULL,
  `report_status` varchar(10) NOT NULL,
  `vehicle_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `report_info`
--



-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `user_id` int(11) NOT NULL,
  `user_aadhar` bigint(12) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_mobile` bigint(10) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_email_verified` tinyint(1) NOT NULL DEFAULT '0',
  `user_mobile_verified` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--



-- --------------------------------------------------------

--
-- Table structure for table `vehicle_info`
--

CREATE TABLE `vehicle_info` (
  `vehicle_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `vehicle_email` varchar(100) NOT NULL,
  `vehicle_lat` float NOT NULL,
  `vehicle_lng` float NOT NULL,
  `vehicle_mobile` bigint(10) NOT NULL,
  `vehicle_password` varchar(255) NOT NULL,
  `vehicle_staus` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle_info`
--


--
-- Indexes for dumped tables
--

--
-- Indexes for table `aadhar_info`
--
ALTER TABLE `aadhar_info`
  ADD PRIMARY KEY (`aadhar_number`),
  ADD KEY `aadhar_number` (`aadhar_number`);

--
-- Indexes for table `department_info`
--
ALTER TABLE `department_info`
  ADD PRIMARY KEY (`department_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `report_info`
--
ALTER TABLE `report_info`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_aadhar_2` (`user_aadhar`),
  ADD UNIQUE KEY `user_email` (`user_email`),
  ADD KEY `user_aadhar` (`user_aadhar`);

--
-- Indexes for table `vehicle_info`
--
ALTER TABLE `vehicle_info`
  ADD PRIMARY KEY (`vehicle_id`),
  ADD KEY `sub_department_id` (`vehicle_id`),
  ADD KEY `department_id` (`department_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department_info`
--
ALTER TABLE `department_info`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `report_info`
--
ALTER TABLE `report_info`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `vehicle_info`
--
ALTER TABLE `vehicle_info`
  MODIFY `vehicle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_info`
--
ALTER TABLE `user_info`
  ADD CONSTRAINT `user_info_ibfk_1` FOREIGN KEY (`user_aadhar`) REFERENCES `aadhar_info` (`aadhar_number`);

--
-- Constraints for table `vehicle_info`
--
ALTER TABLE `vehicle_info`
  ADD CONSTRAINT `vehicle_info_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department_info` (`department_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

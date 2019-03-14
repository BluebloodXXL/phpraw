-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2019 at 10:14 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ssempmanage`
--
CREATE DATABASE IF NOT EXISTS `ssempmanage` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ssempmanage`;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `idU` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(90) DEFAULT NULL,
  `password` text,
  `validation_code` text,
  `active` tinyint(4) DEFAULT '0',
  `r_oll` int(5) DEFAULT '0',
  `department` varchar(50) DEFAULT NULL,
  `Address` text,
  `designation` varchar(500) DEFAULT NULL,
  `dp` blob
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idU`, `first_name`, `last_name`, `email`, `password`, `validation_code`, `active`, `r_oll`, `department`, `Address`, `designation`, `dp`) VALUES
(1, 'Fazlul', 'Haque', 'sc@gmail.com', '202cb962ac59075b964b07152d234b70', '0', 1, 0, 'Software', 'Khilgaon, Dhaka', 'Jr. Web Master', ''),
(2, 'Suzan', 'Chy', 'szC@gmail.com', '202cb962ac59075b964b07152d234b70', '0', 1, 9, 'IT', 'Proshanti Abashik, Colonel Hat, Ctg', 'Jr. Developer', ''),
(4, 'Nasif', 'Shahrier', 'nasif@gmail.com', '202cb962ac59075b964b07152d234b70', '7b1e55266de30e911a4b5ef8addd4b9a', 1, 0, 'Software', 'Akbarsha, Khulshi, Ctg', 'Jr. Developer', ''),
(14, 'Mahir', 'Chowdhury', 'mahir@hotmail.com', '202cb962ac59075b964b07152d234b70', 'e8a5b5b361421b9e098ab1be04a1e3b7', 0, 0, 'HR', 'Firozsha, Khulshi', 'Jr. Recruiter', ''),
(16, 'Macc', 'Millan', 'mac@gmail.com', '202cb962ac59075b964b07152d234b70', '4d3bbce44dae55aa82843587a5a5be7c', 1, 0, 'Software', 'USA', 'Sr. Developer', ''),
(20, 'Abdul', 'Bari', 'bari@gmail.com', '202cb962ac59075b964b07152d234b70', 'b28aff51fd83314a75372f8ed8a0d5ad', 0, 0, 'Accounts and Finance', 'Gulshan, Dhaka', 'DGM', NULL),
(21, 'Sazzad', 'Hossain', 'sz@gmail.com', '202cb962ac59075b964b07152d234b70', '4604649828c342f20896a7fec3e891f1', 1, 0, 'Accounts and Finance', 'Katgor, Chittagong', 'Auditor ', NULL),
(22, 'Rimon', 'Khandakar', 'rimon@gmail.com', '202cb962ac59075b964b07152d234b70', '5284b88da858c421c2045c13e93aa443', 1, 0, 'Software', 'Chawkbazar, Chittagong', 'Sr. IT Officer', NULL),
(23, 'Pollon', 'Barua', 'pollob@gmail.com', '202cb962ac59075b964b07152d234b70', 'fe6141b60679be46f73bd1e9171d0d0c', 1, 0, 'Sales and marketing', 'Mehedibag, Chittagong', 'Marketing Manager', NULL),
(24, 'Soliman', 'Uddin', 'soliman@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '0', 1, 0, 'Security and transport.', 'Chawkbazar, Chittagong', 'Stuff', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idU`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `idU` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

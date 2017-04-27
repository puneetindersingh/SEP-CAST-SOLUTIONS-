-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 09, 2017 at 04:02 AM
-- Server version: 5.6.35
-- PHP Version: 7.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `castsolution`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `name` varchar(30) NOT NULL,
  `address` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `site` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`name`, `address`, `phone`, `site`) VALUES
('ABC', 'na', '01234565qwewqe', 'ABC.comwe'),
('ABC2', 'na', '012', 'abc.com'),
('Microsoft', 'usa', '123456', 'microsift.com'),
('NA', 'asdaswe', 'weasda', 'asdaswe');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `companysite` varchar(30) NOT NULL,
  `jobtitle` varchar(30) NOT NULL,
  `company` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `admin_status` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `account_status` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`firstname`, `lastname`, `email`, `phone`, `companysite`, `jobtitle`, `company`, `password`, `admin_status`, `username`, `account_status`) VALUES
('NA', 'NA', 'Na@Na.com', '123456', '', '', '', 'admin', 'Y', 'admin', 'Y'),
('Amanpreet Singh', ' Gill', 'aman', '123', '  dfvefvfa', 'fvdfs', 'ABC', 'aman', 'N', 'aman', 'N'),
('Harry', 'Potter', 'asd@gmail.com', '61491234561', 'new', 'boss', 'ABC', 'new', 'N', 'new', 'N'),
('Pete', 'Singh', 'puneetindersingh@gmail.com', '6112345678910', 'ABC.com', 'NA', 'ABC2', 'user', 'N', 'user', 'N');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`username`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

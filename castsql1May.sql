-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 01, 2017 at 03:29 AM
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
('ABC', 'na street', '01234565', 'abc.com'),
('ABC2', 'na street', '0124567', 'abc2.com');

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
('Amanpreet Singh', 'Gill', 'aman', '123', 'Abc@abc.com', 'CEO', 'ABC', 'aman', 'N', 'aman', 'Y'),
('Pete', 'Singh', 'puneetindersingh@gmail.com', '12345689', '', '', '', 'cast_admin', 'Y', 'cast_admin', 'Y'),
('Harry', 'Potter', 'asd@gmail.com', '61491234561', 'Abc@abc.com', 'boss', 'ABC', 'harry', 'N', 'harry', 'Y'),
('Honey', 'Singh', 'honeysingh@gmail.com', '2345678910', 'Abc@abc2.com', 'NA', 'ABC2', 'honey', 'N', 'honey', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `user_iframe`
--

CREATE TABLE `user_iframe` (
  `username` varchar(50) NOT NULL,
  `iframe1` varchar(500) NOT NULL,
  `iframe2` varchar(500) NOT NULL,
  `iframe3` varchar(500) NOT NULL,
  `iframe4` varchar(500) NOT NULL,
  `iframe5` varchar(500) NOT NULL,
  `iframe6` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_iframe`
--

INSERT INTO `user_iframe` (`username`, `iframe1`, `iframe2`, `iframe3`, `iframe4`, `iframe5`, `iframe6`) VALUES
('aman', 'https://analytics.castsolutions.com.au/single/?appid=223c0fbe-8420-4344-bbd9-f4227eb2a3a3&obj=wJyUhj&select=clearall', 'https://analytics.castsolutions.com.au/single/?appid=223c0fbe-8420-4344-bbd9-f4227eb2a3a3&obj=HJGkTFA&select=clearall', 'https://analytics.castsolutions.com.au/single/?appid=223c0fbe-8420-4344-bbd9-f4227eb2a3a3&obj=bhGSTa&select=clearall\' style=\'border:none;', 'https://analytics.castsolutions.com.au/single/?appid=223c0fbe-8420-4344-bbd9-f4227eb2a3a3&obj=eubptzu&select=clearall\' style=\'border:none;', '', ''),
('harry', 'https://analytics.castsolutions.com.au/single/?appid=223c0fbe-8420-4344-bbd9-f4227eb2a3a3&obj=kfBJpR&select=clearall', 'https://analytics.castsolutions.com.au/single/?appid=223c0fbe-8420-4344-bbd9-f4227eb2a3a3&obj=MafxD&select=clearall', 'https://analytics.castsolutions.com.au/single/?appid=223c0fbe-8420-4344-bbd9-f4227eb2a3a3&obj=jAbGvg&select=clearall', 'https://analytics.castsolutions.com.au/single/?appid=223c0fbe-8420-4344-bbd9-f4227eb2a3a3&obj=EmXsWJH&select=clearall', 'https://analytics.castsolutions.com.au/single/?appid=223c0fbe-8420-4344-bbd9-f4227eb2a3a3&obj=BBEWxSt&opt=nointeraction&select=clearall', 'https://analytics.castsolutions.com.au/single/?appid=223c0fbe-8420-4344-bbd9-f4227eb2a3a3&obj=grCxusP&opt=nointeraction&select=clearall');

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

--
-- Indexes for table `user_iframe`
--
ALTER TABLE `user_iframe`
  ADD PRIMARY KEY (`username`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

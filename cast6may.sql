-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 04, 2017 at 06:15 AM
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
-- Table structure for table `admin_enquiry`
--

CREATE TABLE `admin_enquiry` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
('Amanpreet Singh', 'Gill', 'aman2gill29@gmail.com', '+61416766162', 'Abc@abc.com', 'CEO', 'ABC', 'aman', 'N', 'aman', 'Y'),
('Pete', 'Singh', 'puneetindersingh@gmail.com', '12345689', '', '', '', 'cast_admin', 'Y', 'cast_admin', 'Y'),
('Harry', 'Potter', 'asd@gmail.com', '61491234561', 'Abc@abc.com', 'boss', 'ABC', 'harry', 'N', 'harry', 'Y'),
('Honey', 'Singh', 'honeysingh@gmail.com', '2345678910', 'Abc@abc2.com', 'NA', 'ABC2', 'honey', 'N', 'honey', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `user_enquiry`
--

CREATE TABLE `user_enquiry` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `iframe6` varchar(500) NOT NULL,
  `iframe7` varchar(500) NOT NULL,
  `iframe8` varchar(500) NOT NULL,
  `iframe9` varchar(500) NOT NULL,
  `iframe10` varchar(500) NOT NULL
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
CREATE TABLE `mailbox` (
  `emailId` int(11) NOT NULL,
  `sender` varchar(50) NOT NULL,
  `receiver` varchar(50) NOT NULL,
  `times` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `subject` varchar(100) NOT NULL,
  `message` varchar(500) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `mailbox`
--

INSERT INTO `mailbox` (`emailId`, `sender`, `receiver`, `times`, `subject`, `message`, `status`) VALUES
(4, 'aman', 'harry', '2017-05-04 17:14:20.280375', 'hello', 'hello,harry!', 0),
(6, 'aman', 'aman', '2017-05-05 02:16:17.046432', 'test', 'test1', 1),
(7, 'aman', 'aman', '2017-05-05 02:16:29.358088', 'test2', 'test2', 0),
(11, 'aman', 'honey', '2017-05-05 16:12:02.020134', 'hello', 'hello honey!', 2),
(13, 'cast_admin', 'aman', '2017-05-05 17:09:51.664909', 'test from admin', 'test from admin', 0),
(14, 'aman', 'admin', '2017-05-05 17:18:26.066798', 'test admin', 'hello admin!', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mailbox`
--
ALTER TABLE `mailbox`
  ADD PRIMARY KEY (`emailId`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `mailbox`
--
ALTER TABLE `mailbox`
  MODIFY `emailId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- Indexes for table `admin_enquiry`
--
ALTER TABLE `admin_enquiry`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `user_enquiry`
--
ALTER TABLE `user_enquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_iframe`
--
ALTER TABLE `user_iframe`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_enquiry`
--
ALTER TABLE `admin_enquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_enquiry`
--
ALTER TABLE `user_enquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

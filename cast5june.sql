-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2017-06-05 08:03:15
-- 服务器版本： 10.1.21-MariaDB
-- PHP Version: 5.6.30

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
-- 表的结构 `admin_enquiry`
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
-- 表的结构 `company`
--

CREATE TABLE `company` (
  `name` varchar(30) NOT NULL,
  `address` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `site` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `company`
--

INSERT INTO `company` (`name`, `address`, `phone`, `site`) VALUES
('Coles', 'Ltd., Level 4, 236 Bourke Stre', '1800061562', 'Coles.com.au'),
('Woolworths', '1 Woolworths Way, Bella Vista,', '1800000610', 'Woolworths.com.au');

-- --------------------------------------------------------

--
-- 表的结构 `mailbox`
--

CREATE TABLE `mailbox` (
  `emailId` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
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

INSERT INTO `mailbox` (`emailId`, `username`, `sender`, `receiver`, `times`, `subject`, `message`, `status`) VALUES
(19, 'LangeR', 'LangeR', 'johnson', '2017-06-04 13:39:28.563368', 'Qlik visulisation Setted up', 'Your Qlik visulisation has setted up!', 0),
(20, 'johnson', 'LangeR', 'johnson', '2017-06-04 13:39:28.565875', 'Qlik visulisation Setted up', 'Your Qlik visulisation has setted up!', 1),
(22, 'LangeR', 'LangeR', 'johnson', '2017-06-04 13:40:13.818657', 'hello', 'hello johnson!', 0),
(23, 'johnson', 'LangeR', 'johnson', '2017-06-04 13:40:13.821188', 'hello', 'hello johnson!', 1),
(24, 'johnson', 'johnson', 'LangeR', '2017-06-04 13:43:08.146395', 'ReplyTo: hello johnson!', 'Hello langeR\r\n-------------------------\r\nReplyTo:LangeR\r\nFrom: johnson\r\nTime: hello\r\nContent: hello johnson!', 0),
(25, 'LangeR', 'johnson', 'LangeR', '2017-06-04 13:43:08.153953', 'ReplyTo: hello johnson!', 'Hello langeR\r\n-------------------------\r\nReplyTo:LangeR\r\nFrom: johnson\r\nTime: hello\r\nContent: hello johnson!', 1),
(26, 'LangeR', 'LangeR', 'johnson', '2017-06-05 02:18:47.114396', 'test', 'hello johnson!', 0),
(27, 'johnson', 'LangeR', 'johnson', '2017-06-05 02:18:47.127404', 'test', 'hello johnson!', 1),
(28, 'LangeR', 'LangeR', 'johnson', '2017-06-05 02:19:52.615360', 'test', 'test', 0),
(29, 'johnson', 'LangeR', 'johnson', '2017-06-05 02:19:52.618231', 'test', 'test', 1),
(31, 'LangeR', 'LangeR', 'johnson', '2017-06-05 05:25:00.074052', 'test for inbox', 'sdf', 0),
(33, 'johnson', 'johnson', 'admin', '2017-06-05 05:30:30.899477', 'test admin', 'hello admin', 0),
(34, 'admin', 'johnson', 'admin', '2017-06-05 05:30:30.901885', 'test admin', 'hello admin', 1),
(35, 'johnson', 'johnson', 'admin', '2017-06-05 05:47:14.436468', 'hello admin', 'alsdjfklad', 0),
(36, 'admin', 'johnson', 'admin', '2017-06-05 05:47:14.438873', 'hello admin', 'alsdjfklad', 1);

-- --------------------------------------------------------

--
-- 表的结构 `user_details`
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
-- 转存表中的数据 `user_details`
--

INSERT INTO `user_details` (`firstname`, `lastname`, `email`, `phone`, `companysite`, `jobtitle`, `company`, `password`, `admin_status`, `username`, `account_status`) VALUES
('Quinn', ' Anderson', 'quinn@woolworths.com.au', '+61246801012', '  Woolworths.com.au', 'Manager', 'Woolworths', 'anderson', 'N', 'anderson', 'Y'),
('Holly', 'Brown', 'holly@coles.com.au', '+61888888887', '  Coles.com.au', 'subManager', 'Coles', 'brown', 'N', 'brown', 'Y'),
('Poppy', ' Johnson', 'poppy@coles.com.au', '+61999999988', '  Coles.com.au', 'CEO', 'Coles', 'johnson', 'N', 'johnson', 'Y'),
('Claire', ' Lange', 'claire@castsolutions.com.au', '+61111111111', '  ', '', '', 'LangeC', 'Y', 'LangeC', 'Y'),
('Rob', ' Lange', 'rob@castsolutions.com.au', '+61000000000', '  ', '', '', 'LangeR', 'Y', 'LangeR', 'Y'),
('Olivia', ' Martin', 'olivia@woolworths.com.au', '+61123456789', '  Woolworths.com.au', 'Manager', 'Woolworths', 'martin', 'N', 'martin', 'Y'),
('Kate', ' Moore', 'moore@woolworths.com.au', '+61135791113', '  Woolworths.com.au', 'CEO', 'Woolworths', 'moore', 'N', 'moore', 'Y'),
('Lily', ' Walker', 'lily@coles.com.au', '+61987654321', '  Coles.com.au', 'Manager', 'Coles', 'walker', 'N', 'walker', 'Y'),
('Lachlan', ' Wells', 'lachlan@castsolutions.com.au', '+61222222222', '  ', '', '', 'WellsL', 'Y', 'WellsL', 'Y');

-- --------------------------------------------------------

--
-- 表的结构 `user_iframe`
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
-- 转存表中的数据 `user_iframe`
--

INSERT INTO `user_iframe` (`username`, `iframe1`, `iframe2`, `iframe3`, `iframe4`, `iframe5`, `iframe6`, `iframe7`, `iframe8`, `iframe9`, `iframe10`) VALUES
('anderson', '', '', '', '', '', '', '', '', '', ''),
('brown', 'https://analytics.castsolutions.com.au/single/?appid=223c0fbe-8420-4344-bbd9-f4227eb2a3a3&obj=kfBJpR&select=clearall', 'https://analytics.castsolutions.com.au/single/?appid=223c0fbe-8420-4344-bbd9-f4227eb2a3a3&obj=eubptzu&select=clearall', 'https://analytics.castsolutions.com.au/single/?appid=223c0fbe-8420-4344-bbd9-f4227eb2a3a3&obj=wJyUhj&select=clearall', '', '', '', '', '', '', ''),
('johnson', 'https://analytics.castsolutions.com.au/single/?appid=223c0fbe-8420-4344-bbd9-f4227eb2a3a3&obj=HJGkTFA&select=clearall', 'https://analytics.castsolutions.com.au/single/?appid=223c0fbe-8420-4344-bbd9-f4227eb2a3a3&obj=jAbGvg&select=clearall', '', '', '', '', '', '', '', ''),
('martin', '', '', '', '', '', '', '', '', '', ''),
('moore', '', '', '', '', '', '', '', '', '', ''),
('walker', '', '', '', '', '', '', '', '', '', '');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `mailbox`
--
ALTER TABLE `mailbox`
  ADD PRIMARY KEY (`emailId`);

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

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `admin_enquiry`
--
ALTER TABLE `admin_enquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `mailbox`
--
ALTER TABLE `mailbox`
  MODIFY `emailId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

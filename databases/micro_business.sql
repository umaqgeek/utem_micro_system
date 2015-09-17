-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 17, 2015 at 09:04 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `micro_business`
--

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE IF NOT EXISTS `inventory` (
  `iv_id` varchar(15) NOT NULL,
  `item_name` varchar(20) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `us_id` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`iv_id`),
  KEY `us_id` (`us_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`iv_id`, `item_name`, `price`, `us_id`) VALUES
('V01', 'Bahulu Kampit', 5, 'S01'),
('V02', 'Donat ', 3, 'S02');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE IF NOT EXISTS `sales` (
  `si_id` varchar(15) NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `qty_sold` int(11) DEFAULT NULL,
  `iv_id` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`si_id`),
  KEY `iv_id` (`iv_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`si_id`, `qty`, `date`, `qty_sold`, `iv_id`) VALUES
('SL01', 20, '2015-09-16', 2, 'V01'),
('SL02', 30, '2015-09-18', 5, 'V02');

-- --------------------------------------------------------

--
-- Table structure for table `typeofuser`
--

CREATE TABLE IF NOT EXISTS `typeofuser` (
  `type_id` varchar(15) NOT NULL,
  `user_type` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `typeofuser`
--

INSERT INTO `typeofuser` (`type_id`, `user_type`) VALUES
('S1', 'Staff');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `us_id` varchar(15) NOT NULL,
  `type_id` varchar(15) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `ic_no` int(11) DEFAULT NULL,
  `address` varchar(40) DEFAULT NULL,
  `email` varchar(25) DEFAULT NULL,
  `username` varchar(15) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`us_id`),
  KEY `type_id` (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`us_id`, `type_id`, `name`, `ic_no`, `address`, `email`, `username`, `password`) VALUES
('S01', 'S1', 'Rasyidi', 57, 'No 74 Jalan Machang Perdana', 'syidi@gmail.com', 'syidi', '1'),
('S02', 'S1', 'Amirul Hadi ', 92032108, 'No 45 Jalan TTU 3', 'hadi@gmail.com', 'hadi', '1');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`us_id`) REFERENCES `users` (`us_id`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`iv_id`) REFERENCES `inventory` (`iv_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `typeofuser` (`type_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 25, 2013 at 02:08 p.m.
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `verona`
--
CREATE DATABASE `verona` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `verona`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `AdminID` int(11) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(20) NOT NULL,
  `LastName` varchar(20) NOT NULL,
  `loginID` varchar(12) NOT NULL,
  `password` varchar(12) NOT NULL,
  PRIMARY KEY (`AdminID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminID`, `FirstName`, `LastName`, `loginID`, `password`) VALUES
(1, 'Kazu', 'Haya', 'kazu', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `CustomerID` int(6) NOT NULL AUTO_INCREMENT,
  `Title` varchar(5) DEFAULT NULL,
  `FirstName` varchar(20) NOT NULL,
  `LastName` varchar(20) NOT NULL,
  `Gender` varchar(6) DEFAULT NULL,
  `DOB` varchar(10) NOT NULL,
  `Suburb` varchar(20) NOT NULL,
  `City` varchar(20) NOT NULL,
  `Zip` varchar(10) NOT NULL,
  `Phone` varchar(13) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Info` varchar(30) DEFAULT NULL,
  `ReceiveMail` tinyint(1) NOT NULL,
  `loginID` varchar(12) NOT NULL,
  `password` varchar(12) NOT NULL,
  PRIMARY KEY (`CustomerID`),
  UNIQUE KEY `loginID` (`loginID`),
  KEY `CustomerID` (`CustomerID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustomerID`, `Title`, `FirstName`, `LastName`, `Gender`, `DOB`, `Suburb`, `City`, `Zip`, `Phone`, `Email`, `Info`, `ReceiveMail`, `loginID`, `password`) VALUES
(2, 'Mr', 'fdas', 'fda', 'Male', '10/04/1981', 'fdaf', 'Wellington', '111', '3132132132', 'fdao@g.com', 'Advertisement', 0, 'dsfadfas', 'test'),
(3, 'Mrs', 'abc', 'def', 'Male', '10/04/1981', 'fdaf', 'Auckland', '321', '313123131', 'fdasfda@g.com', 'Friends', 0, 'aaa', 'bbb'),
(4, 'Mrs', 'fdas', 'fda', 'Female', '10/04/1981', 'aaa', 'Wellington', '33333', '4444444', 'fda@h.com', 'Advertisement', 1, 'hhh', 'aaa'),
(5, 'Mrs', 'dfadfafda', 'asdf', 'Female', '11/10/1999', 'fad', 'Wellington', '4343', '132131', 'fa@l.com', 'Internet', 1, 'adsfa', 'aaa'),
(6, 'Mr', 'Kazu', 'Haya', 'Male', '10/4/1981', 'Ch', 'Auckland', '1234', '1111223333', 'kazu@g.com', 'Advertisement', 1, 'Kazu', '1234'),
(7, 'Mrs', 'ccc', 'ddd', 'Female', '11/11/1999', 'test', 'Wellington', '123', '123456', 're@g.com', '', 0, 'ccc', 'ddd'),
(10, 'Mrs', 'fff', 'ggg', '', '10/10/1999', 'dfa', 'Wellington', '1515', '1515151515', 'fad@g.com', '', 0, 'Abc', 'aaa');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE IF NOT EXISTS `orderdetails` (
  `orderDetailID` int(11) NOT NULL AUTO_INCREMENT,
  `orderID` int(11) NOT NULL,
  `productID` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`orderDetailID`),
  KEY `orderID` (`orderID`),
  KEY `productID` (`productID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=75 ;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`orderDetailID`, `orderID`, `productID`, `quantity`) VALUES
(42, 37, 9, 1),
(43, 37, 14, 1),
(44, 38, 16, 5),
(45, 39, 15, 1),
(46, 40, 12, 3),
(47, 40, 13, 5),
(48, 40, 11, 1),
(49, 40, 10, 1),
(50, 40, 9, 1),
(51, 41, 10, 1),
(53, 43, 12, 1),
(54, 44, 12, 1),
(55, 44, 9, 1),
(56, 44, 16, 1),
(57, 45, 12, 1),
(58, 45, 13, 1),
(59, 45, 15, 1),
(60, 46, 17, 1),
(61, 46, 19, 3),
(62, 46, 20, 2),
(63, 47, 14, 1),
(64, 48, 12, 1),
(65, 48, 10, 1),
(66, 49, 11, 1),
(67, 50, 13, 1),
(68, 50, 18, 1),
(69, 51, 10, 2),
(70, 51, 19, 1),
(71, 52, 10, 1),
(72, 52, 12, 2),
(73, 53, 14, 1),
(74, 54, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orderlist`
--

CREATE TABLE IF NOT EXISTS `orderlist` (
  `orderID` int(11) NOT NULL AUTO_INCREMENT,
  `customerID` int(11) DEFAULT NULL,
  `orderDate` date NOT NULL,
  `itemCount` int(11) NOT NULL,
  `totalPrice` double NOT NULL,
  `address` varchar(40) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  PRIMARY KEY (`orderID`),
  KEY `orderID` (`orderID`),
  KEY `customerID` (`customerID`),
  KEY `orderDate` (`orderDate`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

--
-- Dumping data for table `orderlist`
--

INSERT INTO `orderlist` (`orderID`, `customerID`, `orderDate`, `itemCount`, `totalPrice`, `address`, `phone`, `lastName`, `firstName`) VALUES
(37, 6, '2012-11-18', 2, 130.99, 'Ch Auckland 1234', '1111223333', 'Haya', 'Kazu'),
(38, 6, '2012-05-18', 1, 600, 'Ch Auckland 1234', '1111223333', 'Haya', 'Kazu'),
(39, 3, '2013-11-18', 1, 59.89, 'fdaf Auckland 321', '313123131', 'def', 'abc'),
(40, 3, '2013-11-18', 5, 329, 'fdaf Auckland 321', '313123131', 'def', 'abc'),
(41, 3, '2013-11-18', 1, 33, 'fdaf Auckland 321', '313123131', 'def', 'abc'),
(43, 3, '2013-11-18', 1, 25, 'fdaf Auckland 321', '313123131', 'def', 'abc'),
(44, 3, '2013-11-18', 3, 175, 'fdaf Auckland 321', '313123131', 'def', 'abc'),
(45, 6, '2013-11-18', 3, 114.89, 'Ch Auckland 1234', '1111223333', 'Haya', 'Kazu'),
(46, 6, '2013-11-21', 3, 273, 'Ch Auckland 1234', '1111223333', 'Haya', 'Kazu'),
(47, 4, '2013-11-21', 1, 100.99, 'aaa Wellington 33333', '4444444', 'fda', 'fdas'),
(48, 4, '2013-11-21', 2, 58, 'aaa Wellington 33333', '4444444', 'fda', 'fdas'),
(49, 7, '2013-11-21', 1, 41, 'test Wellington 123', '123456', 'ddd', 'ccc'),
(50, 7, '2013-11-21', 2, 55.5, 'test Wellington 123', '123456', 'ddd', 'ccc'),
(51, 6, '2013-11-25', 2, 96, 'Ch Auckland 1234', '1111223333', 'Haya', 'Kazu'),
(52, 6, '2013-11-25', 2, 83, 'Ch Auckland 1234', '1111223333', 'Haya', 'Kazu'),
(53, 6, '2013-11-25', 1, 100.99, 'Ch Auckland 1234', '1111223333', 'Haya', 'Kazu'),
(54, 6, '2013-11-25', 1, 33, 'Ch Auckland 1234', '1111223333', 'Haya', 'Kazu');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `ProductID` int(3) NOT NULL AUTO_INCREMENT,
  `Name` varchar(20) NOT NULL,
  `Type` varchar(20) NOT NULL,
  `Price` double NOT NULL,
  `ImageURL` varchar(30) NOT NULL,
  `Description` varchar(200) NOT NULL,
  PRIMARY KEY (`ProductID`),
  KEY `ProductID` (`ProductID`),
  KEY `Name` (`Name`),
  KEY `Type` (`Type`),
  KEY `Price` (`Price`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProductID`, `Name`, `Type`, `Price`, `ImageURL`, `Description`) VALUES
(9, 'Deco1', 'Deco', 30, 'prod_deco_1.jpg', 'Decoration 1'),
(10, 'Deco2', 'Deco', 33, 'prod_deco_2.jpg', 'Decoration 2 Decoration 2 Decoration 2 Decoration 2 Decoration 2 Decoration 2 Decoration 2 Decoration 2 Decoration 2 Decoration 2 Decoration 2 Decoration 2 Decoration 2 Decoration 2 Decoration 2 Decor'),
(11, 'Deco3', 'Deco', 41, 'prod_deco_3.jpg', 'Deco 3 dayo'),
(12, 'Choco Role', 'Role', 25, 'prod_role_1.jpg', 'Chocolate role\r\nabcd'),
(13, 'Strawberry Role', 'Role', 30, 'prod_role_2.jpg', 'Strawberry'),
(14, 'Wedding1', 'Wed', 100.99, 'prod_wed_1.jpg', 'Weeeeediii ngggg'),
(15, 'Wedding2', 'Wed', 59.89, 'prod_wed_2.jpg', 'Medium size wedding cake'),
(16, 'Wedding3', 'Wed', 120, 'ZEAL-1621.jpg', 'Totoro'),
(17, 'test', 'Deco', 123, '090405yokoyama01.jpg', 'Test desu yo'),
(18, 'Ichigo', 'Role', 25.5, 'ichigo.jpg', 'Strawberry 2'),
(19, 'Coffe role', 'Role', 30, 'prod_role_3.JPG', 'Yum!!'),
(20, 'Role 3', 'Role', 30, 'prod_role_4.jpg', '??'),
(21, 'Wedding 4', 'Wed', 120, 'prod_wed_4.jpg', 'tall'),
(22, 'Wed 3', 'Wed', 90, 'prod_wed_3.jpg', 'wedding');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `orderdetails_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `orderlist` (`orderID`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `orderdetails_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `product` (`ProductID`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Constraints for table `orderlist`
--
ALTER TABLE `orderlist`
  ADD CONSTRAINT `orderlist_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customer` (`CustomerID`) ON DELETE SET NULL ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

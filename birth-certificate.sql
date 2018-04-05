-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 05, 2018 at 03:05 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `birth-certificate`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `adminId` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `userPass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`adminId`, `firstName`, `lastName`, `email`, `userPass`) VALUES
(1, 'Admin', 'Admin', 'admin@admin.com', '5f4dcc3b5aa765d61d8327deb882cf99');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_births`
--

CREATE TABLE `tbl_births` (
  `entryNo` int(11) NOT NULL,
  `childFirstName` varchar(50) NOT NULL,
  `childOtherName` varchar(50) NOT NULL,
  `fatherTribalName` varchar(50) NOT NULL,
  `childDateOfBirth` datetime NOT NULL,
  `sex` varchar(10) NOT NULL,
  `placeOfBirth` varchar(50) NOT NULL,
  `townOfBirth` varchar(50) NOT NULL,
  `countyOfBirth` varchar(50) NOT NULL,
  `fatherFirstName` varchar(50) NOT NULL,
  `fatherOtherName` varchar(50) NOT NULL,
  `theFatherTribalName` varchar(50) NOT NULL,
  `motherId` int(50) NOT NULL,
  `nameOfRegOfficer` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_births`
--

INSERT INTO `tbl_births` (`entryNo`, `childFirstName`, `childOtherName`, `fatherTribalName`, `childDateOfBirth`, `sex`, `placeOfBirth`, `townOfBirth`, `countyOfBirth`, `fatherFirstName`, `fatherOtherName`, `theFatherTribalName`, `motherId`, `nameOfRegOfficer`) VALUES
(2, 'Hildah', 'Mueni', 'Musau', '2018-01-17 00:00:00', 'Female', 'Nursing', 'Kitale', 'Mombasa', 'Simon', 'Ndululu', 'Musau', 12345678, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_counties`
--

CREATE TABLE `tbl_counties` (
  `countyId` int(11) NOT NULL,
  `countyName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_counties`
--

INSERT INTO `tbl_counties` (`countyId`, `countyName`) VALUES
(1, 'Mombasa'),
(2, 'Kwale');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mothers`
--

CREATE TABLE `tbl_mothers` (
  `idNumber` int(20) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phoneNumber` varchar(15) NOT NULL,
  `userPass` varchar(50) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_mothers`
--

INSERT INTO `tbl_mothers` (`idNumber`, `firstName`, `lastName`, `email`, `phoneNumber`, `userPass`, `dateCreated`) VALUES
(12345678, 'Mercy', 'Mathu', 'mercy@mathu.com', '0712345678', '5f4dcc3b5aa765d61d8327deb882cf99', '2018-04-02 18:35:06');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_birth_certificates`
-- (See below for the actual view)
--
CREATE TABLE `view_birth_certificates` (
`entryNo` int(11)
,`childFirstName` varchar(50)
,`childOtherName` varchar(50)
,`fatherTribalName` varchar(50)
,`childDateOfBirth` datetime
,`sex` varchar(10)
,`placeOfBirth` varchar(50)
,`townOfBirth` varchar(50)
,`countyOfBirth` varchar(50)
,`fatherFirstName` varchar(50)
,`fatherOtherName` varchar(50)
,`theFatherTribalName` varchar(50)
,`motherId` int(50)
,`nameOfRegOfficer` int(10)
,`idNumber` int(20)
,`motherFirstName` varchar(50)
,`motherLastName` varchar(50)
,`email` varchar(50)
,`phoneNumber` varchar(15)
,`adminId` int(11)
,`adminFirstName` varchar(50)
,`adminLastName` varchar(50)
);

-- --------------------------------------------------------

--
-- Structure for view `view_birth_certificates`
--
DROP TABLE IF EXISTS `view_birth_certificates`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_birth_certificates`  AS  select `tbl_births`.`entryNo` AS `entryNo`,`tbl_births`.`childFirstName` AS `childFirstName`,`tbl_births`.`childOtherName` AS `childOtherName`,`tbl_births`.`fatherTribalName` AS `fatherTribalName`,`tbl_births`.`childDateOfBirth` AS `childDateOfBirth`,`tbl_births`.`sex` AS `sex`,`tbl_births`.`placeOfBirth` AS `placeOfBirth`,`tbl_births`.`townOfBirth` AS `townOfBirth`,`tbl_births`.`countyOfBirth` AS `countyOfBirth`,`tbl_births`.`fatherFirstName` AS `fatherFirstName`,`tbl_births`.`fatherOtherName` AS `fatherOtherName`,`tbl_births`.`theFatherTribalName` AS `theFatherTribalName`,`tbl_births`.`motherId` AS `motherId`,`tbl_births`.`nameOfRegOfficer` AS `nameOfRegOfficer`,`tbl_mothers`.`idNumber` AS `idNumber`,`tbl_mothers`.`firstName` AS `motherFirstName`,`tbl_mothers`.`lastName` AS `motherLastName`,`tbl_mothers`.`email` AS `email`,`tbl_mothers`.`phoneNumber` AS `phoneNumber`,`tbl_admin`.`adminId` AS `adminId`,`tbl_admin`.`firstName` AS `adminFirstName`,`tbl_admin`.`lastName` AS `adminLastName` from ((`tbl_mothers` join `tbl_births`) join `tbl_admin`) where ((`tbl_births`.`nameOfRegOfficer` = `tbl_admin`.`adminId`) and (`tbl_births`.`motherId` = `tbl_mothers`.`idNumber`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`adminId`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tbl_births`
--
ALTER TABLE `tbl_births`
  ADD PRIMARY KEY (`entryNo`),
  ADD KEY `motherId` (`motherId`),
  ADD KEY `nameOfRegOfficer` (`nameOfRegOfficer`);

--
-- Indexes for table `tbl_counties`
--
ALTER TABLE `tbl_counties`
  ADD PRIMARY KEY (`countyId`);

--
-- Indexes for table `tbl_mothers`
--
ALTER TABLE `tbl_mothers`
  ADD PRIMARY KEY (`idNumber`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_births`
--
ALTER TABLE `tbl_births`
  MODIFY `entryNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_counties`
--
ALTER TABLE `tbl_counties`
  MODIFY `countyId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_births`
--
ALTER TABLE `tbl_births`
  ADD CONSTRAINT `tbl_births_ibfk_1` FOREIGN KEY (`motherId`) REFERENCES `tbl_mothers` (`idNumber`),
  ADD CONSTRAINT `tbl_births_ibfk_2` FOREIGN KEY (`nameOfRegOfficer`) REFERENCES `tbl_admin` (`adminId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

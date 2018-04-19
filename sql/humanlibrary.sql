-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 29, 2018 at 05:32 PM
-- Server version: 5.6.35
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `humanLibrary`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `bookId` int(3) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `story` varchar(50) NOT NULL,
  `available` varchar(3) NOT NULL,
  `bookImage` varchar(300) NOT NULL,
  `timeBack` varchar(11) DEFAULT NULL,
  `alert` varchar(3) NOT NULL DEFAULT 'no'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`bookId`, `firstName`, `lastName`, `story`, `available`, `bookImage`, `timeBack`, `alert`) VALUES
(7, 'Ashley', 'Last', 'Another Good One', 'yes', 'assets/images/pic2.jpg', NULL, 'no'),
(8, 'Joe', 'Jonas', 'being in a band', 'yes', 'assets/images/pic3.jpg', NULL, 'no'),
(10, 'test', 'book', 'erghserg', 'yes', 'assets/images/pic4.jpg', NULL, 'no'),
(11, 'Albert', 'Turk', 'test one', 'yes', 'assets/images/pic5.jpg', NULL, 'no'),
(14, 'Muj', 'Hussain', 'Brown Boy', 'yes', 'assets/images/muj.jpg', NULL, 'no');

-- --------------------------------------------------------

--
-- Table structure for table `worker`
--

CREATE TABLE `worker` (
  `workerId` int(3) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `admin` varchar(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `worker`
--

INSERT INTO `worker` (`workerId`, `firstName`, `lastName`, `email`, `password`, `admin`) VALUES
(1, 'Blake', 'Robertson', 'blaker1136@gmail.com', 'yoyoyo55', 'yes'),
(2, 'Alex', 'Smith', 'test@gmail.com', 'test', 'yes'),
(3, 'test', 'employee', 'test@test.com', 'test', 'yes'),
(9, 'testBoy', 'jimbo', 'phpuser@gmail.com', 'password', 'no'),
(8, 'Pam', 'Beasely', 'pam@dunder.com', 'password', 'yes'),
(7, 'Jim', 'Halpert', 'test5@gamil.com', 'wefwef', 'no');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`bookId`);

--
-- Indexes for table `worker`
--
ALTER TABLE `worker`
  ADD PRIMARY KEY (`workerId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `bookId` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `worker`
--
ALTER TABLE `worker`
  MODIFY `workerId` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
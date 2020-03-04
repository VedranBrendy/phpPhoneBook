-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2020 at 11:38 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phonebook`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `created_at`) VALUES
(1, 'Luka', '2020-03-02 16:05:59'),
(2, 'Borna', '2020-03-02 16:08:20'),
(3, 'Jakov', '2020-03-02 16:08:37'),
(4, 'Kararina', '2020-03-02 16:08:49'),
(5, 'Monika', '2020-03-02 16:09:11'),
(6, 'Thommas', '2020-03-02 16:09:24'),
(7, 'Branko', '2020-03-02 16:09:36'),
(8, 'Mario', '2020-03-02 16:10:01'),
(9, 'Branimir', '2020-03-02 16:10:27'),
(10, 'Janko', '2020-03-03 22:09:35');

-- --------------------------------------------------------

--
-- Table structure for table `contacts_numbers`
--

CREATE TABLE `contacts_numbers` (
  `id` int(11) NOT NULL,
  `contacts_id` int(11) NOT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `contact_number2` varchar(20) DEFAULT NULL,
  `contact_number3` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contacts_numbers`
--

INSERT INTO `contacts_numbers` (`id`, `contacts_id`, `contact_number`, `contact_number2`, `contact_number3`) VALUES
(1, 1, '0912552552', '010000000', '010000001'),
(2, 2, '0992552512', '01000003', '010000004'),
(3, 3, '095255255', '010000005', '010000006'),
(4, 4, '091111111', '', ''),
(5, 5, '', '', '098555478'),
(6, 6, '098568925', NULL, NULL),
(7, 7, '0971212121', '043558558', NULL),
(8, 8, '0992558987', '', ''),
(9, 9, NULL, NULL, '095211211');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts_numbers`
--
ALTER TABLE `contacts_numbers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `contact_number` (`contact_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `contacts_numbers`
--
ALTER TABLE `contacts_numbers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

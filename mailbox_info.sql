-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: ספטמבר 21, 2023 בזמן 08:44 PM
-- גרסת שרת: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mailboxes`
--

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `mailbox_info`
--

CREATE TABLE `mailbox_info` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `box_number` int(200) NOT NULL,
  `phone` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- הוצאת מידע עבור טבלה `mailbox_info`
--

INSERT INTO `mailbox_info` (`id`, `name`, `box_number`, `phone`) VALUES
(40, 'sfff', 666, 99);

--
-- Indexes for dumped tables
--

--
-- אינדקסים לטבלה `mailbox_info`
--
ALTER TABLE `mailbox_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mailbox_info`
--
ALTER TABLE `mailbox_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

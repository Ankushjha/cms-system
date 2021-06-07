-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2021 at 04:28 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(3) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` text NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `randSalt` varchar(255) NOT NULL DEFAULT '$2y$10$iusesomecrazystrings22'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `randSalt`) VALUES
(5, 'ramadhir', 'ramadhir', 'ram', 'shyam', 'ramadhir@gmail.com', '', 'subscriber', ''),
(6, 'ankushjha', 'ankushjha123', 'Ankush', 'Jha', 'ankushjha@gmail.com', '', 'admin', ''),
(12, 'rand', '123', 'rand', 'rand', 'rand@gmail.com', '', 'subscriber', '$2y$10$iusesomecrazystring22'),
(13, 'ankush', '123', '', '', 'ankush@gmail.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22'),
(14, 'guy', '$1$dOJQkavP$8mJGjhP22W1tjhuheA7Ld1', '', '', 'guy@guy.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22'),
(15, 'demo', '$1$G5m1HYe1$PFVGvhlG4MNXD0H4c.et3.', '', '', 'demo@gmail.com', '', 'admin', '$2y$10$iusesomecrazystrings22'),
(17, 'new_user', '$2y$10$Q7fIwRexyXJ.H5EPrOSkeelj6qhwnFhOvSA8yR9HhzTMnrP3mICfK', '', '', 'user@user.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22'),
(18, 'peter', '$2y$10$CBoK6Qw9tr4FJuUegTdcD.A1sw8Bt0ndMla/QbJcYv9CqpPPqp77K', '', '', 'peter@gmail.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22'),
(19, 'anku', '$2y$10$d738GL43qh95.7Ysyy4SyONWTqRAIf4zQab4nMEenGd8THH1TtebG', 'ankush', 'jha', 'anku@gmail.com', '', 'admin', '$2y$10$iusesomecrazystrings22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2021 at 09:00 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `buzz`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `post_type` varchar(256) NOT NULL,
  `post_caption` text NOT NULL,
  `post_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `post_by` int(11) NOT NULL,
  `paddress` text NOT NULL,
  `pdate` date NOT NULL,
  `pticket` int(11) NOT NULL,
  `tprice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_type`, `post_caption`, `post_time`, `post_by`, `paddress`, `pdate`, `pticket`, `tprice`) VALUES
(1, 'post', 'THE holloween..\r\nbuzz around me ..\r\nmost trending event ever.\r\nhappening at Rooftop Cafe', '2018-11-23 14:55:24', 3, 'Rooftop Cafe, Aurobindo Marg, 4th T Block East, Jayanagar 3rd Block East, Jayanagar, Bengaluru, Karnataka', '2018-11-29', 24, 150),
(2, 'post', 'Dj night .. most awaited ', '2018-11-13 18:14:53', 3, 'Hard Rock cafe, No.40, St Marks Rd, Opp LIC Building, Shanthala Nagar, Ashok Nagar, Bengaluru, Karnataka 560001', '2018-11-29', 250, 200),
(40, 'profile', '  has changed  profile picture.', '2018-11-25 09:29:08', 3, '', '0000-00-00', 0, 0),
(55, 'profile', '  has changed  profile picture.', '2018-11-25 15:05:07', 4, '', '0000-00-00', 0, 0),
(60, 'post', 'christmas eve', '2018-12-02 10:05:03', 5, 'Brigade Rd & Church St, Shanthala Nagar, Ashok Nagar, Bengaluru, Karnataka 560001', '2018-12-25', 100, 200),
(65, 'post', 'festival of costumes', '2018-12-10 05:30:44', 4, 'Hard Rock cafe, Saint Marks Road, Opp LIC Building, Bengaluru, Karnataka', '2019-01-25', 85, 500),
(68, 'post', 'holi', '2018-12-10 06:47:55', 5, '278-A, 9th A Main Road, Opp. Cafe Coffee Day, Jayanagar East, 4th Block, Jayanagara Jaya Nagar, Bengaluru, Karnataka 560011', '2019-01-16', 9, 400);

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_date` date NOT NULL,
  `ticket_count` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `ticket_amount` int(11) NOT NULL,
  `regtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`id`, `post_id`, `user_id`, `event_date`, `ticket_count`, `ticket_id`, `ticket_amount`, `regtime`) VALUES
(1, 1, 4, '2018-11-30', 3, 71398, 450, '2018-11-14 07:19:49'),
(2, 1, 5, '0000-00-00', 3, 90020, 450, '2018-11-14 07:28:54'),
(3, 1, 4, '0000-00-00', 4, 33781, 600, '2018-11-16 10:08:26'),
(4, 4, 3, '0000-00-00', 2, 401, 300, '2018-11-16 10:10:51'),
(5, 1, 5, '0000-00-00', 1, 25, 150, '2018-11-23 13:13:18'),
(6, 1, 5, '0000-00-00', 1, 20344, 150, '2018-11-23 14:55:24'),
(7, 65, 3, '2019-01-25', 2, 66344, 1000, '2018-12-10 05:25:15'),
(8, 65, 3, '2019-01-25', 3, 86062, 1500, '2018-12-10 05:30:44'),
(9, 68, 5, '2019-01-16', 6, 59129, 2400, '2018-12-10 06:47:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fname` varchar(256) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `address` longtext NOT NULL,
  `city` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_status` varchar(256) NOT NULL DEFAULT 'active',
  `catagory` varchar(100) NOT NULL DEFAULT 'user',
  `regdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fname`, `lname`, `address`, `city`, `gender`, `email`, `password`, `user_status`, `catagory`, `regdate`) VALUES
(3, 'Arvin', 'Alv', 'Rt Nagar Post', 'Banaglore', 'male', 'arvin@gmail.com', 'arvin', 'active', 'admin', '2018-11-04 05:13:16'),
(4, 'Alvin', 'K', 'RR Nagar', 'Bangalore', 'male', 'alvin@gmail.com', 'alvin', 'deactive', 'user', '2018-11-04 11:14:02'),
(5, 'Arpita', 'Patil', 'JP Nagar', 'Bangalore', 'female', 'arps@gmail.com', 'arps', 'active', 'user', '2018-11-05 04:51:09'),
(6, 'ram', 'kumar', 'rr nagar', 'bangalore', 'male', 'ram@gmail.com', 'arm123', 'active', 'user', '2018-12-10 06:33:42'),
(7, 'ravi', 'kumar', 'rt nagar', 'bangalore', 'male', 'ravi@gmail.com', 'ravi', 'deactive', 'user', '2018-12-10 06:38:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

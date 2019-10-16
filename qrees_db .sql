-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 16, 2019 at 10:53 AM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qrees_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminId` int(11) NOT NULL,
  `full_name` varchar(200) CHARACTER SET utf8mb4 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `profile_image` varchar(64) CHARACTER SET utf8mb4 NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0-Active  1- Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminId`, `full_name`, `email`, `password`, `profile_image`, `created_on`, `updated_on`, `status`) VALUES
(1, 'admin', 'admin@qrees.com', '$2y$10$T3HM/AaAzwyslb2lefxlp.f/4vemkqqXbncgQEiqIhvRk6u0Dor22', 'Q4IAkomgb9ePx2iM.jpg', '2019-10-14 11:08:04', '2019-10-15 11:12:02', 0);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `commentId` int(11) NOT NULL,
  `commentMsg` varchar(255) NOT NULL,
  `postId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `crd` timestamp NOT NULL DEFAULT current_timestamp(),
  `upd` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`commentId`, `commentMsg`, `postId`, `userId`, `crd`, `upd`) VALUES
(3, 'Very good', 3, 1, '2019-10-14 06:45:38', '2019-10-14 06:45:38'),
(4, 'Very good', 3, 1, '2019-10-14 06:46:47', '2019-10-14 06:46:47'),
(5, 'most welcome', 3, 1, '2019-10-14 06:50:37', '2019-10-14 06:50:37'),
(6, 'school days', 3, 1, '2019-10-14 06:51:31', '2019-10-14 06:51:31');

-- --------------------------------------------------------

--
-- Table structure for table `post_likes`
--

CREATE TABLE `post_likes` (
  `likeId` int(11) NOT NULL,
  `postId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `crd` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post_likes`
--

INSERT INTO `post_likes` (`likeId`, `postId`, `userId`, `crd`) VALUES
(8, 3, 1, '2019-10-14 06:54:28');

-- --------------------------------------------------------

--
-- Table structure for table `post_share`
--

CREATE TABLE `post_share` (
  `shareId` int(11) NOT NULL,
  `postId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `share_count` int(11) NOT NULL,
  `crd` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `post_views`
--

CREATE TABLE `post_views` (
  `viewId` int(11) NOT NULL,
  `postId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `view_count` int(11) NOT NULL,
  `crd` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profileImage` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `deviceToken` varchar(255) NOT NULL,
  `deviceType` tinyint(4) NOT NULL,
  `authToken` varchar(255) NOT NULL,
  `crd` timestamp NOT NULL DEFAULT current_timestamp(),
  `upd` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `userName`, `email`, `password`, `profileImage`, `deviceToken`, `deviceType`, `authToken`, `crd`, `upd`, `status`) VALUES
(1, 'Vihag dubey', 'vihag@gmail.com', '$2y$10$GtsgICPEeIpQthkhbd67sOfa5CRLoFFVY1pR03OFv/zCHbG97Oe5O', '1YvExjfK0pF7riwQ.jpg', '', 0, 'QXTOzyNFwSL36oJp5mun7iUMK4xtfqVa', '2019-08-28 05:27:05', '2019-10-14 06:36:14', 1),
(2, 'Vihag Kumar', 'vihag.mindiii@gmail.com', '$2y$10$aNlxthHd9as1xa6yv4WMzuk0KnHwaSTScy7EKo/J3g8uxj9t/ufd2', '', 'dsfdsfsd', 1, 'QZs7cNxRJ2GpmDdYMH5e6fKnyvhELXIB', '2019-09-06 09:06:35', '2019-09-06 09:06:35', 1),
(3, 'Admin', 'admin@gmail.com', '$2y$10$xbllGUgNi1hQTEEhE0FGU.h0w/K71rHrml4l7YWH6iYjhTuo/7op.', 'WuUQiqcpFw0YzSTB.png', '', 0, '9ofXz1uE2kH6Gb5qPiDAs8KrhZOacQJw', '2019-09-06 09:16:55', '2019-09-06 09:26:03', 1),
(4, 'Bharat', 'bharatmindiii7@gmail.com', '$2y$10$yLnJujmnEowpGb75VmF3BO21PI1XaBuPUM7PqXxI0Hx4BgtKwzXiu', 'oyeX1x7Y6q4vNgSL.png', 'asdf', 1, 'YKVRhgZSyxJLD7XQAtsk8PldwaemcnWu', '2019-10-09 13:20:36', '2019-10-14 03:29:05', 1),
(5, 'Jyoti Singh', 'jyoti.mindiii@gmail.com', '$2y$10$RZGdqLfsLPzB0/wXfFyeKOpMC36OX0f6d1szW1PDxGvan7xpvh2VW', '', '', 0, 'jkTqdcZrANpPXtEzh5QeUmxJS72DY3w0', '2019-10-11 05:47:11', '2019-10-12 13:53:27', 1),
(6, 'Shashi Singh', 'shashi.mindiii@gmail.com', '$2y$10$2Cj7YzLxX4Xfj0Z9plRaSez400sxEL/8Jsk9w2cDseB7bHfCaqJHC', 'fatm09uqDLP2NeYU.jpg', '9756466807', 2, 'RbC5wd9zuUhtSH3MKc7ekGlQXEm6LoAj', '2019-10-11 06:04:44', '2019-10-11 06:04:44', 1),
(7, 'Shashikant Pandey', 'shashikant.mindiii@gmail.com', '$2y$10$z3diIAwxWhbwZt1079n7R.xCAJz4aNK2hxPZLkMPKfC2MswoDIB8q', 'MkbUnjyevcqAuSFO.jpg', '9756466807', 2, 'fnaEUtTRvGiZeb0O3Mu2xkVrHSoFdqhw', '2019-10-11 06:07:16', '2019-10-11 06:07:16', 1),
(8, 'Shashikant Pandey', 'shashikant@gmail.com', '$2y$10$Fvs4RijRj38zET8KlL2giei4hzkIMDfIFoV5SWMt5mjthds1GBwZu', 'MS4wb0P21zYUJqfi.jpg', '9756466807', 2, '1fEMw4F3VnW5J7bmrskTpotjzhNuld0Y', '2019-10-14 07:08:12', '2019-10-16 06:12:10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_post`
--

CREATE TABLE `users_post` (
  `postId` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `mediaType` tinyint(4) NOT NULL COMMENT '1-Image, 2-Video, 3-Audio',
  `userId` int(11) NOT NULL,
  `mediaName` varchar(255) NOT NULL,
  `totalUserLikes` int(11) NOT NULL,
  `totalUserComments` int(11) NOT NULL,
  `totalUserViews` int(11) NOT NULL,
  `crd` timestamp NOT NULL DEFAULT current_timestamp(),
  `upd` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_post`
--

INSERT INTO `users_post` (`postId`, `title`, `description`, `mediaType`, `userId`, `mediaName`, `totalUserLikes`, `totalUserComments`, `totalUserViews`, `crd`, `upd`) VALUES
(3, 'College First Day', 'My first day in college campus.', 1, 1, 'xDRSJzQMoZhn9Cqk.png', 1, 3, 0, '2019-10-14 06:33:04', '2019-10-14 06:54:28'),
(4, 'Campus Interview', 'Technical interview and hr ', 1, 1, 'iXkl93weo20gcnRv.jpg', 0, 0, 0, '2019-10-14 06:56:31', '2019-10-14 06:56:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentId`),
  ADD KEY `postId` (`postId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `post_likes`
--
ALTER TABLE `post_likes`
  ADD PRIMARY KEY (`likeId`),
  ADD KEY `postId` (`postId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `post_share`
--
ALTER TABLE `post_share`
  ADD PRIMARY KEY (`shareId`),
  ADD KEY `postId` (`postId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `post_views`
--
ALTER TABLE `post_views`
  ADD PRIMARY KEY (`viewId`),
  ADD KEY `postId` (`postId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `users_post`
--
ALTER TABLE `users_post`
  ADD PRIMARY KEY (`postId`),
  ADD KEY `userId` (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `post_likes`
--
ALTER TABLE `post_likes`
  MODIFY `likeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `post_share`
--
ALTER TABLE `post_share`
  MODIFY `shareId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post_views`
--
ALTER TABLE `post_views`
  MODIFY `viewId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users_post`
--
ALTER TABLE `users_post`
  MODIFY `postId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`postId`) REFERENCES `users_post` (`postId`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE;

--
-- Constraints for table `post_likes`
--
ALTER TABLE `post_likes`
  ADD CONSTRAINT `post_likes_ibfk_1` FOREIGN KEY (`postId`) REFERENCES `users_post` (`postId`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_likes_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE;

--
-- Constraints for table `post_share`
--
ALTER TABLE `post_share`
  ADD CONSTRAINT `post_share_ibfk_1` FOREIGN KEY (`postId`) REFERENCES `users_post` (`postId`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_share_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE;

--
-- Constraints for table `post_views`
--
ALTER TABLE `post_views`
  ADD CONSTRAINT `post_views_ibfk_1` FOREIGN KEY (`postId`) REFERENCES `users_post` (`postId`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_views_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE;

--
-- Constraints for table `users_post`
--
ALTER TABLE `users_post`
  ADD CONSTRAINT `users_post_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2024 at 10:44 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agroculture`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogdata`
--

CREATE TABLE `blogdata` (
  `blogId` int(10) NOT NULL,
  `blogUser` varchar(256) NOT NULL,
  `blogTitle` varchar(256) NOT NULL,
  `blogContent` longtext NOT NULL,
  `blogTime` timestamp NOT NULL DEFAULT current_timestamp(),
  `likes` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blogdata`
--

INSERT INTO `blogdata` (`blogId`, `blogUser`, `blogTitle`, `blogContent`, `blogTime`, `likes`) VALUES
(19, 'Gloria N', 'Very Nice Stocks', '<p>Its Awesome Business<img alt=\"wink\" src=\"https://cdn.ckeditor.com/4.8.0/full/plugins/smiley/images/wink_smile.png\" style=\"height:23px; width:23px\" title=\"wink\" /></p>\n', '2024-04-25 13:09:41', 2),
(20, 'Jesca', 'Good Quality', '<p><strong><em>I surely&nbsp; love the products , they are very nice</em></strong></p>\r\n\r\n<p><strong><em>Thanks to the management team</em></strong></p>\r\n', '2024-04-29 04:56:06', 2),
(21, 'sibendirejoshua@gmail.com', 'How it  works', '<p><strong>hey there,&nbsp;</strong></p>\r\n\r\n<p>This is sound great</p>\r\n', '2024-06-11 19:50:30', 1),
(22, 'Nakalema', 'Matoke request', '<p>Do you have matoke?</p>\r\n', '2024-06-14 04:00:38', 1);

-- --------------------------------------------------------

--
-- Table structure for table `blogfeedback`
--

CREATE TABLE `blogfeedback` (
  `blogId` int(10) NOT NULL,
  `comment` varchar(256) NOT NULL,
  `commentUser` varchar(256) NOT NULL,
  `commentPic` varchar(256) NOT NULL DEFAULT 'profile0.png',
  `commentTime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blogfeedback`
--

INSERT INTO `blogfeedback` (`blogId`, `comment`, `commentUser`, `commentPic`, `commentTime`) VALUES
(22, 'Yes', 'Nakalema', 'profile0.png', '2024-06-14 04:01:20');

-- --------------------------------------------------------

--
-- Table structure for table `buyer`
--

CREATE TABLE `buyer` (
  `bid` int(100) NOT NULL,
  `bname` varchar(100) NOT NULL,
  `busername` varchar(100) NOT NULL,
  `bpassword` varchar(100) NOT NULL,
  `bhash` varchar(100) NOT NULL,
  `bemail` varchar(100) NOT NULL,
  `bmobile` varchar(100) NOT NULL,
  `baddress` text NOT NULL,
  `bactive` int(100) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `farmer`
--

CREATE TABLE `farmer` (
  `fid` int(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `fusername` varchar(255) NOT NULL,
  `fpassword` varchar(255) NOT NULL,
  `fhash` varchar(255) NOT NULL,
  `femail` varchar(255) NOT NULL,
  `fmobile` varchar(255) NOT NULL,
  `faddress` text NOT NULL,
  `factive` int(255) NOT NULL DEFAULT 0,
  `frating` int(11) NOT NULL DEFAULT 0,
  `picExt` varchar(255) NOT NULL DEFAULT 'png',
  `picStatus` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `farmer`
--

INSERT INTO `farmer` (`fid`, `fname`, `fusername`, `fpassword`, `fhash`, `femail`, `fmobile`, `faddress`, `factive`, `frating`, `picExt`, `picStatus`) VALUES
(3, 'Kaivalya Hemant Mendki', 'ThePhenom', '$2y$10$22ezmzHRa9c5ycHmVm5RpOnlT4LwFaDZar1XhmLRJQKGrcVRhPgti', '61b4a64be663682e8cb037d9719ad8cd', 'kmendki98@gmail.com', '8600611198', 'abcde', 0, 0, 'png', 0),
(5, 'NAKALEMA', 'Jesca', '$2y$10$/I1iJUhwrWjEe0O7aqeQ5esCxroLly5mIjt/NncYE2HOeqovZPzqK', '7f6ffaa6bb0b408017b62254211691b5', 'jesca@gmail.com', '0704991859', 'Kampala', 1, 0, 'png', 0),
(7, 'Joshua', 'sibendirejoshua@gmail.com', '$2y$10$E6Keko.yMcMo4pNiKi/2zuJgf7uunMJaSVsxjcg8No9f5oJfgGD0C', '46ba9f2a6976570b0353203ec4474217', 'sibendirejoshua@gmail.com', '0785678945', 'mengo', 0, 0, 'png', 0),
(8, 'Jesca', 'Nakalema', '$2y$10$etE/yvWHEx.xzmC/d0eIGu96SjDLdXh1i6FYReFXkoHr0eNjqNnk6', 'fe8c15fed5f808006ce95eddb7366e35', 'nakalemajesca3@gmail.com', '0704991859', 'mengo', 0, 0, 'png', 0),
(11, 'naka', 'nakalema', '$2y$10$dCzwhX9OF/UAC5vr2XVR7.HH5jq9txNbL1jFf9/KwBqfwroL/TRTy', '9dcb88e0137649590b755372b040afad', 'jesca12@gmail.com', '0785678945', 'mengo', 0, 0, 'png', 0),
(12, 'Mumbere', 'Hr', '$2y$10$jLItq8tHNrOVCnApqbhW.OU4UswLZ6jX5U.jYHb58uILlSdXYX.n2', 'c042f4db68f23406c6cecf84a7ebb0fe', 'siirasonh@gmail.com', '0700704483', 'mengo', 0, 0, 'png', 0),
(13, 'siirason', 'Jescagloria', '$2y$10$W0E5lNYOsqCZmk2T8RqDyO7z70KekExV3CYco0oNg9EB5936pbJ6W', '92977ae4d2ba21425a59afb269c2a14e', 'siirason@gmail.com', '0781127085', 'Sheema', 0, 0, 'png', 0),
(14, 'Gloria', 'naluwembe', '$2y$10$iIzFi0PTn6b3hxRc1ZQvLO25EYDo/8EtvK.N.y.dWSdl2ebxvGYwu', 'd947bf06a885db0d477d707121934ff8', 'glorianaluwembe@gmail.com', '0784567834', 'Kampala', 0, 0, 'png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `fproduct`
--

CREATE TABLE `fproduct` (
  `fid` int(255) NOT NULL,
  `pid` int(255) NOT NULL,
  `product` varchar(255) NOT NULL,
  `pcat` varchar(255) NOT NULL,
  `pinfo` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `pnumber` varchar(255) DEFAULT NULL,
  `pimage` varchar(255) NOT NULL DEFAULT 'blank.png',
  `picStatus` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fproduct`
--

INSERT INTO `fproduct` (`fid`, `pid`, `product`, `pcat`, `pinfo`, `price`, `pnumber`, `pimage`, `picStatus`) VALUES
(8, 1, 'Cows', 'animals', '', 800000, '1000', 'Cows8.jpeg', 1),
(7, 2, 'Tomatoes', 'Fruit', '', 120000, '650', 'Tomatoes7.jpeg', 1),
(7, 3, 'Apples', 'Fruit', '', 100000, '2000 sacks', 'Apples7.jpeg', 1),
(0, 4, 'Passional fruit', 'Fruit', '', 20000, '10000', 'Passional fruit.jpeg', 1),
(14, 5, 'Rabbits', 'animals', '', 10000, '1000', 'Rabbits14.jpeg', 1),
(13, 6, 'Birds', 'animals', '', 30000, '10000', 'Birds13.jpeg', 1),
(13, 7, 'Pigs', 'animals', '', 500000, '1000', 'Pigs13.jpeg', 1),
(13, 8, 'Dog', 'animals', '', 400000, '100', 'Dog13.jpeg', 1),
(13, 9, 'mango', 'Fruit', '', 5000, '1000 buckets', 'mango13.jpeg', 1),
(8, 10, 'Mangoes', 'Fruit', '', 200000, '10', 'Mangoes8.jpeg', 1),
(8, 11, 'Sheep', 'animals', '<p>They are local&nbsp;</p>\r\n', 200000, '10000', 'Sheep8.jpeg', 1),
(0, 12, 'beans', 'Grains', '', 200000, '12 sacks', 'beans.jpeg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `likedata`
--

CREATE TABLE `likedata` (
  `blogId` int(10) NOT NULL,
  `blogUserId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likedata`
--

INSERT INTO `likedata` (`blogId`, `blogUserId`) VALUES
(22, 8);

-- --------------------------------------------------------

--
-- Table structure for table `mycart`
--

CREATE TABLE `mycart` (
  `bid` int(10) NOT NULL,
  `pid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `pid` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `rating` int(10) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `tid` int(10) NOT NULL,
  `bid` int(10) NOT NULL,
  `pid` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pincode` varchar(255) NOT NULL,
  `addr` varchar(255) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `totalCost` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`tid`, `bid`, `pid`, `name`, `city`, `mobile`, `email`, `pincode`, `addr`, `quantity`, `totalCost`) VALUES
(1, 13, 5, 'computers', 'kampala', '0785678945', 'sibendirejoshua@gmail.com', '', 'mengo', 2000, '20000000.00'),
(2, 14, 2, 'Joshua s', 'Kampala', '0784567834', 'sibendirejoshua@gmail.com', '', 'Mengo', 100, '12000000.00'),
(3, 14, 2, 'Joshua', 'Kampala', '0798566784', 'sibendirejoshua@gmail.com', '', 'Mengo', 10, '1200000.00'),
(4, 14, 2, 'Joshua s', 'Kampala', '0784567834', 'sibendirejoshua@gmail.com', '', 'Mengo', 100, '12000000.00'),
(5, 8, 10, 'Joshua', 'kampala', '0700704485', 'sibendirejoshua@gmail.com', '', 'mengo', 1, '200000.00'),
(6, 8, 10, 'Joshua', 'kampala', '0700704485', 'sibendirejoshua@gmail.com', '', 'mengo', 1, '200000.00'),
(7, 8, 2, 'Gloria', 'kampala', '0785678945', 'naluwembegloria@gmail.com', '', 'mengo', 90, '10800000.00'),
(8, 8, 2, 'Naluwembe', 'kira', '0756345872', 'naluwembegloria@gmail.com', '', 'kira', 50, '6000000.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogdata`
--
ALTER TABLE `blogdata`
  ADD PRIMARY KEY (`blogId`);

--
-- Indexes for table `blogfeedback`
--
ALTER TABLE `blogfeedback`
  ADD PRIMARY KEY (`blogId`);

--
-- Indexes for table `buyer`
--
ALTER TABLE `buyer`
  ADD PRIMARY KEY (`bid`),
  ADD UNIQUE KEY `bid` (`bid`);

--
-- Indexes for table `farmer`
--
ALTER TABLE `farmer`
  ADD PRIMARY KEY (`fid`),
  ADD UNIQUE KEY `fid` (`fid`);

--
-- Indexes for table `fproduct`
--
ALTER TABLE `fproduct`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `likedata`
--
ALTER TABLE `likedata`
  ADD PRIMARY KEY (`blogId`),
  ADD KEY `blogId` (`blogId`),
  ADD KEY `blogUserId` (`blogUserId`);

--
-- Indexes for table `mycart`
--
ALTER TABLE `mycart`
  ADD PRIMARY KEY (`bid`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`tid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogdata`
--
ALTER TABLE `blogdata`
  MODIFY `blogId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `blogfeedback`
--
ALTER TABLE `blogfeedback`
  MODIFY `blogId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `buyer`
--
ALTER TABLE `buyer`
  MODIFY `bid` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `farmer`
--
ALTER TABLE `farmer`
  MODIFY `fid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `fproduct`
--
ALTER TABLE `fproduct`
  MODIFY `pid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `likedata`
--
ALTER TABLE `likedata`
  MODIFY `blogId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `mycart`
--
ALTER TABLE `mycart`
  MODIFY `bid` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `pid` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `tid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buyer`
--
ALTER TABLE `buyer`
  ADD CONSTRAINT `buyer_ibfk_1` FOREIGN KEY (`bid`) REFERENCES `farmer` (`fid`);

--
-- Constraints for table `likedata`
--
ALTER TABLE `likedata`
  ADD CONSTRAINT `likedata_ibfk_1` FOREIGN KEY (`blogId`) REFERENCES `blogdata` (`blogId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
